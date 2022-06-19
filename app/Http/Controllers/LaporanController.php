<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LaporanController extends Controller
{
    public function index()
    {
        $title = "Laporan";
        if(Auth::user()->role == 'owner'){
            $laporan = Laporan::get();
        }else{
            $laporan = Laporan::where('user_id', Auth::user()->id)->get();
        }
        return view('laporan.index', ['title' => $title, 'laporans' => $laporan]);
    }

    public function detail($id)
    {
        $laporan = Laporan::with(['user'])->find($id);
        $title = "Detail Laporans";
        return view('laporan.detail', ['title' => $title, 'laporans' => $laporan]);
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
            'description' => ['required', 'string'],
            'photo' => ['required', 'string'],
        ]);

        $file = $request->file('photo');
        $file->move('images/photos',$file->getClientOriginalName());
       
        $laporan = new Laporan();
        $laporan->user_id = $data['user_id'];
        $laporan->description = $data['description'];
        $laporan->photo = $file->getClientOriginalName();
        $laporan->save();
    
        return back()->with('success', 'Data Berhasil ditambahkan');
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
            'description' => ['required', 'string'],
            'photo' => ['required', 'string']
        ]);
        $file = $request->file('photo');
     
        $file->move('images/photos',$file->getClientOriginalName());


        $laporan = Laporan::find($data['id']);
        $laporan->update([
            "description" =>  $data['description'],
            "photo" => $file->getClientOriginalName()
        ]);
        return back()->with('success', 'Data Berhasil diperbarui');

    }

    public function delete($id)
    {
        $user = Laporan::find($id);
        $user->delete();
        return back()->with('success', 'Data Berhasil dihapus');
    }
}
