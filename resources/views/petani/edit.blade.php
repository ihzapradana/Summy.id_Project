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
                        {{-- <h5 class="card-title mb-0">Input</h5> --}}
                        @if(session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('petani.update') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <div class="mb-3">
                                <label for="name" class="form-label">NAME</label>
                                <input type="text" value="{{ $user->name }}" placeholder="Name" name="name" class="form-control" id="name">
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">USERNAME</label>
                                <input type="text" value="{{ $user->username }}" placeholder="Username" name="username" class="form-control" id="name">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <input type="email" value="{{ $user->email }}" class="form-control" name="email" placeholder="Email" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Password" id="exampleInputPassword1">
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">PHONE</label>
                                <input type="text" value="{{ $user->phone }}" placeholder="Phone" class="form-control" name="phone" id="phone">
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