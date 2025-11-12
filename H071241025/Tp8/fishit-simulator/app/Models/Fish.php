<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fish extends Model
{
    protected $table = "fishes";

    protected $fillable = [
        'name',
        'rarity',
        'base_weight_min',
        'base_weight_max',
        'sell_price_per_kg',
        'catch_probability',
        'description'
    ];

    protected $casts = [
        'base_weight_min'=> 'decimal:2',
        'base_weight_max'=> 'decimal:2',
        'catch_probability'=> 'decimal:2'
    ];

    public function getFormattedPriceAttribute(): string{
        return number_format($this->sell_price_per_kg,0,',','.') . ' Coins/kg';
    }

    public function getWeightRangeAttribute(): string {
        return $this->base_weight_min . ' - ' . $this->base_weight_max . ' kg';
    }

    public function scopeByRarity($query, $rarity) {
        if ($rarity) {
            return $query->where('rarity', $rarity);
        }
        return $query;
    }

    public function scopeSortBy($query, $sortBy, $order = 'asc') {
        if ($sortBy) {
            return $query->orderBy($sortBy, $order);
        }
        return $query->latest();
    }
}
