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
                        <form method="post" action="{{ route('laporan.store') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Description</label>
                                <textarea required oninvalid="this.setCustomValidity('data harus diisi.')" oninput="setCustomValidity('')" class="form-control" id="deskripsi" name="description" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Photo</label>
                                <input required oninvalid="this.setCustomValidity('data harus diisi.')" oninput="setCustomValidity('')" class="form-control" type="file" name="photo" id="formFile">
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

@endsection