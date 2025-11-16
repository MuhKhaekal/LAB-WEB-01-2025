<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TourismController extends Controller
{
    public function home() {
        $data = [
            'title' => 'Beranda',
            'city' =>  'Malang',
            'description' => 'Jelajahi keindahan Malang dan temukan pengalaman tak terlupakan.'
        ];

        return view('home', $data);
    }

    public function destinasi() {
        $data = [
            'title' => 'Destinasi Wisata',
            'destinations' => [
                [
                    'name' => 'Gunung Bromo',
                    'description' => 'Gunung berapi aktif yang terkenal dengan keindahan sunrise dan hamparan pasir berbisiknya. Salah satu ikon wisata Jawa Timur yang wajib dikunjungi.',
                    'image' => 'bromo.png'
                ],
                [
                    'name' => 'Coban Rondo',
                    'description' => 'Air terjun setinggi 84 meter yang dikelilingi hutan pinus. Tempat yang sempurna untuk menikmati kesegaran alam dan udara pegunungan.',
                    'image' => 'coban-rondo.png'
                ],
                [
                    'name' => 'Jatim Park 2',
                    'description' => 'Taman rekreasi dengan konsep edukasi yang menampilkan Museum Satwa, Batu Secret Zoo, dan berbagai wahana menarik untuk keluarga.',
                    'image' => 'jatim-park.png'
                ],
                [
                    'name' => 'Kampung Warna-Warni',
                    'description' => 'Kampung di lereng Gunung Panderman yang rumah-rumahnya dicat dengan warna-warni cerah, menciptakan panorama yang Instagramable.',
                    'image' => 'kampung-warna-warni.jpg'
                ],
                [
                    'name' => 'Florawisata San Terra de Lafonte',
                    'description' => 'Taman bunga luas dengan berbagai jenis flora yang indah, lengkap dengan spot foto menarik dan kafe untuk bersantai.',
                    'image' => 'florawisata-san-terra.png
'
                ],
                [
                    'name'=> 'Air Terjun Tumpak Sewu',
                    'description' => 'Air terjun spektakuler yang membentang lebar dengan pemandangan yang menakjubkan. Sering disebut sebagai "Niagara-nya Jawa Timur".',
                    'image' => 'air-terjun-tupaksewu.png'
                ]
            ]
        ];
        
        return view('destinasi', $data);
    }

    public function kuliner() {
        $data = [
            'title' => 'Kuliner Khas',
            'foods' => [
                [
                    'name' => 'Bakso Malang',
                    'description' => 'Bakso khas Malang dengan isian beragam seperti tahu, siomay, dan bakwan goreng. Kuahnya yang gurih dan kental menjadi ciri khasnya.',
                    'image' => 'bakso-malang.png'
                ],
                [
                    'name' => 'Rawon',
                    'description' => 'Sup daging berkuah hitam khas Jawa Timur dengan bumbu kluwak yang kaya rempah. Disajikan dengan nasi, tauge, dan sambal.',
                    'image' => 'rawon.png'
                ],
                [
                    'name' => 'Cwie Mie Malang',
                    'description' => 'Mie khas Malang dengan pangsit goreng, daging ayam cincang, dan kuah kaldu yang lezat. Perpaduan tekstur dan rasa yang unik.',
                    'image' => 'cwie-mie.png'
                ],
                [
                    'name' => 'Apel Malang',
                    'description' => 'Buah apel khas Malang yang terkenal segar dan manis. Bisa dinikmati langsung atau diolah menjadi berbagai olahan seperti keripik dan jus.',
                    'image' => 'apel-malang.png'
                ],
                [
                    'name' => 'Orem-Orem',
                    'description' => 'Hidangan tradisional berupa potongan tahu dan tempe yang dimasak dengan bumbu kacang khas. Cocok sebagai lauk pendamping nasi.',
                    'image' => 'orem-orem.png'
                ],
                [
                    'name' => 'Sate Kelinci',
                    'description' => 'Sate yang terbuat dari daging kelinci, disajikan dengan bumbu kacang atau kecap manis. Rasanya yang gurih dan teksturna yang lembut membuatnya istimewa.',
                    'image' => 'sate-kelinci.png'
                ]
            ]
        ];
        
        return view('kuliner', $data);
    }

    public function galeri(){
        $data = [
            'title' => 'Galeri Foto',
            'galleries' => [
                ['image' => 'galeri-1.png', 'caption' => 'Alun-alun Kota Malang'],
                ['image' => 'galeri-2.png', 'caption' => 'Museum Angkut'],
                ['image' => 'galeri-3.png', 'caption' => 'Tugu Malang'],
                ['image' => 'galeri-4.png', 'caption' => 'Coban Pelangi'],
                ['image' => 'galeri-5.png', 'caption' => 'Selecta'],
                ['image' => 'galeri-6.png', 'caption' => 'Pantai Balekambang'],
            ]
        ];
        
        return view('galeri', $data);
    }

    public function kontak(){
        $data = [
            'title' => 'Kontak Kami',
            'contact_info' => [
                'address' => 'Jl. Tugu No. 1, Kota Malang, Jawa Timur 65119',
                'phone' => '(0341) 551234',
                'email' => 'info@wisatamalang.id',
                'whatsapp' => '+62 812-3456-7890'
            ]
        ];
        
        return view('kontak', $data);
    }
}
