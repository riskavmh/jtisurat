<?php

namespace App\Http\Controllers;

use App\Models\surat;
use App\Models\jenis;
use App\Models\dosen;
use App\Models\mahasiswa;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dtDiproses()
    {
        $surat = surat::get();
        return view('admin.surat.dtSrtDiproses', compact(['surat']));
    }
    public function dtDiterima()
    {
        $surat = surat::get();
        return view('admin.surat.dtSrtDiterima', compact(['surat']));
    }
    public function dtSelesai()
    {
        $surat = surat::get();
        return view('admin.surat.dtSrtSelesai', compact(['surat']));
    }
    public function dtDitolak()
    {
        $surat = surat::get();
        return view('admin.surat.dtSrtDitolak', compact(['surat']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $surat = surat::findOrFail($id);
        $dosen = dosen::findOrFail($surat->id_dosen);
        return view('admin.surat.detail', compact(['surat','dosen']));
    }

    public function print(string $id)
    {
        $surat = surat::findOrFail($id);
        $dosen = dosen::findOrFail($surat->id_dosen);
        return view('template-surat.MK', compact(['surat','dosen']));
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
