@extends('layouts.app')


@section('title')
<h1>{{ $title }}</h1>
@endsection

@section('content')
<main class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card p-3">
                    <h1 class="text-center text-success text-lg-center display-1 fw-bold">
                        <i class="bi bi-bag-check"></i>
                    </h1>
                    <h2 class="mt-3 text-center fw-bold">
                        Sukses ditambahkan di daftar pesanan
                    </h2>
                    <p class="text-center mt-2">
                        Nomor Pesanannmu : {{ $pesan['invoice'] }} <br>
                        Harga Total: {{ $pesan['jumlah'] }} <br>
                        Silahkan transfer melalui nomer rekening: 988787223578234
                    </p>
                    <h4>Tata cara pembayaran:</h4>
                    <ul>
                        <li>Silahkan Transfer ke nomer rekening diatas (Harap Di Screenshot supaya tidak lupa)</li>
                        <li>Setelah selesai transfer jangan lupa memfoto bukti transfer</li>
                        <li>Masuk ke menu data pemesanan</li>
                        <li>Edit Data pesanan sesuai nomer pesanan di atas</li>
                        <li>Upload bukti pembayaran</li>
                        <li>Tunggu konfirmasi</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection


@section('scripts')
<script>


</script>
@endsection