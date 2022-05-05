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
                        <a href="{{ route('pengeluaran.tambah') }}" class="btn btn-primary float-end"><i class="bi bi-plus-lg"></i> Add</a>
                    </div>
                    <div class="card-body">
                        <table id="table_id" class="display table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Minggu ke-</th>
                                    <th>Nominal</th>
                                    <th>Keterangan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach ($data as $dt)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $dt->tanggal }}</td>
                                    <td>{{ $dt->minggu }}</td>
                                    <td>Rp. {{ number_format($dt->nominal,2,',','.') }}</td>
                                    <td>{{ $dt->keterangan }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('pengeluaran.delete',  $dt->id) }}" id="deletepengeluaran" class="text-danger fw-bolder"><i class="bi bi-trash3-fill"></i></a>
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