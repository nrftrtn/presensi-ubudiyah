<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kamar;

class KamarController extends Controller
{
    public function index()
    {
        $kamars = Kamar::all();

        return view('kamar.index', compact('kamars'));
    }

    public function create()
    {
        return view('kamar.create');
    }

    public function store(Request $request)
    {
        Kamar::create([
            'nama_kamar' => $request->nama_kamar,
            'blok' => $request->blok,
        ]);

        return redirect('/kamar');
    }

    public function edit($id)
    {
        $kamar = Kamar::findOrFail($id);

        return view('kamar.edit', compact('kamar'));
    }

    public function update(Request $request, $id)
    {
        $kamar = Kamar::findOrFail($id);

        $kamar->update([
            'nama_kamar' => $request->nama_kamar,
            'blok' => $request->blok,
        ]);

        return redirect('/kamar');
    }

    public function delete($id)
    {
        $kamar = Kamar::findOrFail($id);

        $kamar->delete();

        return redirect('/kamar');
    }
}