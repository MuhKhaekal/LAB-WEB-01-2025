// Menunggu hingga seluruh konten halaman HTML dimuat sebelum menjalankan script
document.addEventListener('DOMContentLoaded', () => {

    // =================================================================
    // BAGIAN 1: KONSTANTA & VARIABEL STATE
    // =================================================================

    // Definisi dasar kartu
    const COLORS = ['red', 'yellow', 'green', 'blue'];
    const VALUES = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'skip', 'reverse', 'draw2'];
    const WILD_VALUES = ['wild', 'wild_draw4'];

    // Referensi ke elemen-elemen HTML (DOM Elements)
    const botHandElement = document.getElementById('bot-hand');
    const playerHandElement = document.getElementById('player-hand');
    const discardPileElement = document.getElementById('discard-pile');
    const deckElement = document.getElementById('deck');
    const deckCounterElement = document.getElementById('deck-counter'); // <-- TAMBAHKAN INI
    const gameMessageElement = document.getElementById('game-message');
    const playerBalanceElement = document.getElementById('player-balance');
    const startRoundBtn = document.getElementById('start-round-btn');
    const betInputElement = document.getElementById('bet-input');
    const currentBalanceElement = document.getElementById('current-balance');
    const bettingOverlay = document.getElementById('betting-overlay');

    // Variabel untuk menyimpan state (kondisi) permainan
    let deck = [];
    let playerHand = [];
    let botHand = [];
    let discardPile = [];
    let currentPlayer = 'player'; // Bisa 'player' atau 'bot'
    let playerBalance = 5000;
    let currentBet = 0;


    // =================================================================
    // BAGIAN 2: FUNGSI INTI PERMAINAN
    // =================================================================

    /**
     * Membuat satu set dek kartu UNO standar (108 kartu).
     * Aturan: 1 kartu '0', 2 kartu '1-9', 2 kartu aksi (skip, reverse, draw2) per warna.
     * Ditambah 4 kartu 'wild' dan 4 kartu 'wild_draw4'.
     */
    function createDeck() {
        const newDeck = [];
        // Membuat kartu berwarna
        for (const color of COLORS) {
            for (const value of VALUES) {
                newDeck.push({ color, value });
                // Kartu 1-9, skip, reverse, draw2 ada dua per warna
                if (value !== '0') {
                    newDeck.push({ color, value });
                }
            }
        }
        // Membuat kartu wild
        for (let i = 0; i < 4; i++) {
            newDeck.push({ color: 'wild', value: 'wild' });
            newDeck.push({ color: 'wild', value: 'wild_draw4' });
        }
        return newDeck;
    }

    /**
     * Mengocok dek kartu menggunakan algoritma Fisher-Yates.
     */
    function shuffleDeck(deck) {
        for (let i = deck.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [deck[i], deck[j]] = [deck[j], deck[i]]; // Tukar posisi kartu
        }
    }

    // =================================================================
    // BAGIAN 2: FUNGSI INTI PERMAINAN (Lanjutan)
    // =================================================================

    /**
     * Memulai satu ronde permainan.
     */
    function startRound() {
        // 1. Ambil nilai taruhan
        currentBet = parseInt(betInputElement.value);
        if (isNaN(currentBet) || currentBet < 100 || currentBet > playerBalance) {
            alert("Nilai taruhan tidak valid!");
            return;
        }

        // 2. Kurangi saldo & update UI
        playerBalance -= currentBet;
        updateBalanceUI();
        bettingOverlay.classList.remove('active');
        gameMessageElement.textContent = "Ronde dimulai! Giliran Anda.";

        // 3. Siapkan dek & tangan pemain
        deck = createDeck();
        shuffleDeck(deck);
        playerHand = [];
        botHand = [];
        discardPile = [];

        // 4. Bagikan 7 kartu ke masing-masing pemain
        for (let i = 0; i < 7; i++) {
            playerHand.push(deck.pop());
            botHand.push(deck.pop());
        }

        // 5. Letakkan 1 kartu awal di discard pile
        let firstCard = deck.pop();
        // Aturan: Kartu pertama tidak boleh Wild Draw 4
        while (firstCard.value === 'wild_draw4') {
            deck.push(firstCard); // Kembalikan ke dek
            shuffleDeck(deck);
            firstCard = deck.pop();
        }
        discardPile.push(firstCard);
        
        // 6. Tampilkan semua perubahan ke layar
        renderAll();
    }
    
    // =================================================================
    // BAGIAN 3: FUNGSI RENDER (MENAMPILKAN KE LAYAR)
    // =================================================================
    
    /**
     * Membuat elemen HTML untuk sebuah kartu.
     */
    /**
     * Membuat elemen HTML untuk sebuah kartu.
     * -- VERSI UPDATE SESUAI NAMA FILE ANDA --
     */
    function createCardElement(card) {
        const cardElement = document.createElement('div');
        cardElement.classList.add('card');
        
        let imageName = '';

        // Logika untuk mencocokkan nama file Anda
        if (card.value === 'draw2') {
            imageName = `${card.color}_plus2.png`; // Menggunakan nama file _plus2.png
        } else if (card.value === 'wild') {
            imageName = 'wild.png'; // Menggunakan nama file wild.png
        } else if (card.value === 'wild_draw4') {
            imageName = 'plus_4.png'; // Menggunakan nama file plus_4.png
        } else {
            // Untuk semua kartu lainnya, gunakan format standar
            imageName = `${card.color}_${card.value}.png`;
        }

        cardElement.style.backgroundImage = `url('assets/cards/${imageName}')`;

        // Menambahkan data ke elemen untuk identifikasi saat diklik nanti
        cardElement.dataset.color = card.color;
        cardElement.dataset.value = card.value;
        
        return cardElement;
    }
    
    /**
     * Menampilkan tangan (kartu) pemain atau bot ke layar.
     */
    function renderHand(hand, element, isPlayer) {
        element.innerHTML = ''; // Kosongkan area tangan terlebih dahulu
        hand.forEach(card => {
            if (isPlayer) {
                const cardElement = createCardElement(card);
                element.appendChild(cardElement);
            } else {
                // Untuk Bot, tampilkan kartu tertutup
                const cardElement = document.createElement('div');
                cardElement.classList.add('card', 'facedown');
                element.appendChild(cardElement);
            }
        });
    }
    
    /**
     * Menampilkan kartu teratas di discard pile.
     */
    function renderDiscardPile() {
        discardPileElement.innerHTML = ''; // Kosongkan dulu
        const topCard = discardPile[discardPile.length - 1];
        if (topCard) {
            const cardElement = createCardElement(topCard);
            discardPileElement.appendChild(cardElement);
        }
    }
    
    /**
     * Helper function untuk update tampilan saldo.
     */
    function updateBalanceUI() {
        playerBalanceElement.textContent = `$${playerBalance}`;
        currentBalanceElement.textContent = playerBalance;
        betInputElement.max = playerBalance;
    }

    /**
     * Memanggil semua fungsi render untuk mengupdate seluruh tampilan game.
     */
    function renderAll() {
        renderHand(playerHand, playerHandElement, true);
        renderHand(botHand, botHandElement, false);
        renderDiscardPile();
        // Update jumlah kartu di deck (opsional tapi bagus)
        deckElement.textContent = `DECK (${deck.length})`;
    }

    // =================================================================
    // BAGIAN 4: EVENT LISTENERS
    // =================================================================

    startRoundBtn.addEventListener('click', startRound);


    // =================================================================
    // BAGIAN 3: INISIALISASI GAME
    // =================================================================

    startRoundBtn.addEventListener('click', startRound);

    function initializeGame() {
        // Update tampilan saldo di UI
        playerBalanceElement.textContent = `$${playerBalance}`;
        currentBalanceElement.textContent = playerBalance;
        betInputElement.max = playerBalance; // Batas maks taruhan adalah saldo
        betInputElement.value = 100; // Reset nilai taruhan ke minimum
        bettingOverlay.classList.add('active'); // Tampilkan overlay taruhan
    }

    // Menjalankan game untuk pertama kali saat halaman dimuat
    initializeGame();

});