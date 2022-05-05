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
                        <a href="/petani/tambah" class="btn btn-primary float-end"><i class="bi bi-plus-lg"></i> Add</a>
                    </div>
                    <div class="card-body">
                        <table id="table_id" class="display table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tahun</th>
                                    <th>Bulan</th>
                                    <th>Income</th>
                                    <th>Outcome</th>
                                    <th>Total</th>
                                    {{-- <th>Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1 ?>
                                @foreach ($pendapatans as $pendapatan)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ explode('-', $pendapatan->tanggal)[0] }}</td>
                                    <td>{{ explode('-', $pendapatan->tanggal)[1]  }}</td>
                                    <td>{{ $pendapatan->untung }}</td>
                                    <td>{{ $pendapatan->rugi }}</td>
                                    <td>{{ $pendapatan->total }}</td>
                                    {{-- <td class="text-center">
                                       
                                    </td> --}}
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