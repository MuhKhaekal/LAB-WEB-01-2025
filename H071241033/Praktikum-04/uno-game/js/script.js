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
    // BAGIAN 3: INISIALISASI GAME
    // =================================================================

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