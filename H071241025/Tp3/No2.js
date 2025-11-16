const readline = require("readline");

    const rl = readline.createInterface({ 
        input: process.stdin, 
        output: process.stdout 
    });

    function tanya() {
        rl.question("Masukkan harga barang: ", (harga) => {
            const hargaBarang = parseFloat(harga);
            
            if (isNaN(hargaBarang)) { 
                console.log("Angka tidak valid.")
                tanya();
            } else {  
                rl.question("Masukkan jenis barang (Elektronik, Pakaian, Makanan, Lainnya): ", (jenis) => {
                    const jenisBarang = jenis.trim().toLowerCase();
                    let diskon = 0;
                    
                    if (jenisBarang === "elektronik") {
                        diskon = 0.10;
                    } else if (jenisBarang === "pakaian") {
                        diskon = 0.20;
                    } else if (jenisBarang === "makanan") {
                        diskon = 0.05;
                    } else {
                        diskon = 0;
                    }
                    
                    const hargaAkhir = hargaBarang - (hargaBarang * diskon);
                    console.log("Harga awal: Rp " + harga);
                    console.log("Diskon: " + (diskon * 100) + "%")
                    console.log("Harga setelah diskon: Rp " + hargaAkhir);
                    
                    rl.close();
                });
            }
        });
    }
tanya();