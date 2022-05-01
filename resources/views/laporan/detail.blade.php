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
                    <div class="card-header text-center">
                        <img class="img-thumbnail" width="300px" src="/images/photos/{{ $laporans->photo }}" alt="">
                    </div>
                    <div class="card-body">
                        <p class="text-muted">Dibuat: {{ $laporans->created_at }}</p>
                        <p>oleh: {{ $laporans->user->name }}</p>
                        <p>{{ $laporans->description }}</p>
                    </div>
                </div>
            </div>

        </div>

    </div>
</main>

@endsection


@section('scripts')

@endsection