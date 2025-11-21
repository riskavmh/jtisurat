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

    // public function index()
    // {
    //     $surat = surat::get();
    //     $status = surat::findOrFail($surat->status);
    //     if($status == '1') {
    //         return view('admin.surat.dtSrtDiproses', compact(['surat']));
    //     } else if($status == '2') {
    //         return view('admin.surat.dtSrtDiterima', compact(['surat']));
    //     } else if($status == '3') {
    //         return view('admin.surat.dtSrtSelesai', compact(['surat']));
    //     } else {
    //         return view('admin.surat.dtSrtDitolak', compact(['surat']));
    //     }
    // }

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
        // dd($id);
    }

    public function update(Request $request, string $id)
    {      
        $surat = surat::findOrFail($id);
        if($request->input('action') == 'confirm') {
            // dd($request->no_surat);
            $request->validate([
                'no_surat'     => 'required'
            ]);
            $surat->update([
                'no_surat'     => $request->no_surat,
                'status'       => '2'
            ]);
        } else if($request->input('action') == 'reject') {
            // dd($request->alasan);
            $request->validate([
                'alasan'     => 'required|min:2'
            ]);
            $surat->update([
                'alasan'     => $request->alasan,
                'status'     => '4'
            ]);
        }
        // return redirect()->back();
        return redirect()->route('/');

        // $surat->update([
        //     'no_surat'     => $request->no_surat,
        // ]);
        // return redirect()->previous();
        // dd($request->no_surat);
    }

    public function print(string $id)
    {
        $surat = surat::findOrFail($id);
        $dosen = dosen::findOrFail($surat->id_dosen);
        if($surat->jenis == 'MK') {
            return view('template-surat.MK', compact(['surat','dosen']));
        } else if($surat->jenis == 'PK') {
            return view('template-surat.PK', compact(['surat','dosen']));
        } else if($surat->jenis == 'TA') {
            return view('template-surat.TA', compact(['surat','dosen']));
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
