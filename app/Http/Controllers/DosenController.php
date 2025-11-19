<?php

namespace App\Http\Controllers;

use App\Models\dosen;
use Illuminate\View\View;

class DosenController extends Controller
{
    public function index(): View 
    {
        $dosen = dosen::orderBy('KODE_DOSEN', 'ASC')->get();
        return view('admin.dosen', compact('dosen'));

    }
}
