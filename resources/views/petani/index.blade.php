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
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach ($user as $usr)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $usr->name }}</td>
                                    <td>{{ $usr->username }}</td>
                                    <td>*****</td>
                                    <td>{{ $usr->email }}</td>
                                    <td>{{ $usr->phone }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('petani.delete',  $usr->id) }}" data-id="{{ $usr->id }}" id="deletePetani" class="text-danger fw-bolder"><i class="bi bi-trash3-fill"></i></a> | 
                                        <a href="{{ route('petani.edit',  $usr->id) }}" data-id="{{ $usr->id }}" id="editPetani" class="text-primary fw-bolder"><i class="bi bi-pencil-square"></i></a>
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