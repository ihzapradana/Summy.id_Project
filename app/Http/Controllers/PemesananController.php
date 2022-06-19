<?php

namespace App\Http\Controllers;

use App\Models\Keuangan;
use App\Models\KeuanganDetail;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PemesananController extends Controller
{
    public function index()
    {
        $title = "Pesananku";
        if(Auth::user()->role == 'customer'){
            $data = Pemesanan::with('product')->where("id_user", Auth::user()->id)->get();
        }else{
            $data = Pemesanan::with('product')->get();
        }

        
        
        return view("pesanan.index", ['title' => $title, "pesanan" => $data]);
    }

    public function edit($invoice){
        $pesanan = Pemesanan::where('invoice', $invoice)->first();
        // dd($pesanan);
        $title = "Edit Pemesanan";
        return view('pesanan.edit', ['title' => $title, 'pesanan' => $pesanan]);
    }

    public function update(Request $request)
    {
        $data = $request->all();

        // dd($data);
        $pesanan = Pemesanan::find($data['id']);
        if( !isset($data['bukti']) ){
            // dd($data);
            $status = is_null($data['status']) ? 'pending' : $data['status'];
            $pesanan->update([
                'jumlah'    => $data['jumlah'],
                'status'    => $status,
                'total'     => $data['jumlah'] * $data['harga']
            ]);
            if($status == "success"){
                $tanggal = date("Y-m-d");
                // dd($tanggal);
                $keuangan = Keuangan::where('tahun', tahun($tanggal))
                ->where('bulan', bulan($tanggal))
                ->first();

                if($keuangan != null){
                    KeuanganDetail::create([
                    'keuangan_id' => $keuangan->id,
                    'tanggal' => $tanggal,
                    'nominal' => $data['jumlah'] * $data['harga'],
                    'status' => 'untung',
                    'keterangan' => "pemasukan dari pembelian",
                    ]);
                }else{
                    $keuangan = Keuangan::create([
                    // 'tanggal' => $tanggal,
                    'tahun' => tahun($tanggal),
                    'bulan' => bulan($tanggal),
                    ]);

                    KeuanganDetail::create([
                    'keuangan_id' => $keuangan->id,
                    'tanggal' => $tanggal,
                    'nominal' => $data['jumlah'] * $data['harga'],
                    'status' => 'untung',
                    'keterangan' => "pemasukan dari pembelian"
                    ]);
                }
            }
        }else{
            $file = $request->file('bukti');
            $status = is_null($data['status']) ? 'pending' : $data['status'];
            $file->move('images/bukti',$file->getClientOriginalName());
            $pesanan->update([
                'jumlah' => $data['jumlah'],
                'status'    => $status,
                'total' => $data['jumlah'] * $data['harga'],
                'bukti' => $file->getClientOriginalName()
            ]);
        }
        return back()->with('success', 'Data Berhasil diperbarui');


    }

}
