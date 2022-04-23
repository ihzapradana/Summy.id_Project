<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LaporanController extends Controller
{
    public function index()
    {
        $title = "Laporan";
        $laporan = Laporan::get();
        return view('laporan.index', ['title' => $title, 'laporans' => $laporan]);
    }

    public function tambah()
    {
        $title = "Laporan";
        return view('laporan.tambah', ['title' => $title]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $valid = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'date' => ['required', 'string'],
            'description' => ['required', 'string'],
            'photo' => ['required', 'string'],
        ]);

        $laporan = Laporan::create([
            'name' => $data['name'],
            'date' => $data['date'],
            'description' => $data['description'],
            'photo' => $data['photo'],
        ]);
    
        return back()->with('success', 'Data Berhasil diperbarui');
    }

    public function edit($id)
    {
        $title = 'Edit Laporan';
        $laporan = Laporan::find($id);
        return view('laporan.edit', ['title' => $title, 'laporan' => $laporan]);
    }

    public function update(Request $request)
    {
        $data = $request->all();
        $valid = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'date' => ['required', 'string'],
            'description' => ['required', 'string'],
            'photo' => ['required', 'string'],
        ]);
        $laporan = Laporan::find($data['id']);
        $laporan->update($data);
        return back()->with('success', 'Data Berhasil diperbarui');

    }

    public function delete($id)
    {
        $user = Laporan::find($id);
        $user->delete();
        return back()->with('success', 'Data Berhasil dihapus');
    }
}
