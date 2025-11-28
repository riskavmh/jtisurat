<?php

namespace App\Http\Controllers;

use App\Models\surat;
use App\Models\dosen;
use App\Models\mahasiswa;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SuratController extends Controller
{
    public static function getStatusCounts()
    {
        $counts = surat::select('status', DB::raw('count(*) as total'))
                       ->groupBy('status')
                       ->pluck('total', 'status')
                       ->toArray();
        return [
            'dtSrtDiproses' => $counts[1] ?? null,
            'dtSrtSelesai' => $counts[2] ?? null,
            'dtSrtDitolak'  => $counts[3] ?? null,
        ];
    }

    public function index(int $statusId, string $viewName): View
    {
        $surat = Surat::where('status', $statusId)->get();
        return view('admin.surat.' . $viewName, compact('surat'));
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

    public function update(Request $request, string $id) :RedirectResponse
    {      
        $surat = surat::findOrFail($id);
        if($request->input('action') == 'confirm') {
            $request->validate([
                'no_surat'     => 'required',
            ]);
            $surat->update([
                'no_surat'     => $request->no_surat.' / '.($surat->kebutuhan == 'Eksternal' ? 'PL17' : 'PL17.3.5').' / PP / '.date('Y'),
                'status'       => 2,
            ]);
        } else {
            $request->validate([
                'alasan'     => 'required|min:2',
            ]);
            $surat->update([
                'alasan'     => $request->alasan,
                'status'     => 3,
            ]);
        }
        
        return redirect()->back();
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
