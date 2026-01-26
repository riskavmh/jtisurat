<?php

namespace App\Http\Controllers;

use App\Models\LetterType;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LetterTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View 
    {
        $type = LetterType::orderBy('id', 'ASC')->get();
        return view('admin.type.index', compact('type'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'abbr'     => 'required|max:10|min:2',
            'expan'       => 'required|max:50|min:5'
        ]);
        LetterType::create([
            'abbr'     => Str::upper($request->abbr),
            'expan'       => Str::title($request->expan)
        ]);
        return redirect()->route('type.index')->with(['success' => 'Data Berhasil Ditambahkan!']);
        // var_dump(Str::upper($request->type),Str::title($request->ket));

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $type = LetterType::findOrFail($id);
        return view('admin.type.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'abbr'     => 'required|max:10|min:2',
            'expan'       => 'required|max:50|min:5'
        ]);
        
        $type = LetterType::findOrFail($id);
        // dd(Str::upper($request->abbr),Str::title($request->expan));
        $type->update([
            'abbr'     => Str::upper($request->abbr),
            'expan'       => Str::title($request->expan)
        ]);
        return redirect()->route('type.index')->with('Data Berhasil Diubah!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        LetterType::findOrFail($id)->delete();
        return redirect()->route('type.index')->with(['success' => 'Data Berhasil Dihapus']);
        // dd(LetterType::findOrFail($id));
    }
}
