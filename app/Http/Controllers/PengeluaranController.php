<?php

namespace App\Http\Controllers;

use App\Models\Keuangan;
use App\Models\Pendapatan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PengeluaranController extends Controller
{
    public function index()
    {  
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

        $date = explode("-", $data["tanggal"]);
        $tanggal = $date[2];
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




        $jumlah = DB::table('pendapatans')
        ->whereMonth('tanggal', $date[1])
        ->whereYear('tanggal', $date[0])
        ->get();


        if($jumlah->count() == 0){
            $pendapatan = new Pendapatan();
            $pendapatan->tanggal = $data["tanggal"];
            $pendapatan->untung = 0;
            $pendapatan->rugi = $data["nominal"];
            $pendapatan->total =  $data["nominal"];
            $pendapatan->save();
            // echo "ok";
            return back()->with("success", "Pendapatan berhasil ditambah");
        }
    
        $old_data = $jumlah->last();
        $pendapatans = Pendapatan::find( $old_data->id);

        $date1 = Carbon::createFromFormat('Y-m-d', $data["tanggal"]);
        $date2 = Carbon::createFromFormat('Y-m-d', $old_data->tanggal);
        $untung = $old_data->untung;
        $rugi = $old_data->rugi + $data["nominal"];
        $pendapatans->update([
            "tanggal" =>  $date1->gte($date2) ? $data['tanggal'] : $old_data->tanggal,
            "rugi" =>  $rugi,
            "total" => $untung - $rugi
        ]);

        // dd($keuangan);
        return back()->with("success", "Pendapatan berhasil ditambah");

        // dd($tanggal);
    }

    public function delete($id)
    {
        $keuangan = Keuangan::find($id);
        $date = explode("-", $keuangan->tanggal);
        $pendapatan = DB::table('pendapatans')
        ->whereMonth('tanggal', $date[1])
        ->whereYear('tanggal', $date[0])
        ->get()->last();

        $update_pendapatan = Pendapatan::find($pendapatan->id);
        $untung = $pendapatan->untung;
        $rugi = $pendapatan->rugi - $keuangan->nominal;
        $total = $untung - $rugi;
        $update_pendapatan->update([
            "rugi" => $rugi,
            "total" => $total,
        ]);
        // dd($pendapatan);
        $keuangan->delete();
        return back()->with('success', 'Data Berhasil dihapus');
    }
}
