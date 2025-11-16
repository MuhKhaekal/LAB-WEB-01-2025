const readline = require('readline');
const rl = readline.createInterface({ input: process.stdin, output: process.stdout });

let arrJenis = {
    "elektronik": 10,
    "pakaian": 20,
    "makanan": 5,
}

function getDiskon(jenisBarang, harga) {
    jenisBarang = jenisBarang.toLowerCase();
    harga = Number(harga);

    if (!arrJenis.hasOwnProperty(jenisBarang)) {
        console.log(`Jenis barang "${jenisBarang}" tidak dikenali!`);
        return;
    }

    if (isNaN(harga) || harga <= 0) {
        console.log("Harga harus berupa angka positif!");
        return;
    }

    let diskon = arrJenis[jenisBarang];
    let hargaDiskon = harga - (harga * diskon) / 100;

    console.log(`\nHarga awal: Rp ${harga}`);
    console.log(`Diskon: ${diskon}%`);
    console.log(`Harga setelah diskon: Rp ${hargaDiskon}`);
}

rl.question("Masukkan harga barang: ", (harga) => {
    rl.question("Masukkan jenis barang (Elektronik, Pakaian, Makanan, Lainnya): ", (jenis) => {
        getDiskon(jenis, harga);
        rl.close();
    });
});
