<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fish extends Model
{
    use HasFactory;

    // Secara eksplisit memberi tahu Laravel nama tabelnya.
    protected $table = 'fishes';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // Daftarkan semua kolom yang BOLEH diisi melalui form
    protected $fillable = [
        'name',
        'rarity',
        'base_weight_min',
        'base_weight_max',
        'sell_price_per_kg',
        'catch_probability',
        'description',
    ];
}
