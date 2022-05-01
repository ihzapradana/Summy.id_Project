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
                        <form method="post" action="{{ route('laporan.update') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $laporan->id }}">

                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Description</label>
                                <textarea class="form-control" id="deskripsi" name="description" rows="3">{{ $laporan->description }}</textarea>
                            </div>
                            <img src="{{ asset('images/photos/'.$laporan->photo) }}" width="200" class="img-thumbnail" alt="">
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Photo</label>
                                <input class="form-control" type="file" name="photo" id="formFile">
                            </div>
                            <button type="submit" class="btn btn-primary float-end">Edit data</button>
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