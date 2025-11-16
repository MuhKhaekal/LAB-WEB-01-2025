const COLORS = ['red', 'blue', 'green', 'yellow'];
const ACTIONS = ['skip', 'reverse', 'plus2'];

let deck = [];
let playerHand = [];
let botHand = [];
let discardPile = [];
let currentPlayer = 'player';
let balance = 5000;
let currentBet = 0;
let gameActive = false;
let unoTimer = null;
let unoTimeLeft = 0;
let playerCalledUno = false;
let botCalledUno = false;
let playerNeedsUno = false;
let botNeedsUno = false;
let pendingWildCard = null;

function createDeck() { // buat tumpukan kartu
    deck = [];
    COLORS.forEach(color => {
        deck.push({ color, value: '0', type: 'number' });
        for (let i = 1; i <= 9; i++) {
            deck.push({ color, value: String(i), type: 'number' });
            deck.push({ color, value: String(i), type: 'number' });
        }
        ACTIONS.forEach(action => {
            deck.push({ color, value: action, type: 'action' });
            deck.push({ color, value: action, type: 'action' });
        });
    });
    for (let i = 0; i < 4; i++) {
        deck.push({ color: 'wild', value: 'wild', type: 'wild' });
        deck.push({ color: 'wild', value: 'plus4', type: 'wild' });
    }
    shuffleDeck();
}

function shuffleDeck() { // acak urutan kartu deck
    for (let i = deck.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [deck[i], deck[j]] = [deck[j], deck[i]];
    }
}

function startGame() { // mulai ronde
    const betInput = document.getElementById('bet-input');
    const bet = parseInt(betInput.value);

    if (!bet || bet < 100) {
        showMessage('Taruhan minimal $100!', 'error');
        return;
    }

    if (bet > balance) {
        showMessage('Saldo tidak cukup!', 'error');
        return;
    }

    currentBet = bet;
    gameActive = true;

    document.getElementById('bet-section').style.display = 'none';
    document.getElementById('bot-section').style.display = 'block';
    document.getElementById('play-area').style.display = 'flex';
    document.getElementById('player-section').style.display = 'block';
    document.getElementById('uno-section').style.display = 'block';

    createDeck();
    playerHand = [];
    botHand = [];
    discardPile = [];
    playerCalledUno = false;
    botCalledUno = false;

    for (let i = 0; i < 7; i++) {
        playerHand.push(deck.pop());
        botHand.push(deck.pop());
    }

    let firstCard = deck.pop();
    while (firstCard.type === 'wild') {
        deck.unshift(firstCard);
        shuffleDeck();
        firstCard = deck.pop();
    }
    discardPile.push(firstCard);

    currentPlayer = 'player';
    renderGame();
    showMessage('Permainan dimulai! Giliran Anda.', 'info');
    checkUnoStatus();
}

function getCardImagePath(card) { // path gambar kartu
    if (card.value === 'back' || card.type === 'back') {
        return 'assets/card_back.png';
    }
    if (card.value === 'wild') {
        return 'assets/wild.png';
    }
    if (card.value === 'plus4') {
        return 'assets/plus_4.png';
    }

    let filename = `${card.color}_${card.value}`;

    return `assets/${filename}.png`;
}

function renderGame() { // tampilan game
    document.getElementById('balance').textContent = balance;
    document.getElementById('current-turn').textContent = currentPlayer === 'player' ? 'Anda' : 'Bot';
    document.getElementById('deck-count').textContent = deck.length;
    
    const botCardsDiv = document.getElementById('bot-cards');
    botCardsDiv.innerHTML = '';
    for (let i = 0; i < botHand.length; i++) {
        const cardBack = document.createElement('div');
        cardBack.className = 'bot-card-back';
        cardBack.style.backgroundImage = "url('assets/card_back.png')";
        cardBack.style.backgroundSize = "cover";

        botCardsDiv.appendChild(cardBack);
    }
    document.getElementById('bot-card-count').textContent = botHand.length;

    const playerCardsDiv = document.getElementById('player-cards');
    playerCardsDiv.innerHTML = '';
    playerHand.forEach((card, index) => {
        const cardDiv = document.createElement('div');
        cardDiv.className = 'card';
        cardDiv.style.backgroundImage = `url('${getCardImagePath(card)}')`;
        
        const canPlay = currentPlayer === 'player' && isValidPlay(card);
        if (!canPlay) {
            cardDiv.classList.add('disabled');
        }
        
        if (canPlay) {
            cardDiv.onclick = () => playCard(index);
        }
        
        playerCardsDiv.appendChild(cardDiv);
    });
    document.getElementById('player-card-count').textContent = playerHand.length;

    const topCard = discardPile[discardPile.length - 1];
    const topCardDiv = document.getElementById('top-card');
    topCardDiv.style.backgroundImage = `url('${getCardImagePath(topCard)}')`;

    // tampilan tumpukan kartu
    const deckCard = document.getElementById('deck-card');
    deckCard.style.backgroundImage = "url('assets/card_back.png')";
    deckCard.style.backgroundSize = "cover";
    deckCard.style.backgroundPosition = "center";
    deckCard.style.backgroundRepeat = "no-repeat";
    deckCard.style.textShadow = "0 0 5px rgba(0,0,0,0.7)";

}

function getCardDisplay(card) {
    if (card.value === 'skip') return 'skip';
    if (card.value === 'reverse') return 'reverse';
    if (card.value === 'draw2') return '+2';
    if (card.value === 'wild') return 'WILD';
    if (card.value === 'plus4') return '+4';
    return card.value;
}

function isValidPlay(card) { // cek kartu
    const topCard = discardPile[discardPile.length - 1];
    
    if (card.type === 'wild') {
        if (card.value === 'plus4') {
            const hasMatchingCard = playerHand.some(c => 
                c !== card && (c.color === topCard.color || 
                (c.value === topCard.value && c.type !== 'wild'))
            );
            return !hasMatchingCard;
        }
        return true;
    }

    return card.color === topCard.color || card.value === topCard.value;
}

function playCard(index) { // saat pemain klik kartu
    if (currentPlayer !== 'player' || !gameActive) return;

    const card = playerHand[index];
    
    if (!isValidPlay(card)) {
        showMessage('Kartu tidak bisa dimainkan!', 'error');
        return;
    }

    playerHand.splice(index, 1);

    if (card.type === 'wild') {
        pendingWildCard = card;
        document.getElementById('color-modal').style.display = 'flex';
        return;
    }

    discardPile.push(card);
    
    if (playerHand.length === 0) {
        endRound('player');
        return;
    }

    checkUnoStatus();
    renderGame();

    if (card.value === 'skip' || card.value === 'reverse') {
        showMessage(`Bot dilewati! Giliran Anda lagi.`, 'warning');
        setTimeout(() => {
            currentPlayer = 'player';
            renderGame();
        }, 1000);
    } else if (card.value === 'draw2') {
        for (let i = 0; i < 2; i++) {
            if (deck.length > 0) botHand.push(deck.pop());
        }
        showMessage('Bot mengambil 2 kartu! Giliran Anda lagi.', 'warning');
        setTimeout(() => {
            currentPlayer = 'player';
            renderGame();
        }, 1000);
    } else {
        setTimeout(() => {
            currentPlayer = 'bot';
            renderGame();
            botTurn();
        }, 1000);
    }
}

function selectColor(color) { // pilih warna untuk kartu wild
    document.getElementById('color-modal').style.display = 'none';
    
    if (pendingWildCard) {
        const card = { ...pendingWildCard, color };
        discardPile.push(card);
        
        if (card.value === 'plus4') {
            for (let i = 0; i < 4; i++) {
                if (deck.length > 0) botHand.push(deck.pop());
            }
            showMessage('Bot mengambil 4 kartu! Giliran Anda lagi.', 'warning');
        }
        
        pendingWildCard = null;
        
        if (playerHand.length === 0) {
            endRound('player');
            return;
        }
        
        checkUnoStatus();
        renderGame();
        
        if (card.value === 'plus4') {
            setTimeout(() => {
                currentPlayer = 'player';
                renderGame();
            }, 1000);
        } else {
            setTimeout(() => {
                currentPlayer = 'bot';
                renderGame();
                botTurn();
            }, 1000);
        }
    }
}

function drawCard() { // ambil kartu dari deck
    if (currentPlayer !== 'player' || !gameActive || deck.length === 0) return;

    const drawnCard = deck.pop();
    playerHand.push(drawnCard);
    
    if (isValidPlay(drawnCard)) {
        showMessage(`Anda mengambil ${getCardDisplay(drawnCard)} ${drawnCard.color}. Kartu bisa dimainkan! Klik kartu untuk memainkan atau klik DECK lagi untuk skip.`, 'info');
        renderGame();
    } else {
        showMessage('Anda mengambil 1 kartu dari deck. Kartu tidak bisa dimainkan.', 'info');
        renderGame();
        
        setTimeout(() => {
            currentPlayer = 'bot';
            renderGame();
            botTurn();
        }, 1000);
    }
}

function botTurn() {
    if (!gameActive) return;

    setTimeout(() => {
        let playableCards = botHand.filter(card => isValidPlayForBot(card));
        
        if (playableCards.length > 0) {
            const cardIndex = botHand.indexOf(playableCards[0]);
            const card = botHand.splice(cardIndex, 1)[0];
            
            if (card.type === 'wild') {
                const colorCounts = { red: 0, blue: 0, green: 0, yellow: 0 };
                botHand.forEach(c => {
                    if (c.color !== 'wild') colorCounts[c.color]++;
                });
                const chosenColor = Object.keys(colorCounts).reduce((a, b) => 
                    colorCounts[a] > colorCounts[b] ? a : b
                );
                card.color = chosenColor;
                
                if (card.value === 'plus4') {
                    for (let i = 0; i < 4; i++) {
                        if (deck.length > 0) playerHand.push(deck.pop());
                    }
                    showMessage(`Bot memainkan Wild +4! Anda mengambil 4 kartu! Giliran Bot lagi.`, 'warning');
                } else {
                    showMessage(`Bot memainkan Wild dan memilih warna ${chosenColor}!`, 'info');
                }
            } else {
                showMessage(`Bot memainkan kartu ${getCardDisplay(card)} ${card.color}`, 'info');
            }
            
            discardPile.push(card);
            
            if (botHand.length === 0) {
                endRound('bot');
                return;
            }

            if (botHand.length === 1 && !botCalledUno) {
                setTimeout(() => {
                    const shouldCall = Math.random() > 0.3;
                    if (shouldCall) {
                        botCalledUno = true;
                        showMessage('Bot memanggil UNO!', 'warning');
                    } else {
                        botNeedsUno = true;
                        showMessage('Bot lupa memanggil UNO! Anda bisa memanggil UNO pada bot!', 'warning');
                        document.getElementById('call-uno-opponent').disabled = false;
                    }
                }, 500);
            }

            renderGame();
            checkUnoStatus();
            
            if (card.value === 'skip' || card.value === 'reverse') {
                showMessage(`Anda dilewati! Giliran Bot lagi.`, 'warning');
                setTimeout(() => {
                    currentPlayer = 'bot';
                    renderGame();
                    botTurn();
                }, 1500);
            } else if (card.value === 'draw2') {
                for (let i = 0; i < 2; i++) {
                    if (deck.length > 0) playerHand.push(deck.pop());
                }
                showMessage('Anda mengambil 2 kartu! Giliran Bot lagi.', 'warning');
                setTimeout(() => {
                    currentPlayer = 'bot';
                    renderGame();
                    botTurn();
                }, 1500);
            } else if (card.value === 'plus4') {
                setTimeout(() => {
                    currentPlayer = 'bot';
                    renderGame();
                    botTurn();
                }, 1500);
            } else {
                setTimeout(() => {
                    currentPlayer = 'player';
                    renderGame();
                }, 1500);
            }
        } else {
            if (deck.length > 0) {
                const drawnCard = deck.pop();
                botHand.push(drawnCard);
                
                if (isValidPlayForBot(drawnCard)) {
                    showMessage(`Bot mengambil 1 kartu dan bisa memainkannya!`, 'info');
                    
                    const shouldPlay = Math.random() > 0.3;
                    
                    if (shouldPlay) {
                        setTimeout(() => {
                            const cardIndex = botHand.indexOf(drawnCard);
                            const card = botHand.splice(cardIndex, 1)[0];
                            
                            if (card.type === 'wild') {
                                const colorCounts = { red: 0, blue: 0, green: 0, yellow: 0 };
                                botHand.forEach(c => {
                                    if (c.color !== 'wild') colorCounts[c.color]++;
                                });
                                const chosenColor = Object.keys(colorCounts).reduce((a, b) => 
                                    colorCounts[a] > colorCounts[b] ? a : b
                                );
                                card.color = chosenColor;
                                
                                if (card.value === 'plus4') {
                                    for (let i = 0; i < 4; i++) {
                                        if (deck.length > 0) playerHand.push(deck.pop());
                                    }
                                    showMessage(`Bot memainkan kartu yang baru diambil: Wild +4! Anda mengambil 4 kartu! Giliran Bot lagi.`, 'warning');
                                } else {
                                    showMessage(`Bot memainkan kartu yang baru diambil: Wild ${chosenColor}!`, 'info');
                                }
                            } else {
                                showMessage(`Bot memainkan kartu yang baru diambil: ${getCardDisplay(card)} ${card.color}`, 'info');
                            }
                            
                            discardPile.push(card);
                            
                            if (botHand.length === 0) {
                                endRound('bot');
                                return;
                            }

                            if (botHand.length === 1 && !botCalledUno) {
                                setTimeout(() => {
                                    const shouldCall = Math.random() > 0.3;
                                    if (shouldCall) {
                                        botCalledUno = true;
                                        showMessage('Bot memanggil UNO!', 'warning');
                                    } else {
                                        botNeedsUno = true;
                                        showMessage('Bot lupa memanggil UNO! Anda bisa memanggil UNO pada bot!', 'warning');
                                        document.getElementById('call-uno-opponent').disabled = false;
                                    }
                                }, 500);
                            }

                            renderGame();
                            checkUnoStatus();
                            
                            if (card.value === 'skip' || card.value === 'reverse') {
                                showMessage(`Anda dilewati! Giliran Bot lagi.`, 'warning');
                                setTimeout(() => {
                                    currentPlayer = 'bot';
                                    renderGame();
                                    botTurn();
                                }, 1500);
                            } else if (card.value === 'draw2') {
                                for (let i = 0; i < 2; i++) {
                                    if (deck.length > 0) playerHand.push(deck.pop());
                                }
                                showMessage('Anda mengambil 2 kartu! Giliran Bot lagi.', 'warning');
                                setTimeout(() => {
                                    currentPlayer = 'bot';
                                    renderGame();
                                    botTurn();
                                }, 1500);
                            } else if (card.value === 'plus4') {
                                setTimeout(() => {
                                    currentPlayer = 'bot';
                                    renderGame();
                                    botTurn();
                                }, 1500);
                            } else {
                                setTimeout(() => {
                                    currentPlayer = 'player';
                                    renderGame();
                                }, 1500);
                            }
                        }, 1000);
                    } else {
                        showMessage('Bot mengambil 1 kartu dan memilih untuk skip.', 'info');
                        renderGame();
                        
                        setTimeout(() => {
                            currentPlayer = 'player';
                            renderGame();
                        }, 1500);
                    }
                } else {
                    showMessage('Bot mengambil 1 kartu dari deck. Kartu tidak bisa dimainkan.', 'info');
                    renderGame();
                    
                    setTimeout(() => {
                        currentPlayer = 'player';
                        renderGame();
                    }, 1500);
                }
            }
        }
    }, 1000);
}

function isValidPlayForBot(card) { // cek apakah kartu bot bisa dimainkan
    const topCard = discardPile[discardPile.length - 1];
    
    if (card.type === 'wild') {
        if (card.value === 'plus4') {
            const hasMatchingCard = botHand.some(c => 
                c !== card && (c.color === topCard.color || c.value === topCard.value)
            );
            return !hasMatchingCard;
        }
        return true;
    }

    return card.color === topCard.color || card.value === topCard.value;
}

function checkUnoStatus() { 
    if (playerHand.length === 1 && !playerCalledUno) {
        playerNeedsUno = true;
        startUnoTimer();
    } else if (playerHand.length !== 1) {
        playerNeedsUno = false;
        playerCalledUno = false;
        stopUnoTimer();
    }

    if (botHand.length !== 1) {
        botNeedsUno = false;
        botCalledUno = false;
        document.getElementById('call-uno-opponent').disabled = true;
    }

    document.getElementById('uno-button').disabled = playerHand.length !== 1 || playerCalledUno;
}

function startUnoTimer() { 
    stopUnoTimer();
    unoTimeLeft = 5;
    document.getElementById('uno-timer').textContent = `⏱️ ${unoTimeLeft}s`;
    
    unoTimer = setInterval(() => {
        unoTimeLeft--;
        document.getElementById('uno-timer').textContent = `⏱️ ${unoTimeLeft}s`;
        
        if (unoTimeLeft <= 0) {
            stopUnoTimer();
            if (!playerCalledUno && playerNeedsUno) {
                for (let i = 0; i < 2; i++) {
                    if (deck.length > 0) playerHand.push(deck.pop());
                }
                showMessage('Anda lupa memanggil UNO! Penalti +2 kartu!', 'error');
                playerNeedsUno = false;
                renderGame();
            }
        }
    }, 1000);
}

function stopUnoTimer() {
    if (unoTimer) {
        clearInterval(unoTimer);
        unoTimer = null;
    }
    document.getElementById('uno-timer').textContent = '';
}

function callUno() {
    if (playerHand.length === 1 && !playerCalledUno) {
        playerCalledUno = true;
        playerNeedsUno = false;
        stopUnoTimer();
        showMessage('UNO! Anda tinggal 1 kartu!', 'info');
        document.getElementById('uno-button').disabled = true;
    }
}

function callUnoOnOpponent() {
    if (botNeedsUno && !botCalledUno) {
        for (let i = 0; i < 2; i++) {
            if (deck.length > 0) botHand.push(deck.pop());
        }
        showMessage('Anda memanggil UNO pada bot! Bot mendapat penalti +2 kartu!', 'info');
        botNeedsUno = false;
        document.getElementById('call-uno-opponent').disabled = true;
        renderGame();
    }
}

function endRound(winner) {
    gameActive = false;
    stopUnoTimer();
    
    if (winner === 'player') {
        balance += currentBet;
        showMessage(`Selamat! Anda menang! +${currentBet}`, 'info');
    } else {
        balance -= currentBet;
        showMessage(`Bot menang! -${currentBet}`, 'error');
    }

    document.getElementById('balance').textContent = balance;

    setTimeout(() => {
        if (balance < 100) {
            document.getElementById('game-over-title').textContent = 'GAME OVER';
            document.getElementById('game-over-message').textContent = 
                `Saldo Anda habis! Saldo akhir: ${balance}. Anda akan memulai dengan saldo baru $5000.`;
            document.getElementById('game-over-modal').style.display = 'flex';
        } else {
            document.getElementById('game-over-title').textContent = winner === 'player' ? ' ANDA MENANG!' : 'BOT MENANG!';
            document.getElementById('game-over-message').textContent = 
                `Saldo Anda sekarang: ${balance}. Main lagi?`;
            document.getElementById('game-over-modal').style.display = 'flex';
        }
    }, 2000);
}

function resetGame() {
    document.getElementById('game-over-modal').style.display = 'none';
    
    if (balance < 100) {
        balance = 5000;
        document.getElementById('balance').textContent = balance;
    }

    gameActive = false;
    currentPlayer = 'player';
    playerHand = [];
    botHand = [];
    discardPile = [];
    deck = [];
    currentBet = 0;
    playerCalledUno = false;
    botCalledUno = false;
    playerNeedsUno = false;
    botNeedsUno = false;
    pendingWildCard = null;
    stopUnoTimer();

    document.getElementById('bet-section').style.display = 'block';
    document.getElementById('bot-section').style.display = 'none';
    document.getElementById('play-area').style.display = 'none';
    document.getElementById('player-section').style.display = 'none';
    document.getElementById('uno-section').style.display = 'none';
    document.getElementById('bet-input').value = '';
    
    showMessage('Masukkan taruhan untuk memulai permainan!', 'info');
}

function showMessage(msg, type) {
    const messageDiv = document.getElementById('message');
    messageDiv.textContent = msg;
    messageDiv.className = `message ${type}`;
}

window.onload = () => {
    showMessage('Selamat datang di UNO Game! Masukkan taruhan untuk mulai bermain.', 'info');
};