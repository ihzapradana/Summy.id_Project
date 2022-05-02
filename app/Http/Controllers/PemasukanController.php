<?php

namespace App\Http\Controllers;

use App\Models\Keuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PemasukanController extends Controller
{
    public function index()
    {
        $title = "Pemasukan Keuangan";
        $data = Keuangan::where("jenis", "debit")->get();
        return view("pemasukan.index", ['title' => $title, "data" => $data]);
    }

    public function tambah()
    {
        $title = "Pemasukan Keuangan";
        return view("pemasukan.tambah", ['title' => $title]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $valid = Validator::make($data, [
            "tanggal" => ['string', 'required'],
            "nominal" => ['string', 'required'],
            "keterangan" => ['string'],
        ]);
        $tanggal = explode("-", $data["tanggal"])[2];
        $tanggal = (int)$tanggal;
        if($tanggal >= 1 && $tanggal <= 7)
        {
            $minggu = 1;
        }
        else if($tanggal > 7 && $tanggal <= 14)
        {
            $minggu = 2;
        }
        else if($tanggal > 14 && $tanggal <= 21)
        {
            $minggu = 3;
        }else{
            $minggu = 4;
        }

        $keuangan = new Keuangan();
        $keuangan->tanggal = $data["tanggal"];
        $keuangan->minggu = $minggu;
        $keuangan->nominal = $data["nominal"];
        $keuangan->jenis = "debit";
        $keuangan->keterangan = $data["keterangan"];
        $keuangan->save();

        return back()->with("success", "Pendapatan berhasil ditambah");

        // dd($tanggal);
    }

}
