<?php

namespace App\Http\Controllers;

use App\Models\adminps;
use Illuminate\View\View;

class AdminPSController extends Controller
{
    public function index(): View 
    {
        $adminps = adminps::orderBy('ID_ADMIN', 'ASC')->get();
        return view('admin.adminps', compact('adminps'));

    }
}
