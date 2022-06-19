@extends('layouts.app')

@section('title')
<h1>{{ $title }}</h1>
@endsection

@section('content')
<main class="content">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12">
                <div class="card flex-fill">
                    <div class="card-header">
                        @if(session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                        {{-- <a href="{{ route('pengeluaran.tambah') }}" class="btn btn-primary float-end"><i class="bi bi-plus-lg"></i> Add</a> --}}
                    </div>
                    <div class="card-body">
                        <table id="table_id" class="display table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Invoice</th>
                                    <th>Nama Product</th>
                                    <th>Harga total</th>
                                    <th>Status Pembayaran</th>
                                    <th>Status Product</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach ($pesanan as $dt)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $dt->invoice }}</td>
                                    <td>{{ $dt->product->nama }}</td>
                                    <td>Rp. {{ $dt->total }}</td>
                                    <td>
                                        <?php
                                            if(is_null($dt->bukti)){
                                                echo "Belum dibayar";
                                            }else{
                                                echo "Sudah dibayar";
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        @if ($dt->status == 'success')
                                            <div class="badge bg-success">{{ $dt->status }}</div>
                                        @elseif ($dt->status == 'canceled')
                                            <div class="badge bg-danger">{{ $dt->status }}</div>
                                        @else
                                            <div class="badge bg-warning">{{ $dt->status }}</div>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if (Auth::user()->role != 'petani')
                                        <a href="{{ route('pesanan.edit',  $dt->invoice) }}" class="text-primary fw-bolder"><i class="bi bi-pencil-square"></i></a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('scripts')
<script>
    $(document).ready( function () {
        var table = $('#table_id').DataTable({
            
        });
    } );
</script>
@endsection