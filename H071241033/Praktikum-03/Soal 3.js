const readline = require('readline');
const rl = readline.createInterface({ input: process.stdin, output: process.stdout });

let hari = ["senin", "selasa", "rabu", "kamis", "jumat", "sabtu", "minggu"];

function imajiner (hariAwal, n) {
    let indexHari = hari.indexOf(hariAwal);
    let indexHariSelanjutnya = (indexHari + n) % 7;

    console.log(`Output: ${n} hari setelah ${hariAwal} adalah ${hari[indexHariSelanjutnya]}.`);
}

rl.question("Masukkan hari: ", (hariAwal) => {
    rl.question("Masukkan hari yang akan datang: ", (n) => {
        hariAwal = hariAwal.toLowerCase();
        n = Number(n);

        if (n < 0) {
            console.log("Jumlah hari tidak boleh negatif!");
            return;
        }
        if (isNaN(n)) {
            console.log("Jumlah hari harus berupa angka!");
            return;
        }
        if (!hari.includes(hariAwal)) {
            console.log("Hari tidak dikenali!");
            return;
        }

        imajiner(hariAwal, n);
        rl.close();
    })
})