<?php

namespace App\Http\Controllers;

use App\Models\surat;
use App\Models\jenis;
use App\Models\dosen;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $surat = surat::get();
        $jenis = jenis::get();
        // dd($surat);
        return view('user.track', compact(['surat', 'jenis']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $jenis = jenis::get();
        $dosen = dosen::get();
        return view('user.form', compact('jenis', 'dosen'));
        // return view('user.free-form', compact('jenis', 'dosen'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nim'       => 'required|max:9',
            'jenis'     => 'required|max:10',
        ]);

        // surat::create([
        //     'nim'       => $request->nim,
        //     'jenis'     => $request->jenis,
        //     'dosen'     => $request->dosen,
        //     'kepada'    => $request->kepada,
        //     'mata_kuliah'=> $request->matkul,
        //     'judul'     => $request->judul,
        //     'mitra'     => $request->mitra,
        //     'alamat'    => $request->alamat,
        //     'kecamatan' => $request->kecamatan,
        //     'kabupaten' => $request->kabupaten,
        //     'provinsi'  => $request->provinsi,
        //     'start'     => $request->start,
        //     'end'       => $request->end,
        //     'kebutuhan' => $request->kebutuhan,
        //     'keterangan'=> $request->keterangan,
        //     'status'    => '1',
        // ]);
        // return redirect()->route('track')->with(['success' => 'Surat Berhasil Diajukan!']);
        // dd($request->form);
        dd($request->nama);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $surat = surat::findOrFail($id);
        $dosen = dosen::findOrFail($surat->id_dosen);
        return view('template-surat.MK', compact(['surat','dosen']));
        // dd($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
