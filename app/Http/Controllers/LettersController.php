<?php

namespace App\Http\Controllers;

use App\Models\Letters;
use App\Models\dosen;
use App\Models\LetterType;
use App\Helpers\LecturerHelper;
use App\Helpers\StudentHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LettersController extends Controller
{
    public static function getStatusCounts()
    {
        $counts = Letters::select('status', DB::raw('count(*) as total'))
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
        $surat = Letters::where('status', $statusId)->get();
        return view('admin.surat.' . $viewName, compact('surat'));
    }

    public function track()
    {
        $surat = Letters::get();
        $jenis = LetterType::get();

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

        // dd($lecturers);
        dd($students);

        $jenis      = LetterType::get();
        // $dosen      = dosen::get();
        return view('user.form', compact('jenis', 'lecturers', 'students'));
        // return view('user.free-form', compact('jenis', 'dosen'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // Letters::create([
        //     'ref_no'    => null,
        //     'nim'       => $request->nim,
        //     'type'      => $request->type,
        //     'lecturer'  => $request->lecturer,
        //     'research_title'=> $request->research_title ?? null,
        //     'to'        => $request->to ?? null,
        //     'course'    => Str::upper($request->course) ?? null,
        //     'company'   => $request->company,
        //     'address'   => $request->address,
        //     'subdistrict'=> Str::upper($request->subdistrict),
        //     'regency'   => Str::upper($request->regency),
        //     'province'  => Str::upper($request->province),
        //     'start_date'=> $request->start_date,
        //     'end_date'  => $request->end_date ?? null,
        //     'necessity' => $request->necessity,
        //     'note'      => $request->note ?? null,
        //     'status'    => '1',
        // ]);
        dd($request->nim,
        $request->type,
        $request->lecturer,
        $request->research_title ?? null,
        $request->to ?? null,
        Str::upper($request->course) ?? null,
        $request->company,
        $request->address,
        Str::upper($request->subdistrict),
        Str::upper($request->regency),
        Str::upper($request->province),
        $request->start_date,
        $request->end_date ?? null,
        $request->necessity,
        $request->note ?? null,
        '1',);
        return redirect()->route('track')->with(['success' => 'Surat Berhasil Diajukan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $surat = Letters::findOrFail($id);
        $dosen = dosen::findOrFail($surat->id_dosen);
        return view('admin.surat.detail', compact(['surat','dosen']));
    }

    public function update(Request $request, string $id) :RedirectResponse
    {      
        $surat = Letters::findOrFail($id);
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
        $surat = Letters::findOrFail($id);
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
