document.addEventListener('DOMContentLoaded', () => {

    // =================================================================
    // BAGIAN 1: KONSTANTA & VARIABEL STATE
    // =================================================================

    const COLORS = ['red', 'yellow', 'green', 'blue'];
    const VALUES = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'skip', 'reverse', 'draw2'];

    const botHandElement = document.getElementById('bot-hand');
    const playerHandElement = document.getElementById('player-hand');
    const discardPileElement = document.getElementById('discard-pile');
    const deckElement = document.getElementById('deck');
    const deckCounterElement = document.getElementById('deck-counter');
    const gameMessageElement = document.getElementById('game-message');
    const playerBalanceElement = document.getElementById('player-balance');
    const startRoundBtn = document.getElementById('start-round-btn');
    const betInputElement = document.getElementById('bet-input');
    const currentBalanceElement = document.getElementById('current-balance');
    const bettingOverlay = document.getElementById('betting-overlay');
    const unoButton = document.getElementById('uno-button');
    const gameOverOverlay = document.getElementById('game-over-overlay');
    const restartGameBtn = document.getElementById('restart-game-btn');
    const colorPickerOverlay = document.getElementById('color-picker-overlay');
    const colorChoices = document.getElementById('color-choices');

    let deck = [], playerHand = [], botHand = [], discardPile = [];
    let currentPlayer = 'player', playerBalance = 5000, currentBet = 0;
    let playerDeclaredUno = false;
    
    // =================================================================
    // BAGIAN 2: FUNGSI SETUP PERMAINAN
    // =================================================================

    function createDeck() {
        const newDeck = [];
        COLORS.forEach(color => {
            VALUES.forEach(value => {
                newDeck.push({ color, value, originalColor: color });
                if (value !== '0') newDeck.push({ color, value, originalColor: color });
            });
        });
        for (let i = 0; i < 4; i++) {
            newDeck.push({ color: 'wild', value: 'wild', originalColor: 'wild' });
            newDeck.push({ color: 'wild', value: 'wild_draw4', originalColor: 'wild' });
        }
        return newDeck;
    }

    function shuffleDeck(deck) {
        for (let i = deck.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [deck[i], deck[j]] = [deck[j], deck[i]];
        }
    }

    function startRound() {
        currentBet = parseInt(betInputElement.value);
        if (isNaN(currentBet) || currentBet < 100 || currentBet > playerBalance) {
            return alert("Nilai taruhan tidak valid!");
        }
        playerBalance -= currentBet;
        bettingOverlay.classList.remove('active');
        gameMessageElement.textContent = "Ronde dimulai! Giliran Anda.";
        playerDeclaredUno = false;
        unoButton.classList.remove('hidden'); // Pastikan tombol UNO muncul lagi
        deck = createDeck();
        shuffleDeck(deck);
        playerHand = [], botHand = [], discardPile = [];
        for (let i = 0; i < 7; i++) {
            playerHand.push(deck.pop());
            botHand.push(deck.pop());
        }
        let firstCard = deck.pop();
        while (firstCard.value === 'wild_draw4') {
            deck.push(firstCard);
            shuffleDeck(deck);
            firstCard = deck.pop();
        }
        discardPile.push(firstCard);
        currentPlayer = 'player';
        renderAll();
        handleCardEffects(firstCard, true);
    }
    
    // =================================================================
    // BAGIAN 3: LOGIKA INTI & AKSI PEMAIN
    // =================================================================

    function isCardPlayable(card) {
        const topCard = discardPile[discardPile.length - 1];
        if (!topCard) return true;
        return card.color === 'wild' || card.color === topCard.color || card.value === topCard.value;
    }

    function playCard(card, player) {
        const hand = (player === 'player') ? playerHand : botHand;
        // Cari kartu berdasarkan data-*, bukan hanya properti objek mentah
        const cardInHand = hand.find(c => c.value === card.value && c.originalColor === (card.originalColor || card.color));
        const cardIndex = hand.indexOf(cardInHand);

        if (cardIndex > -1) {
            const [playedCard] = hand.splice(cardIndex, 1);
            discardPile.push(playedCard);
            
            if (playedCard.value.startsWith('wild')) {
                handleWildCard(playedCard, player);
            } else {
                handleCardEffects(playedCard);
                if (hand.length === 0) return checkWinCondition();
                switchTurn();
            }
        }
    }
    
    function handleWildCard(playedCard, player) {
        if (player === 'player') {
            colorPickerOverlay.classList.add('active');
        } else {
            const chosenColor = botChooseColor();
            gameMessageElement.textContent = `Bot memilih warna ${chosenColor}.`;
            playedCard.color = chosenColor;
            handleCardEffects(playedCard);
            if (botHand.length === 0) return checkWinCondition();
            switchTurn();
        }
    }

    function handleColorChoice(event) {
        const chosenColor = event.target.dataset.color;
        if (chosenColor) {
            const wildCard = discardPile[discardPile.length - 1];
            wildCard.color = chosenColor;
            colorPickerOverlay.classList.remove('active');
            handleCardEffects(wildCard);
            if (playerHand.length === 0) return checkWinCondition();
            switchTurn();
        }
    }

    function handleUnoButtonClick() {
        if (currentPlayer !== 'player') return;

        if (playerHand.length === 1) {
            playerDeclaredUno = true;
            gameMessageElement.textContent = "Anda menyatakan UNO!";
            unoButton.classList.add('hidden'); // Sembunyikan setelah berhasil
        } else {
            gameMessageElement.textContent = "Salah pencet UNO! Anda mendapat 2 kartu penalti.";
            if (deck.length >= 2) {
                playerHand.push(deck.pop(), deck.pop());
            }
            renderAll();
        }
    }
    
    // =================================================================
    // BAGIAN 4: LOGIKA BOT & ALUR PERMAINAN
    // =================================================================

    function botTurn() {
        setTimeout(() => {
            const cardToPlay = botHand.find(card => isCardPlayable(card));
            if (cardToPlay) {
                gameMessageElement.textContent = `Bot memainkan kartu.`;
                playCard(cardToPlay, 'bot');
            } else {
                if (deck.length > 0) botHand.push(deck.pop());
                gameMessageElement.textContent = "Bot mengambil 1 kartu.";
                switchTurn();
            }
        }, 1500);
    }
    
    function botChooseColor() {
        const colorCount = { red: 0, green: 0, blue: 0, yellow: 0 };
        botHand.forEach(card => {
            if (card.originalColor !== 'wild') colorCount[card.originalColor]++;
        });
        let bestColor = 'red';
        let maxCount = 0;
        for (const color in colorCount) {
            if (colorCount[color] > maxCount) {
                maxCount = colorCount[color];
                bestColor = color;
            }
        }
        return bestColor;
    }

    function switchTurn() {
        if (currentPlayer === 'player' && playerHand.length === 1 && !playerDeclaredUno) {
            gameMessageElement.textContent = "Anda lupa bilang UNO! Ambil 2 kartu penalti.";
            playerHand.push(deck.pop(), deck.pop());
        }
        playerDeclaredUno = false; // Reset status UNO untuk giliran berikutnya
        renderAll();
        if (checkWinCondition()) return;
        currentPlayer = (currentPlayer === 'player') ? 'bot' : 'player';
        gameMessageElement.textContent = (currentPlayer === 'player') ? "Giliran Anda!" : "Giliran Bot...";
        if (currentPlayer === 'bot') botTurn();
    }
    
    function handleCardEffects(card, isFirstCard = false) {
        const nextPlayer = isFirstCard ? currentPlayer : (currentPlayer === 'player' ? 'bot' : 'player');
        const targetHand = nextPlayer === 'player' ? playerHand : botHand;
        
        const drawCards = (count) => {
            for(let i = 0; i < count; i++) {
                if (deck.length > 0) targetHand.push(deck.pop());
            }
        };

        switch(card.value) {
            case 'draw2': drawCards(2); break;
            case 'wild_draw4': drawCards(4); break;
            case 'skip':
            case 'reverse': if (!isFirstCard) setTimeout(switchTurn, 50); break;
        }

        if (isFirstCard && ['draw2', 'skip', 'reverse'].includes(card.value)) {
            currentPlayer = 'bot';
        }
    }

    function checkWinCondition() {
        if (playerHand.length === 0) { endRound(true); return true; }
        if (botHand.length === 0) { endRound(false); return true; }
        return false;
    }
    
    function endRound(playerWon) {
        if (playerWon) {
            playerBalance += (currentBet * 2);
            gameMessageElement.textContent = `Selamat! Anda memenangkan $${currentBet}!`;
        } else {
            gameMessageElement.textContent = `Sayang sekali! Anda kehilangan $${currentBet}.`;
        }
        if (playerBalance <= 0) {
            gameOverOverlay.classList.add('active');
        } else {
            setTimeout(() => {
                bettingOverlay.classList.add('active');
                updateBalanceUI();
            }, 3000);
        }
    }
    
    function restartGame() {
        playerBalance = 5000;
        gameOverOverlay.classList.remove('active');
        initializeGame();
    }

    // =================================================================
    // BAGIAN 5: FUNGSI RENDER & AKSI UI
    // =================================================================

    function createCardElement(card) {
        const el = document.createElement('div');
        el.classList.add('card');
        let imageName = '';
        const colorForImage = card.originalColor; // Selalu gunakan warna asli untuk nama file
        if (card.value === 'draw2') imageName = `${colorForImage}_plus2.png`;
        else if (card.value === 'wild') imageName = 'wild.png';
        else if (card.value === 'wild_draw4') imageName = 'plus_4.png';
        else imageName = `${colorForImage}_${card.value}.png`;
        el.style.backgroundImage = `url('assets/cards/${imageName}')`;
        el.dataset.color = card.color;
        el.dataset.value = card.value;
        el.dataset.originalColor = card.originalColor; // Simpan info warna asli
        return el;
    }

    function renderHand(hand, element, isPlayer) {
        element.innerHTML = '';
        hand.forEach(card => {
            const cardEl = isPlayer ? createCardElement(card) : document.createElement('div');
            if (!isPlayer) cardEl.classList.add('card', 'facedown');
            element.appendChild(cardEl);
        });
    }

    function renderDiscardPile() {
        discardPileElement.innerHTML = '';
        const topCard = discardPile[discardPile.length - 1];
        if (topCard) discardPileElement.appendChild(createCardElement(topCard));
    }
    
    function renderAll() {
        renderHand(playerHand, playerHandElement, true);
        renderHand(botHand, botHandElement, false);
        renderDiscardPile();
        deckCounterElement.textContent = `DECK (${deck.length})`;
        playerBalanceElement.textContent = `$${playerBalance}`;
    }

    function initializeGame() {
        currentBalanceElement.textContent = playerBalance;
        betInputElement.max = playerBalance;
        betInputElement.value = 100;
        bettingOverlay.classList.add('active');
    }

    // Event Listeners
    startRoundBtn.addEventListener('click', startRound);
    playerHandElement.addEventListener('click', (e) => {
        if (e.target.classList.contains('card')) {
             playCard({
                value: e.target.dataset.value,
                color: e.target.dataset.color,
                originalColor: e.target.dataset.originalColor
            }, 'player');
        }
    });
    deckElement.addEventListener('click', () => { if (currentPlayer === 'player') switchTurn(); });
    unoButton.addEventListener('click', handleUnoButtonClick);
    restartGameBtn.addEventListener('click', restartGame);
    colorChoices.addEventListener('click', handleColorChoice);

    initializeGame();
});