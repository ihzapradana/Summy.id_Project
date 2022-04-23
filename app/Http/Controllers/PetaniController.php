<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class PetaniController extends Controller
{
    public function index()
    {
        $user = User::get();
        $title = "Petani";
        return view('petani.index', ['user' => $user, 'title' => $title]);
    }

    public function tambah()
    {
        $title = "Add Petani";
        return view('petani.tambah', ['title' => $title]);
    }

    public function edit($id)
    {
        $title = 'Edit Petani';
        $user = User::find($id);
        return view('petani.edit', ['title' => $title, 'user' => $user]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $valid = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'min:6', 'unique:users', 'alpha_dash'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'numeric', 'min:11', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $user = User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
        ]);

        return redirect('petani')->with('success', 'Data Berhasil ditambah');;
    }

    public function update(Request $request)
    {
        $data = $request->all();
        $valid = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'min:6', 'unique:users', 'alpha_dash'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'numeric', 'min:11', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $user = User::find($data['id']);
        $user->update($data);
        return back()->with('success', 'Data Berhasil diperbarui');
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return back()->with('success', 'Data Berhasil dihapus');
    }
}
