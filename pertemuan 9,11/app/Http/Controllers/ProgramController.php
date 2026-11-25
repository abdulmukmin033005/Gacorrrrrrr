<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    // Menampilkan semua data program
    public function index()
    {
        $programs = Program::all();

        return view('programs.index', compact('programs'));
    }

    // Menampilkan halaman tambah program
    public function create()
    {
        return view('programs.create');
    }

    // Menyimpan data program
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
        ]);

        Program::create($request->all());

        return redirect()->route('programs.index');
    }

    // Menampilkan halaman edit
    public function edit($id)
    {
        $program = Program::findOrFail($id);

        return view('programs.edit', compact('program'));
    }

    // Memperbarui data program
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
        ]);

        $program = Program::findOrFail($id);

        $program->update($request->all());

        return redirect()->route('programs.index');
    }

    // Menghapus data program
    public function destroy($id)
    {
        $program = Program::findOrFail($id);

        $program->delete();

        return redirect()->route('programs.index');
    }
}