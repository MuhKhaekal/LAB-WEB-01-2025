<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class GaleriController extends Controller
{

    public function galeri()
    {
        $galleryImages = [
            ['image' => 'malioboro-night.jpg',   'title' => 'Malioboro at Night',   'delay' => '100'],
            ['image' => 'gudeg-bg.jpg',          'title' => 'Gudeg',                'delay' => '150'],
            ['image' => 'ramayana-ballet.webp',  'title' => 'Ramayana Ballet',      'delay' => '200'],
            ['image' => 'sate-klatak.jpeg',      'title' => 'Sate Klatak',          'delay' => '250'],

            ['image' => 'alun-alun-kidul.jpg',   'title' => 'Alun-Alun Kidul',      'delay' => '100'],
            ['image' => 'bakmi-jawa.jpg',        'title' => 'Bakmi Jawa',           'delay' => '150'],
            ['image' => 'ullen-sentalu.jpg',     'title' => 'Ullen Sentalu',        'delay' => '200'],
            ['image' => 'kasongan-village.jpg',  'title' => 'Kasongan Village',     'delay' => '250'],

            ['image' => 'tugu-jogja.jpg',        'title' => 'Tugu Jogja',           'delay' => '100'],
            ['image' => 'pasar-beringharjo.jpg', 'title' => 'Pasar Beringharjo',    'delay' => '150'],
            ['image' => 'heha-sky-view.jpeg',    'title' => 'Heha Sky View',        'delay' => '200'],
            ['image' => 'batik.jpg',             'title' => 'Batik',                'delay' => '250'],

            ['image' => 'angkringan.jpg',        'title' => 'Angkringan',           'delay' => '100'],
            ['image' => 'candi-prambanan-2.jpg', 'title' => 'Candi Prambanan',      'delay' => '150'],
            ['image' => 'goa-jomblang.png',      'title' => 'Goa Jomblang',         'delay' => '200'],
            ['image' => 'prambanan-relief.jpg',  'title' => 'Prambanan Relief',     'delay' => '250'],

            ['image' => 'tugu-jogja-2.jpg',      'title' => 'Tugu Jogja',           'delay' => '100'],
            ['image' => 'keraton-yogyakarta.jpg','title' => 'Keraton Yogyakarta',   'delay' => '150'],
            ['image' => 'heha-sky-view-2.webp',  'title' => 'Heha Sky View',        'delay' => '200'],
            ['image' => 'gudeg.jpeg',            'title' => 'Gudeg Jogja',          'delay' => '250'],

            ['image' => 'malioboro-siang.jpg',   'title' => 'Malioboro at Day',     'delay' => '100'],
            ['image' => 'merapi-lava-tour.jpg',  'title' => 'Merapi Lava Tour',     'delay' => '150'],
            ['image' => 'pantai-indrayanti.webp','title' => 'Pantai Indrayanti',    'delay' => '200'],
            ['image' => 'candi-prambanan-3.webp','title' => 'Candi Prambanan',      'delay' => '250'],

            ['image' => 'pantai-timang.jpg',     'title' => 'Pantai Timang',        'delay' => '100'],
            ['image' => 'plengkung-gading.jpg', 'title' => 'Plengkung Gading',    'delay' => '150'],
            ['image' => 'vredeburg-fort.jpg',    'title' => 'Vredeburg Fort',       'delay' => '200'],
            ['image' => 'tugu-jogja-3.jpg',      'title' => 'Tugu Jogja',           'delay' => '250'],

            ['image' => 'taman-sari.jpg',        'title' => 'Taman Sari',           'delay' => '100'],
            ['image' => 'gudeg-jogja.png',       'title' => 'Gudeg',                'delay' => '150']
        ];

        return view('galeri', compact('galleryImages'));
    }
}
