<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Letter;
use App\Models\dosen;
use App\Models\LetterType;
use App\Models\LetterMember;
use App\Helpers\AuthHelper;
use App\Helpers\LecturerHelper;
use App\Helpers\StudentHelper;
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

        $authID   = Auth::user()->id;
        $letters = Letter::whereHas('members', function($query) use ($authID) {
            $query->where('user_id', $authID);
        })->get();
        $lecturers = collect(LecturerHelper::getLecturer($token, $position, $majorId));

        $letters->map(function ($letter) use ($lecturers) {
            $dosen = $lecturers->firstWhere('value', $letter->lecturer_id);
            $letter->lecturer_name = $dosen['label'];
            return $letter;
        });

        return [
            'token'     => $token,
            'authID'    => $authID,
            'users'     => User::get()->toArray(),
            'type'      => LetterType::get(),
            'letters'   => $letters,
            'lecturers' => $lecturers,
            'get_me'    => AuthHelper::getMe($token) ?? [],
            // 'lecturers' => collect(LecturerHelper::getLecturer($token, $position, $majorId))->sortBy('label')->values()->all() ?? []
        ];
    }


    public function getStudentData($nim)
    {
        $token = Auth::user()->token;
        $studentData = StudentHelper::getStudents($token, $nim);

        if ($studentData) {
            return response()->json([
                'success' => true,
                'data'    => $studentData
            ]);
        }

        return response()->json([
            'success' => false, 
            'message' => 'Mahasiswa tidak ditemukan'
        ], 404);
    }

    public static function getStatusCounts()
    {
        $counts = Letter::select('status', DB::raw('count(*) as total'))
                       ->groupBy('status')
                       ->pluck('total', 'status')
                       ->toArray();
        return [
            'dtSrtDiproses' => $counts['diproses'] ?? 0,
            'dtSrtDicetak' => $counts['dicetak'] ?? 0,
            'dtSrtSelesai' => $counts['selesai'] ?? 0,
            'dtSrtDitolak'  => $counts['ditolak'] ?? 0,
        ];
    }

    public function index(int $statusId, string $viewName): View
    {
        $letters = Letter::where('status', $statusId)->get();
        return view('admin.process.' . $viewName, compact('letters'));
    }

    public function track(Request $request)
    {
        $data = $this->getBaseData($request);

        $diproses = $data['letters']->where('status', 'diproses');
        $dicetak  = $data['letters']->where('status', 'dicetak');
        $selesai  = $data['letters']->where('status', 'selesai');
        $ditolak  = $data['letters']->where('status', 'ditolak');

        return view('user.track', [
            'data'        => $data,
            'srtDiproses' => $diproses,
            'srtDicetak'  => $dicetak,
            'srtSelesai'  => $selesai,
            'srtDitolak'  => $ditolak,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $data = $this->getBaseData($request);

        $authID     = $data['authID'];
        $type       = $data['type'];
        $get_me     = $data['get_me']['data'];
        $users      = $data['users'];

        $token      = $request->user()->token;
        $majorId    = '019a4723-1d2f-733b-b9ff-25c2e27440c2';
        $position   = 'DOSEN';
        $lecturers  = collect(LecturerHelper::getLecturer($token, $position, $majorId))->sortBy('label')->values()->all() ?? [];

        return view('user.form', compact('type', 'lecturers', 'get_me', 'users'));
        // return view('user.free-form', compact('type', 'dosen'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $this->getBaseData($request);

        $members = [];
        $members[Auth::user()->id] = 'Ketua';
        $inputNims = is_array($request->members) ? $request->members : [$request->members];

        foreach ($inputNims as $nim) {
            $studentData = StudentHelper::getStudents($data['token'], $nim);
            if ($studentData && isset($studentData['id'])) {
                $localUser = User::where('external_id', $studentData['id'])->first();
                if ($localUser && $localUser->id !== Auth::user()->id) {
                    $members[$localUser->id] = 'Anggota';
                }
            }
        }
        $members = array_unique($members);

        $letter = Letter::create([
            'ref_no'    => null,
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
        ]);

        foreach ($members as $usersId => $position) {
            LetterMember::create([
                'letter_id' => $letter->id,
                'user_id'   => $usersId,
                'position'  => $position,
            ]);
        }
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
