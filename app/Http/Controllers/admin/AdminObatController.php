<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use Illuminate\Http\Request;

class AdminObatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $obats = Obat::all(); 
        return view('admin.obat.index', compact('obats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.obat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kemasan' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok' => 'nullable|integer|min:0',
        ]);

        Obat::create([
            'nama_obat' => $request->nama_obat,
            'kemasan' => $request->kemasan,
            'harga' => $request->harga,
            'stok' => $request->stok ?? 0,
        ]);

        return redirect()->route('admin.obat.index')->with('success', 'Obat Behasil Ditambahkan.');
    }

    /**
     * Show form to add stock
     */
    public function stockForm(string $id)
    {
        $obat = Obat::findOrFail($id);
        return view('admin.obat.stock', compact('obat'));
    }

    /**
     * Add stock to obat
     */
    public function addStock(Request $request, string $id)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1',
        ]);

        $obat = Obat::findOrFail($id);
        $obat->increment('stok', $request->jumlah);

        return redirect()->route('admin.obat.index')->with('success', 'Stok berhasil ditambahkan.');
    }

    /**
     * Show form to decrease stock
     */
    public function stockDecreaseForm(string $id)
    {
        $obat = Obat::findOrFail($id);
        return view('admin.obat.stock_decrease', compact('obat'));
    }

    /**
     * Decrease stock
     */
    public function decreaseStock(Request $request, string $id)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1',
        ]);

        $obat = Obat::findOrFail($id);
        if ($obat->stok < $request->jumlah) {
            return redirect()->back()->with('error', 'Jumlah melebihi stok saat ini.');
        }

        $obat->decrement('stok', $request->jumlah);

        return redirect()->route('admin.obat.index')->with('success', 'Stok berhasil dikurangi.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $obat = Obat::findOrFail($id);
        return view('admin.obat.edit', compact('obat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kemasan' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok' => 'nullable|integer|min:0',
        ]);

        $obat = Obat::findOrFail($id);
        $obat->update([
            'nama_obat' => $request->nama_obat,
            'kemasan' => $request->kemasan,
            'harga' => $request->harga,
            'stok' => $request->stok ?? $obat->stok,
        ]);

        return redirect()->route('admin.obat.index')->with('success', 'Obat Behasil Diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $obat = Obat::findOrFail($id);
        $obat->delete();

        return redirect()->route('admin.obat.index')->with('success', 'Obat Berhasil Dihapus.');
    }
}
