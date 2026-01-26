<?php

namespace App\Http\Controllers;

use App\Models\surat;
use App\Models\jenis;
use App\Models\dosen;
use App\Helpers\AuthHelper;
use App\Helpers\LecturerHelper;
use App\Helpers\StudentHelper;
use Illuminate\Support\Facades\Auth;
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

        $diproses = $surat->where('status', 1);
        $selesai  = $surat->where('status', 2);
        $ditolak  = $surat->where('status', 3);

        return view('user.track', [
            'surat'    => $surat,
            'srtDiproses' => $diproses,
            'srtSelesai'  => $selesai,
            'srtDitolak'  => $ditolak,
            'jenis'    => $jenis,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $authID     = Auth::user()->external_id;
        $token      = $request->user()->token;
        $majorId    = '019a4723-1d2f-733b-b9ff-25c2e27440c2';
        $position   = 'DOSEN';

        $responseLecturers  = LecturerHelper::getLecturer($token, $position, $majorId);
        $data['lecturers']  = $responseLecturers['data'] ?? [];
        $lecturers   = collect($data['lecturers'])->sort()->toArray();
        
        $responseStudents   = StudentHelper::getStudents($token, $majorId);
        $data['students']   = $responseStudents['data'] ?? [];
        $students   = collect($data['students'])->firstWhere('user_id', $authID);

        dd($lecturers);
        // dd($students);

        $jenis      = jenis::get();
        // $dosen      = dosen::get();
        return view('user.form', compact('jenis', 'lecturers', 'students'));
        // return view('user.free-form', compact('jenis', 'dosen'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        surat::create([
            'nim'       => $request->nim,
            'jenis'     => $request->jenis,
            'dosen'     => $request->dosen,
            'kepada'    => $request->kepada,
            'mata_kuliah' => Str::upper($request->matkul),
            'judul'     => $request->judul,
            'mitra'     => $request->mitra,
            'alamat'    => $request->alamat,
            'kecamatan' => Str::upper($request->kecamatan),
            'kabupaten' => Str::upper($request->kabupaten),
            'provinsi'  => Str::upper($request->provinsi),
            'start'     => $request->start,
            'end'       => $request->end,
            'kebutuhan' => $request->kebutuhan,
            'keterangan'=> $request->keterangan,
            'status'    => '1',
        ]);
        return redirect()->route('track')->with(['success' => 'Surat Berhasil Diajukan!']);
        dd($request->form);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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
