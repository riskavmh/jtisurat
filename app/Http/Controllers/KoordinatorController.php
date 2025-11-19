<?php

namespace App\Http\Controllers;

use App\Models\koordinator;
use Illuminate\View\View;

class koordinatorController extends Controller
{
    public function index(): View 
    {
        $koordinator = koordinator::orderBy('KODE_KOORDINATOR', 'ASC')->get();
        return view('admin.koordinator', compact('koordinator'));

    }
}
