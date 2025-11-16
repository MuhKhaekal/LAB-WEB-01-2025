<?php

namespace App\Http\Controllers;
use App\Models\Fish;
use Illuminate\Http\Request;

class FishController extends Controller
{
    /**
     * Menampilkan halaman home.
     */
    public function home()
    {
        return view('home');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // 1. Ambil data ikan (query builder)
        $query = Fish::query();

        // 2. Terapkan filter berdasarkan rarity
        if ($request->filled('rarity')) {
            $query->where('rarity', $request->rarity);
        }
        
        // 3. Ambil data dengan pagination
        $fishes = $query->latest()->paginate(12);

        // 4. Kirim data ke view
        return view('fishes.index', compact('fishes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         // Hanya tampilkan view create 
        return view('fishes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data
        
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'rarity' => 'required|in:Common,Uncommon,Rare,Epic,Legendary,Mythic,Secret',
            'base_weight_min' => 'required|numeric|min:0',
            'base_weight_max' => 'required|numeric|gt:base_weight_min', // 'gt' = greater than
            'sell_price_per_kg' => 'required|integer|min:1',
            'catch_probability' => 'required|numeric|decimal:0,2|min:0.01|max:100.00',
            'description' => 'nullable|string', 
        ]);

        // Simpan data ke database
        Fish::create($validated);

        // Arahkan kembali ke halaman index dengan pesan sukses
        return redirect()->route('fishes.index')->with('success', 'New fish added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Fish $fish)
    {
        // Tampilkan view show dengan data $fish (Laravel otomatis mencari by ID)
        return view('fishes.show', compact('fish'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fish $fish)
    {
        // Tampilkan view edit dengan data $fish 
        return view('fishes.edit', compact('fish'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fish $fish)
    {
        // Validasi data (sama seperti store) 
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'rarity' => 'required|in:Common,Uncommon,Rare,Epic,Legendary,Mythic,Secret',
            'base_weight_min' => 'required|numeric|min:0',
            'base_weight_max' => 'required|numeric|gt:base_weight_min',
            'sell_price_per_kg' => 'required|integer|min:1',
            'catch_probability' => 'required|numeric|decimal:0,2|min:0.01|max:100.00', 
            'description' => 'nullable|string',
        ]);

        // Update data ikan yang ada
        $fish->update($validated);

        // Arahkan kembali ke halaman index dengan pesan sukses
        return redirect()->route('fishes.index')->with('success', 'Fish data updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fish $fish)
    {
        // Hapus data ikan
        $fish->delete();

        // Arahkan kembali ke halaman index dengan pesan sukses
        return redirect()->route('fishes.index')->with('success', 'Fish deleted successfully!');
    }
}
