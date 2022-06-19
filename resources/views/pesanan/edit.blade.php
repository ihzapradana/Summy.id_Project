@extends('layouts.app')

@section('title')
<h1>{{ $title }}</h1>
@endsection

@section('content')
<main class="content">
    <div class="container-fluid p-0">


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="fw-bold">Edit Data Pemesanan</h2>
                        @if(session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                        <hr>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <img class="img-fluid rounded" src="{{ asset('images/photos') }}/{{ $pesanan->product->foto }}" alt="">
                            </div>
                            <div class="col-md-9">
                                <h3 class="fw-bold">Data pesanan</h3>
                                <hr>
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <span class="fw-bold">Invoice</span>
                                    </div>
                                    <div class="col-md-6 text-end">
                                        <p>{{ $pesanan->invoice }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <span class="fw-bold">Nama</span>
                                    </div>
                                    <div class="col-md-6 text-end">
                                        <p>{{ $pesanan->product->nama }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <span class="fw-bold">Harga</span>
                                    </div>
                                    <div class="col-md-6 text-end">
                                        <p>{{ $pesanan->product->harga }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <span class="fw-bold">Jumlah</span>
                                    </div>
                                    <div class="col-md-6 text-end">
                                        <p>{{ $pesanan->jumlah }}</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <span class="fw-bold">Total</span>
                                    </div>
                                    <div class="col-md-6 text-end">
                                        <h4 class="fw-bold text-success">{{ $pesanan->total }}</h4>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        {{-- <span class="fw-bold">Total</span> --}}
                                    </div>
                                    <div class="col-md-6 text-end">
                                        <h4 class="fw-bold {{ is_null($pesanan->bukti) ? 'text-danger' : 'text-success'   }} ">
                                            {{ is_null($pesanan->bukti) ? "Belum Dibayar" : "Sudah Dibayar" }}
                                        </h4>
                                    </div>
                                </div>

                            </div>
                        </div>
                        @if ($pesanan->status == 'pending' || Auth::user()->role == 'owner')                            
                            <div class="row mt-5">
                                <div class="col-md-3">

                                </div>
                                <div class="col-md-9">
                                    <h3 class="fw-bold">Edit Pesanan</h3>
                                    <hr>
                                    <form action="{{ route('pesanan.update') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $pesanan->id }}">
                                        @if (Auth::user()->role == 'customer')
                                            <input type="hidden" name="harga" value="{{ $pesanan->product->harga }}">
                                            <div class="mb-3">
                                            <label for="jumlahpesanan" class="form-label">Edit Jumlah</label>
                                            <input type="number" name="jumlah" {{ !is_null($pesanan->bukti) ? 'readonly' : '' }} class="form-control" id="jumlahpesanan" min="1" value="{{ $pesanan->jumlah }}" required oninvalid="this.setCustomValidity('data harus diisi.')" oninput="setCustomValidity('')">
                                            <div class="form-text text-warning">Jangan rubah jika cuma melakukan pembayaran</div>
                                            </div>
                                            @if (!is_null($pesanan->bukti))                                        
                                                <div class="mb-3">
                                                    <img class="img-fluid rounded" src="{{ asset('images/bukti')}}/{{ $pesanan->bukti }}" alt="">
                                                </div>
                                            @endif
                                            <div class="mb-3">
                                                <label for="formFile" class="form-label">Bukti Pembayaran</label>
                                                <input class="form-control"  type="file" name="bukti" id="formFile">
                                            </div>
                                            @if (is_null($pesanan->bukti))                                        
                                                <div class="mb-3">
                                                    <label for="batal" class="form-label">Pembatalan</label>
                                                    <select class="form-select" name="status" aria-label="Default select example">
                                                        <option value="" selected></option>
                                                        <option value="canceled">Batalkan</option>
                                                    </select>
                                                    <div class="form-text text-warning">Jika sudah dibatalkan tidak bisa dikembalikan.</div>
                                                </div>
                                            @endif
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        @else
                                            @if (!is_null($pesanan->bukti))          
                                                <input type="hidden" name="jumlah" value="{{ $pesanan->jumlah }}">                              
                                                <input type="hidden" name="harga" value="{{ $pesanan->product->harga }}">                              
                                                <div class="mb-3">
                                                    <img class="img-fluid rounded" src="{{ asset('images/bukti')}}/{{ $pesanan->bukti }}" alt="">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="batal" class="form-label">Verifikasi Pesanan</label>
                                                    <select class="form-select" name="status" aria-label="Default select example">
                                                        {{-- <option value="" selected></option> --}}
                                                        <option value="success">Sukses</option>
                                                        <option value="canceled">Batalkan</option>
                                                    </select>
                                
                                                </div>
                                                <button type="submit" class="btn btn-primary">Edit data</button>
                                            @endif
                                        @endif
                                        
  
                                        
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>

    </div>
</main>

@endsection


@section('scripts')

@endsection 