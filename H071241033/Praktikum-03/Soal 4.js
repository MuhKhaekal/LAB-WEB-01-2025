const readline = require('readline');
const rl = readline.createInterface({input: process.stdin, output: process.stdout});

function tanya(prompt) {
    return new Promise(resolve => rl.question(prompt, resolve));
}

async function main() {
    const angkaRahasia = Math.floor(Math.random() * 100) + 1;
    let jumlahTebakan = 0;
    let tebakan = 0;

    console.log("Angka rahasia: " + angkaRahasia);

    while (tebakan !== angkaRahasia) {
        tebakan = Number(await tanya("\nMasukkan salah satu dari angka 1 sampai 100: "));
        jumlahTebakan++;

        if (isNaN(tebakan) || tebakan < 1 || tebakan > 100) {
            console.log("Masukkan angka valid antara 1 sampai 100!");
        } else if (tebakan > angkaRahasia) {
            console.log("Terlalu tinggi! Coba lagi.");
        } else if (tebakan < angkaRahasia) {
            console.log("Terlalu rendah! Coba lagi.");
        }
    }

    console.log(`\nBenar! Kamu menebak angka ${angkaRahasia} dalam ${jumlahTebakan} ksli percobaan.`);
    rl.close();
}

main();
