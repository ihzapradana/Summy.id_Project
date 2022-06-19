<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Produk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $title = "Product";
        $product = Produk::get();
        return view('product.index', ['title' => $title, 'product' => $product]);
    }

    public function detail($slug)
    {
        $product = Produk::where('slug', $slug)->first();
        return view('product.detail', ['title' => 'Detail Product', 'product' => $product]);
    }

    public function edit($id)
    {
        $title = "Edit data produk";
        $product = Produk::find($id);
        return view('product.edit', ['title' => $title, 'product' => $product]);
    }

    public function update(Request $rq)
    {
        $data = $rq->all();
        if(isset($data['photo'])){
            $file = $rq->file('photo');
            // dd($data);
            $file->move('images/photos',$file->getClientOriginalName());
            $product = Produk::find($data['id']);
            $product->update([
                'nama' => $data['nama'],
                'slug' => Str::slug($data['nama'], '-'),
                'harga' => $data['harga'],
                'deskripsi' => $data['deskripsi'],
                'foto' => $file->getClientOriginalName(),
            ]);
            return back()->with('success', 'Data Berhasil diperbarui');
        }
        $product = Produk::find($data['id']);
        $product->update([
            'nama' => $data['nama'],
            'slug' => Str::slug($data['nama'], '-'),
            'harga' => $data['harga'],
            'deskripsi' => $data['deskripsi'],
        ]);
        return back()->with('success', 'Data Berhasil diperbarui');
    }

    public function tambah()
    {
        $title = "Tambah Product";
        // $product = Produk::get();
        return view('product.tambah', ['title' => $title]);
    }

    public function checkout(Request $rq){
        $data = $rq->all();
        $title = "Tambah Product";
        $product = Produk::find($data['product_id']);
        $invoice = invoice();
        $pesan = [
            "invoice" => $invoice,
            "jumlah" => $product['harga'] * $data['jumlah']
        ];

        Pemesanan::create([
            'invoice' => $invoice,
            'id_user' => Auth::user()->id,
            'id_product' => $data['product_id'],
            'jumlah' => $data['jumlah'],
            'total' => $product['harga'] * $data['jumlah'],
            'status' => 'pending'
        ]);

        return view('product.berhasil', ['title' => $title, 'pesan' => $pesan]);
    }

    public function success()
    {
        return view('product.berhasil', ['title' => "Sukses dipesan"]);
    }

    public function store(Request $request){
        $data = $request->all();
        // dd($data);
        $file = $request->file('photo');
        // dd($data);
        $file->move('images/photos',$file->getClientOriginalName());

        Produk::create([
            'nama' => $data['nama'],
            'slug' => Str::slug($data['nama'], '-'),
            'harga' => $data['harga'],
            'deskripsi' => $data['deskripsi'],
            'foto' => $file->getClientOriginalName(),
        ]);

        return back()->with('success', 'Data Berhasil ditambahkan');

    }

    public function delete($id)
    {
        $product = Produk::find($id);
        $product->delete();
        return back()->with('success', 'Data Berhasil dihapus.');
    }
}
