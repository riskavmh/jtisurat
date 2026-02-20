<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Letter;
use App\Models\LetterType;
use App\Models\LetterMember;
use App\Helpers\AuthHelper;
use App\Helpers\LecturerHelper;
use App\Helpers\StudentHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
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
            'type'      => LetterType::get()->sortByDesc('created_at'),
            'letters'   => $letters->sortByDesc('created_at'),
            'lecturers' => $lecturers,
            'get_me'    => AuthHelper::getMe($token) ?? [],
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

    public static function getStatusCounts($studyProgramId = null, $isSuperAdmin = false)
    {
        $query = Letter::query();

        if (!$isSuperAdmin) {
            $query->join('letter_members', 'letters.id', '=', 'letter_members.letter_id')
                ->where('letter_members.position', 'Ketua')
                ->join('users', 'letter_members.user_id', '=', 'users.id');

            if ($studyProgramId) {
                $query->whereIn('users.id_study_program', (array)$studyProgramId); 
            }
        }

        $counts = $query->select('letters.status', DB::raw('count(distinct letters.id) as total'))
                        ->groupBy('letters.status')
                        ->pluck('total', 'status')
                        ->toArray();

        return [
            'dtPending'  => $counts['diproses'] ?? 0,
            'dtApproved' => $counts['dicetak'] ?? 0,
            'dtDone'     => $counts['selesai'] ?? 0,
            'dtRejected' => $counts['ditolak'] ?? 0,
        ];
    }

    public function index(string $status)
    {
        /** @var \Illuminate\Http\Request $req */
        $req = request();
        $data = $this->getBaseData($req);
        
        $statusMap = [
            'pending'  => 'diproses',
            'approved' => 'dicetak',
            'done'     => 'selesai',
            'rejected' => 'ditolak'
        ];

        if (!array_key_exists($status, $statusMap)) { abort(404); }
        
        $dbStatus = $statusMap[$status];

        $userStudyProgramIds = collect($data['get_me']['data']['employee_detail']['position_assignments'] ?? [])
            ->pluck('study_program_id_parent')->filter()->unique()->toArray();

        $letters = Letter::with(['leader.user', 'members.user'])
            ->where('status', $dbStatus);
        
        if (!in_array('superadmin_jtisurat', Auth::user()->roles ?? [])) {
            $letters->whereHas('leader.user', function ($query) use ($userStudyProgramIds) {
                $query->whereIn('id_study_program', (array)$userStudyProgramIds);
            });
        }

        $letters = $letters->orderBy('created_at', 'DESC')->get();

        $statusLabel = ucfirst($dbStatus); 

        return view('admin.process.index', compact('letters', 'data', 'statusLabel', 'status'));
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
                if (!$localUser) {
                    $localUser = User::create([
                        'external_id' => $studentData['id'],
                        'name' => $studentData['name'],
                        'phone_number' => $studentData['phonenumber'] ?? null,
                        'study_program_name' => $studentData['studyprogram'] ?? null,
                        'roles' => ['student'],
                    ]);
                }
    
                if ($localUser && $localUser->id !== Auth::user()->id) {
                    $members[$localUser->id] = 'Anggota';
                }
            }
        }

        // die();

        $letter = Letter::create([
            'ref_no'    => null,
            'type_id'   => $data['type']->firstWhere('abbr', $request->type)?->id,
            'lecturer_id'  => $request->lecturer ?? null,
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
        /** @var \Illuminate\Http\Request $req */
        $req = request();
        $data = $this->getBaseData($req);

        $letter = Letter::with(['leader.user', 'members.user', 'type'])->findOrFail($id); 
        $lecturer = $data['lecturers']->firstWhere('value', $letter->lecturer_id);
        $totalMembers = $letter->members->count();

        $scanUrl = $letter->scanPath ? asset('storage/' . $letter->scanPath) : null;

        return view('admin.process.detail', compact('letter', 'lecturer', 'data', 'totalMembers', 'scanUrl'));
    }

    public function update(Request $request, string $id) :RedirectResponse
    {      
        $letters = Letter::findOrFail($id);

        if($request->input('action') == 'confirm') {
            if($letters->necessity == 'internal') {
                $request->validate([
                    'ref_no'     => 'required',
                ]);
                $letters->update([
                    'ref_no'     => $request->ref_no." / PL17.3.5 / PP / ".date('Y'),
                    'status'       => 'dicetak',
                ]);
            } else {
                $letters->update([
                    'status'       => 'dicetak',
                ]);
            }
        } 
        
        if($request->input('action') == 'reject') {
            $request->validate([
                'excuses'     => 'required|min:2',
            ]);
            $letters->update([
                'excuses'     => $request->excuses,
                'status'     => 'ditolak',
            ]);
        } 
        
        if($request->input('action') == 'done') {

            $file = $request->file('scanPath');
            $fileName = 'surat_' . $id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('letters', $fileName, 'public');

            if($letters->necessity == 'eksternal') {
                $request->validate([
                    'ref_no'     => 'required',
                    'scanPath'   => 'required|mimes:pdf|max:2048',
                ]);
                
                $letters->update([
                    'ref_no'   => $request->ref_no." / PL17 / PP / ".date('Y'),
                    'scanPath' => $path,
                    'status'   => 'selesai',
                ]);
            } else {
                $request->validate([
                    'scanPath'   => 'required|mimes:pdf|max:2048',
                ]);
                
                $letters->update([
                    'scanPath' => $path,
                    'status'   => 'selesai',
                ]);
            }
        }
        
        return redirect()->back()->with(['success' => 'Surat Berhasil Di-update!']);
    }

    public function print(string $id)
    {
        /** @var \Illuminate\Http\Request $req */
        $req = request();
        $data = $this->getBaseData($req);
        $letter = Letter::with('members.user')->findOrFail($id);
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
