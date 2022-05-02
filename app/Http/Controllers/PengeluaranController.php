<?php

namespace App\Http\Controllers;

use App\Models\Keuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PengeluaranController extends Controller
{
    public function index()
    {  
        $now = Carbon::now();
        // dd($now->format('Y-m-d'));
        $pengeluaran = DB::table("keuangans")->where('created_at', "01");
        // foreach($pengeluaran as $p){
        //     echo $p->tanggal;
        // }
        dd($pengeluaran);
        $title = "Pengeluaran Keuangan";
        $data = Keuangan::where("jenis", "credit")->get();
        return view("pengeluaran.index", ['title' => $title, "data" => $data]);
    }

    public function tambah()
    {
        $title = "Pengeluaran Keuangan";
        return view("pengeluaran.tambah", ['title' => $title]);
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
        $keuangan->jenis = "credit";
        $keuangan->keterangan = $data["keterangan"];
        $keuangan->save();
        // dd($keuangan);
        return back()->with("success", "Pendapatan berhasil ditambah");

        // dd($tanggal);
    }
}
