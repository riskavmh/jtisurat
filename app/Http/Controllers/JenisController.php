<?php

namespace App\Http\Controllers;

use App\Models\jenis;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class JenisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View 
    {
        $jenis = jenis::orderBy('id', 'ASC')->get();
        return view('admin.jenis.index', compact('jenis'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.jenis.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis'     => 'required|max:10|min:2',
            'ket'       => 'required|max:50|min:5'
        ]);
        jenis::create([
            'jenis'     => Str::upper($request->nama),
            'ket'       => Str::title($request->ket)
        ]);
        return redirect()->route('jenis.index')->with(['success' => 'Data Berhasil Ditambahkan!']);
        // var_dump(Str::upper($request->jenis),Str::title($request->ket));

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
    public function edit(string $id): View
    {
        $jenis = jenis::findOrFail($id);
        return view('admin.jenis.edit', compact('jenis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'nama'     => 'required|max:10|min:2',
            'ket'       => 'required|max:50|min:5'
        ]);
        
        $jenis = jenis::findOrFail($id);
        $jenis->update([
            'nama'     => Str::upper($request->nama),
            'ket'       => Str::title($request->ket)
        ]);
        return redirect()->route('jenis.index')->with('Data Berhasil Diubah!');
        // dd(Str::upper($request->nama),Str::title($request->ket));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        jenis::findOrFail($id)->delete();
        return redirect()->route('jenis.index')->with(['success' => 'Data Berhasil Dihapus']);
        // dd(jenis::findOrFail($id));
    }
}
