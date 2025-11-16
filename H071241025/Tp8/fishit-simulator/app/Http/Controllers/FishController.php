<?php

namespace App\Http\Controllers;

use App\Models\Fish;
use Illuminate\Http\Request;

class FishController extends Controller
{
    public function index(Request $request)
    {
        $query = Fish::query();

        // atur sesuai filter 
        if ($request->has('rarity') && $request->rarity != '') {
            $query->byRarity($request->rarity);
        }

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('name', 'LIKE', "%{$search}%");
        }

        if ($request->has('sort_by') && $request->sort_by != '') {
            $order = $request->get('order', 'asc');
            $query->sortBy($request->sort_by, $order);
        } else {
            $query->latest();
        }

        $fishes = $query->paginate(10);
        
        $rarities = ['Common', 'Uncommon', 'Rare', 'Epic', 'Legendary', 'Mythic', 'Secret'];

        return view('fishes.index', compact('fishes', 'rarities'));
    }

    public function create()
    {
        $rarities = ['Common', 'Uncommon', 'Rare', 'Epic', 'Legendary', 'Mythic', 'Secret'];
        return view('fishes.create', compact('rarities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'rarity' => 'required|in:Common,Uncommon,Rare,Epic,Legendary,Mythic,Secret',
            'base_weight_min' => 'required|numeric|min:0',
            'base_weight_max' => 'required|numeric|gt:base_weight_min', // harus lebih besar dari min
            'sell_price_per_kg' => 'required|integer|min:0',
            'catch_probability' => 'required|numeric|min:0.01|max:100.00',
            'description' => 'nullable|string'
        ], [
            'base_weight_max.gt' => 'Berat maksimum harus lebih besar dari berat minimum',
            'catch_probability.min' => 'Peluang tangkap minimal 0.01%',
            'catch_probability.max' => 'Peluang tangkap maksimal 100%'
        ]);

        Fish::create($request->all());

        return redirect()->route('fishes.index')
            ->with('success', 'Ikan berhasil ditambahkan!');
    }

    public function show(Fish $fish)
    {
        return view('fishes.show', compact('fish'));
    }

    public function edit(Fish $fish)
    {
        $rarities = ['Common', 'Uncommon', 'Rare', 'Epic', 'Legendary', 'Mythic', 'Secret'];
        return view('fishes.edit', compact('fish', 'rarities'));
    }

    public function update(Request $request, Fish $fish)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'rarity' => 'required|in:Common,Uncommon,Rare,Epic,Legendary,Mythic,Secret',
            'base_weight_min' => 'required|numeric|min:0',
            'base_weight_max' => 'required|numeric|gt:base_weight_min',
            'sell_price_per_kg' => 'required|integer|min:0',
            'catch_probability' => 'required|numeric|min:0.01|max:100.00',
            'description' => 'nullable|string'
        ], [
            'base_weight_max.gt' => 'Berat maksimum harus lebih besar dari berat minimum',
            'catch_probability.min' => 'Peluang tangkap minimal 0.01%',
            'catch_probability.max' => 'Peluang tangkap maksimal 100%'
        ]);

        $fish->update($request->all());

        return redirect()->route('fishes.index')
            ->with('success', 'Ikan berhasil diupdate!');
    }

    public function destroy(Fish $fish)
    {
        $fish->delete();

        return redirect()->route('fishes.index')
            ->with('success', 'Ikan berhasil dihapus!');
    }
}