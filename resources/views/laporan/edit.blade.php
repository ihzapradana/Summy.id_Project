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
                        <form method="post" action="{{ route('laporan.update') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $laporan->id }}">
                            <div class="mb-3">
                                <label for="name" class="form-label">NAME</label>
                                <input type="text" value="{{ $laporan->name }}" placeholder="Name" name="name" class="form-control" id="name">
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Date</label>
                                <input type="text" value="{{ $laporan->date }}" placeholder="date" name="date" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Description</label>
                                <textarea class="form-control" id="deskripsi" name="description" rows="3">
                                    {{ $laporan->description }}
                                </textarea>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Photo</label>
                                <input type="text" class="form-control" value="{{ $laporan->photo }}" name="photo" placeholder="photo" id="exampleInputPassword1">
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