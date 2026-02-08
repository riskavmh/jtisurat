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
            'dtPending'     => $counts['diproses'] ?? 0,
            'dtApproved'    => $counts['dicetak'] ?? 0,
            'dtDone'        => $counts['selesai'] ?? 0,
            'dtRejected'    => $counts['ditolak'] ?? 0,
        ];
    }

    public function index(int $statusId, string $viewName): View
    {
        $data = $this->getBaseData(request());
        $letters = Letter::with(['leader.user'])->where('status', $statusId)->get();

        $uniqueExternalIds = $letters->pluck('leader.user.external_id')->filter()->toArray();
        // dd($uniqueExternalIds);
        $nimCache = [];

        foreach ($uniqueExternalIds as $ids) {
            $studentData = StudentHelper::getDetail($data['token'], $ids);
            $nimCache[$ids] = $studentData['nim'] ?? '-'; 
        }

        foreach ($letters as $l) {
            if ($l->leader && $l->leader->user) {
                $extId = $l->leader->user->external_id;
                $l->leader_nim = $nimCache[$extId] ?? '-';
            }
        }

        return view('admin.process.' . $viewName, compact('letters', 'data'));
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
        // dd($data);

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
        $inputIDs = is_array($request->members) ? $request->members : [$request->members];

        foreach ($inputIDs as $ids) {
            $studentData = StudentHelper::getStudents($data['token'], $ids);
            if ($studentData && isset($studentData['id'])) {
                $localUser = User::where('external_id', $studentData['id'])->first();
                if ($localUser && $localUser->id !== Auth::user()->id) {
                    $members[$localUser->id] = 'Anggota';
                }
            }
        }
        // $members = array_unique($members);

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
        // $letter = Letter::findOrFail($id);
        $data = $this->getBaseData(request());
        $letter = Letter::with('members')->findOrFail($id); 
        $lecturer = $data['lecturers']->firstWhere('value', $letter->lecturer_id);
        $memberName = $letter->members->first()?->user?->name;
        $totalMembers = $letter->members->count();
        $token = $data['token'];

        foreach ($letter->members as $member) {
            $studentApi = StudentHelper::getDetail($token, $member->user_id);
            if ($studentApi) {
                $member->nim  = $studentApi['nim'];
            }
        }
        return view('admin.process.detail', compact('letter', 'lecturer', 'data', 'memberName', 'totalMembers'));
    }

    public function update(Request $request, string $id) :RedirectResponse
    {      
        $letters = Letter::findOrFail($id);

        if($request->input('action') == 'confirm') {
            if($letters->necessity == 'internal') {
                $request->validate([
                    'ref_no'     => 'required',
                ]);
            }
            $letters->update([
                'ref_no'     => $request->ref_no. "/ ".($letters->necessity == 'eksternal' ? 'PL17' : 'PL17.3.5').' / PP / '.date('Y') ?? null,
                'status'       => 'dicetak',
            ]);
        } else {
            $request->validate([
                'excuses'     => 'required|min:2',
            ]);
            $letters->update([
                'excuses'     => $request->alasan,
                'status'     => 'ditolak',
            ]);
        }
        
        return redirect()->back();
    }

    public function print(string $id)
    {
        $data = $this->getBaseData(request());
        $letter = Letter::with('members')->findOrFail($id);
        // $letters = Letter::findOrFail($id);
        $lecturer = $data['lecturers']->firstWhere('value', $letter->lecturer_id);
        $type = $data['type']->firstWhere('id', $letter->type_id)?->abbr;

        return view('template.'. $type, compact(['letter','lecturer']));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
