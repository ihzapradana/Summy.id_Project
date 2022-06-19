@extends('layouts.app')


@section('title')
<h1>{{ $title }}</h1>
@endsection

@section('content')
<main class="content">
    <div class="container-fluid p-0">

        @if (Auth::user()->role == 'customer')
            <div class="row">
                {{-- @for ($i = 0; $i < 20; $i++) --}}
                @foreach ($product as $prd)                    
                    <div class="col-md-3">
                        <div class="card">
                            <img src="{{ asset('images/photos').'/'.$prd->foto }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{ $prd->nama }}</h5>
                                <p class="card-text">{{ substr($prd->deskripsi, 0, 40) }}....</p>
                                <div class="mb-2">
                                    <span class="font-bold"><strong>Rp. {{ $prd->harga }}</strong></span>
                                </div>
                                
                            </div>
                            <div class="card-footer d-flex justify-content-end">
                                <a href="{{ route('product.detail', $prd->slug) }}" class="btn btn-primary">detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{-- @endfor --}}
            </div>
        @else        
            <div class="row">
                <div class="col-12">
                    <div class="card flex-fill">
                        <div class="card-header">
                            @if(session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                            @endif
                       
                            <a href="{{ route('product.tambah') }}" class="btn btn-primary float-end"><i class="bi bi-plus-lg"></i> Add</a>
                            
                        </div>
                        <div class="card-body">
                            <table id="table_id" class="display table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Foto</th>
                                        <th>Harga</th>
                                        <th>Deskripsi</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    @foreach ($product as $usr)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $usr->nama }}</td>
                                        <td><img class="img-thumbnail" width="120" src="{{ asset('images/photos') . '/' . $usr->foto }}" alt=""></td>
                                        <td>{{ $usr->harga }}</td>
                                        <td>{{ substr($usr->deskripsi, 0, 60) }}...</td>
                                        <td class="text-center">
                                            <a href="{{ route('product.detail',  $usr->slug) }}" class="text-secondary fw-bolder"><i class="bi bi-eye-fill"></i></a> | 
                                            {{-- <a href="{{ route('product.delete',  $usr->id) }}" class="text-danger fw-bolder"><i class="bi bi-trash3-fill"></i></a> |  --}}
                                            <a href="{{ route('product.edit', $usr->id) }}" class="text-primary fw-bolder"><i class="bi bi-pencil-square"></i></a>
                                        </td>
                                    </tr>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        @endif

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