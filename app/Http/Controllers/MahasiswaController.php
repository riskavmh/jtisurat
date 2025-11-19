<?php

namespace App\Http\Controllers;

use App\Models\mahasiswa;
use Illuminate\View\View;

class MahasiswaController extends Controller
{
    public function index(): View 
    {
        $mahasiswa = mahasiswa::orderBy('ID_USER', 'ASC')->get();
        return view('admin.mahasiswa', compact('mahasiswa'));

    }
}
