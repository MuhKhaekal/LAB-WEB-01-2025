const readline = require("readline");

    const rl = readline.createInterface({
        input: process.stdin,
        output: process.stdout
    });

    const namaHari = ["senin", "selasa", "rabu", "kamis", "jumat", "sabtu", "minggu"]

    function tanya() {
        rl.question("Masukkan hari: ", (hari) => {
            const hariInput = hari.trim().toLowerCase();

            if (namaHari.includes(hariInput)) { 
                rl.question("Masukkan hari yang akan datang: ", (jumlahHari) => {
                    const n = parseInt(jumlahHari);

                    if (isNaN(n)) {
                        console.log("Angka tidak valid.")
                        tanya();
                    } else {
                        let indexHari = namaHari.indexOf(hariInput); 
                        let indexBaru = (indexHari + n) % 7;
                        let hasil = namaHari[indexBaru];
                            
                        console.log(jumlahHari + " hari setelah " + hari + " adalah " + hasil);
                        rl.close();
                    } 
                });
            } else {
                console.log("Hari tidak valid.");
                tanya();
            }
        });
    }
tanya();