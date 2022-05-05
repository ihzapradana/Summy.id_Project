<?php

namespace App\Http\Controllers;

use App\Models\Keuangan;
use App\Models\Pendapatan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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



        

        // dd($tanggal);
        $jumlah = DB::table('pendapatans')
        ->whereMonth('tanggal', $date[1])
        ->whereYear('tanggal', $date[0])
        ->get();

        $keuangan = new Keuangan();
        $keuangan->tanggal = $data["tanggal"];
        $keuangan->minggu = $minggu;
        $keuangan->nominal = $data["nominal"];
        $keuangan->jenis = "debit";
        $keuangan->keterangan = $data["keterangan"];
        $keuangan->save();

        if($jumlah->count() == 0){
            $pendapatan = new Pendapatan();
            $pendapatan->tanggal = $data["tanggal"];
            $pendapatan->untung = $data["nominal"];
            $pendapatan->rugi = 0;
            $pendapatan->total =  $data["nominal"];
            $pendapatan->save();
            // echo "ok";
            return back()->with("success", "Pendapatan berhasil ditambah");
        }
    


        $old_data = $jumlah->last();
        $pendapatans = Pendapatan::find( $old_data->id);
        
        $date1 = Carbon::createFromFormat('Y-m-d', $data["tanggal"]);
        $date2 = Carbon::createFromFormat('Y-m-d', $old_data->tanggal);
        $untung = $old_data->untung + $data["nominal"];
        $rugi = $old_data->rugi;
        $pendapatans->update([
            "tanggal" =>  $date1->gte($date2) ? $data['tanggal'] : $old_data->tanggal,
            "untung" =>  $untung,
            "total" => $untung - $rugi
        ]);



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
        $untung = $pendapatan->untung - $keuangan->nominal;
        $rugi = $pendapatan->rugi;
        $total = $untung - $rugi;
        $update_pendapatan->update([
            "untung" => $untung,
            "total" => $total,
        ]);
        // dd($pendapatan);
        $keuangan->delete();
        return back()->with('success', 'Data Berhasil dihapus');
    }

}
