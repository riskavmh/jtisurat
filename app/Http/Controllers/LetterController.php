<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use App\Models\dosen;
use App\Models\LetterType;
use App\Helpers\LecturerHelper;
use App\Helpers\StudentHelper;
use App\Helpers\AuthHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LetterController extends Controller
{

    private function getBaseData(Request $request)
    {
        $token    = $request->user()->token;
        $majorId  = '019a4723-1d2f-733b-b9ff-25c2e27440c2';
        $position = 'DOSEN';

        return [
            'authID'    => Auth::user()->external_id,
            // 'letters'   => Letter::get(),
            'letters'   => Letter::where('user_id', Auth::user()->external_id)->get(),
            'type'      => LetterType::get(),
            'get_me'    => AuthHelper::getMe($token) ?? [],
            'lecturers' => collect(LecturerHelper::getLecturer($token, $position, $majorId))->sortBy('label')->values()->all() ?? []
        ];
    }

    public static function getStatusCounts()
    {
        $counts = Letter::select('status', DB::raw('count(*) as total'))
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
        $letters = Letter::where('status', $statusId)->get();
        return view('admin.surat.' . $viewName, compact('surat'));
    }

    public function track(Request $request)
    {
        // $letters = Letter::get();
        // $type = LetterType::get();

        $data = $this->getBaseData($request);

        $diproses = $data['letters']->where('status', 1);
        $selesai  = $data['letters']->where('status', 2);
        $ditolak  = $data['letters']->where('status', 3);

        return view('user.track', [
            // 'letters'     => collect($data['letters'])->firstWhere('user_id', $data['authID']),
            // 'types'       => $data['type'],
            // 'lecturers'   => $data['lecturer'],
            // 'get_me'      => $data['get_me'],
            'data'        => $data,
            'srtDiproses' => $diproses,
            'srtSelesai'  => $selesai,
            'srtDitolak'  => $ditolak,
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
        
        $get_me     = AuthHelper::getMe($token)['data'] ?? [];
        $lecturers  = collect(LecturerHelper::getLecturer($token, $position, $majorId))->sortBy('label')->values()->all() ?? [];
        // $lecturers   = collect($responseLecturers)->sort()->toArray();
        
        // $responseStudents   = StudentHelper::getStudents($token, $majorId)['data'] ?? [];
        // $students   = collect($responseStudents)->firstWhere('user_id', $authID);

        // $responseAuth   = AuthHelper::getMe($token);

        // dd($lecturers);
        // dd($get_me);

        $type       = LetterType::get();
        // $dosen      = dosen::get();
        return view('user.form', compact('type', 'lecturers', 'get_me'));
        // return view('user.free-form', compact('type', 'dosen'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $this->getBaseData($request);
        // dd($data['type']->firstWhere('abbr', $request->type)?->id);

        $letter = Letter::create([
            'ref_no'    => null,
            'user_id'   => $data['authID'],
            'type_id'   => $data['type']->firstWhere('abbr', $request->type)?->id,
            'lecturer_id'  => $request->lecturer,
            'research_title'=> $request->research_title ?? null,
            'to'        => $request->to ?? null,
            'course'    => Str::title($request->course) ?? null,
            'company'   => $request->company,
            'address'   => $request->address,
            'subdistrict'=> Str::title($request->subdistrict),
            'regency'   => Str::title($request->regency),
            'province'  => $request->province,
            'start_date'=> $request->start_date,
            'end_date'  => $request->end_date ?? null,
            'necessity' => $request->necessity,
            'note'      => $request->note ?? null,
            'excuses'   => null,
            'status'    => '1',
        ]);
        // dd($data['authID'],
        // $request->type,
        // $request->lecturer_id,
        // $request->research_title ?? null,
        // $request->to ?? null,
        // Str::title($request->course) ?? null,
        // $request->company,
        // $request->address,
        // Str::title($request->subdistrict),
        // Str::title($request->regency),
        // Str::title($request->province),
        // $request->start_date,
        // $request->end_date ?? null,
        // $request->necessity,
        // $request->note ?? null,
        // '1',);
        return redirect()->route('track')->with(['success' => 'Surat Berhasil Diajukan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $letters = Letter::findOrFail($id);
        $dosen = dosen::findOrFail($letters->id_dosen);
        return view('admin.surat.detail', compact(['surat','dosen']));
    }

    public function update(Request $request, string $id) :RedirectResponse
    {      
        $letters = Letter::findOrFail($id);
        if($request->input('action') == 'confirm') {
            $request->validate([
                'no_surat'     => 'required',
            ]);
            $letters->update([
                'no_surat'     => $request->no_surat.' / '.($letters->kebutuhan == 'Eksternal' ? 'PL17' : 'PL17.3.5').' / PP / '.date('Y'),
                'status'       => 2,
            ]);
        } else {
            $request->validate([
                'alasan'     => 'required|min:2',
            ]);
            $letters->update([
                'alasan'     => $request->alasan,
                'status'     => 3,
            ]);
        }
        
        return redirect()->back();
    }

    public function print(string $id)
    {
        $letters = Letter::findOrFail($id);
        $dosen = dosen::findOrFail($letters->id_dosen);
        if($letters->type == 'MK') {
            return view('template-surat.MK', compact(['surat','dosen']));
        } else if($letters->type == 'PK') {
            return view('template-surat.PK', compact(['surat','dosen']));
        } else if($letters->type == 'TA') {
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
