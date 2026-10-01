<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Santri;
use App\Models\Kamar;

class SantriController extends Controller
{
    public function index(Request $request)
{
    $query = Santri::with('kamar');

    // FILTER KAMAR (bukan blok)
    if ($request->kamar_id) {
        $query->where('kamar_id', $request->kamar_id);
    }

    $santris = $query->get();

    // ambil semua kamar
    $kamars = Kamar::all();

    return view('santri.index', compact('santris', 'kamars'));
}
    public function create()
    {
        $kamars = Kamar::all();

        return view('santri.create', compact('kamars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'kamar_id' => 'required',
            'status' => 'required',
        ]);

        Santri::create([
            'nama' => $request->nama,
            'kamar_id' => $request->kamar_id,
            'uid_rfid' => $request->uid_rfid,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'status' => $request->status,
        ]);

        return redirect('/santri')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $santri = Santri::findOrFail($id);
        $kamars = Kamar::all();

        return view('santri.edit', compact('santri', 'kamars'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'kamar_id' => 'required',
            'status' => 'required',
        ]);

        $santri = Santri::findOrFail($id);

        $santri->update([
            'nama' => $request->nama,
            'kamar_id' => $request->kamar_id,
            'uid_rfid' => $request->uid_rfid,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'status' => $request->status,
        ]);

        return redirect('/santri')->with('success', 'Data berhasil diupdate');
    }

    public function delete($id)
    {
        $santri = Santri::findOrFail($id);
        $santri->delete();

        return redirect('/santri')->with('success', 'Data berhasil dihapus');
    }

    
}