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
                        <form method="post" action="{{ route('product.update') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" placeholder="nama.." value='{{ $product->nama }}' required oninvalid="this.setCustomValidity('data harus diisi.')" oninput="setCustomValidity('')" name="nama" class="form-control" id="name" required>
                            </div> 
                            <div class="mb-3">
                                <label for="name" class="form-label">Harga</label>
                                <input type="number" placeholder="harga.." value='{{ $product->harga }}' required oninvalid="this.setCustomValidity('data harus diisi.')" oninput="setCustomValidity('')" name="harga" class="form-control" id="name" required>
                            </div>  
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Description</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" required oninvalid="this.setCustomValidity('data harus diisi.')" oninput="setCustomValidity('')" rows="3">{{ $product->deskripsi }}</textarea>
                            </div>
                            <img class="img-thumbnail rounded" width="400" src="{{ asset('images/photos') }}/{{ $product->foto }}" alt="">
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Photo</label>
                                <input class="form-control" required oninvalid="this.setCustomValidity('data harus diisi.')" oninput="setCustomValidity('')" type="file" name="photo" id="formFile">
                            </div>

                            <button type="submit" class="btn btn-primary float-end"><i class="bi bi-plus-lg"></i> Edit data</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
</main>

@endsection


@section('scripts')

@endsection