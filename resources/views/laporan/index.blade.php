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
                        <a href="/laporan/tambah" class="btn btn-primary float-end"><i class="bi bi-plus-lg"></i> Add</a>
                    </div>
                    <div class="card-body">
                        <table id="table_id" class="display">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th>Photo</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach ($laporans as $laporan)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $laporan->name }}</td>
                                    <td>{{ $laporan->date }}</td>
                                
                                    <td>{{ substr($laporan->description, 0, 80 )}}...</td>
                                    <td>{{ $laporan->photo }}</td>
                                    <td class="text-center">
                                        @if (Auth::user()->role == 'petani')
                                            <a href="#" class="btn btn-primary">View More</a>
                                        @else
                                        <a href="{{ route('laporan.delete',  $laporan->id) }}" data-id="{{ $laporan->id }}" class="text-danger fw-bolder"><i class="bi bi-trash3-fill"></i></a> | 
                                        <a href="{{ route('laporan.edit',  $laporan->id) }}" data-id="{{ $laporan->id }}" class="text-primary fw-bolder"><i class="bi bi-pencil-square"></i></a>
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