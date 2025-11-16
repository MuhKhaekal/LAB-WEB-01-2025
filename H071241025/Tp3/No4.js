const readline = require("readline");

    const rl = readline.createInterface({
        input: process.stdin,
        output: process.stdout
    });

    let angkaRandom = Math.floor(Math.random() * 100) + 1;
    let percobaan = 0;

    function tanya() {
        rl.question("Masukkan salah satu dari angka 1 sampai 100: ", (angka) => {
            let tebakan = parseInt(angka);
            percobaan++

            if (tebakan < angkaRandom) {
                console.log("Terlalu rendah! Coba lagi.")
                tanya();
            } else if (tebakan > angkaRandom) {
                console.log("Terlalu tinggi! Coba lagi.")
                tanya();
            } else if (isNaN(tebakan)) {
                console.log("Masukkan sebuah angka!")
                tanya();
            } else {
                console.log("Selamat! Kamu berhasil menebak angka " + angkaRandom + " dengan benar.")
                console.log("Sebanyak " + percobaan + "x percobaan.")
                rl.close();
            }
        });
    }
tanya();
        