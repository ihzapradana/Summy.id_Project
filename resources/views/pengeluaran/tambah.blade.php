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
                        @if(session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('pengeluaran.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Tanggal</label>
                                <input type="text" placeholder="2021-12-12" name="tanggal" class="form-control" id="name">
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Nominal (Rp)</label>
                                <input type="text" placeholder="10000000" name="nominal" class="form-control" id="name">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Keterangan</label>
                                <input type="text" class="form-control" name="keterangan" placeholder="Keterangan" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <button type="submit" class="btn btn-primary float-end"><i class="bi bi-plus-lg"></i> Add data</button>
                        </form>
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
        $('#table_id').DataTable();
    } );
</script>
@endsection