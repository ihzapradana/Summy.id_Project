@extends('layouts.auth')

@section('content')
    	<section class="h-50">
		<div class="container h-50">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<div class="card fat">
						<div class="brand">
							<img src="{{ asset('images/logo.png') }}" alt="logo">
						</div>
						<div class="card-body">
							<h4 class="card-title">Summy.id</h4>
							<h5 class="continue">Log In to continue</h5>
							<p class="enter">Enter your username and password below</p>
							<form method="POST" class="login-validation" action="{{ route('login') }}">
								@csrf
                                <div class="form-group">
                                    <label for="username" >{{ __('USERNAME') }}</label>
                                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password" >
                                        {{ __('PASSWORD') }}
                                        <a href="/" class="text-muted float-right">
											forgot password?
										</a>
                                    </label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="password" autofocus>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
								<div class="form-group m-0">
									<button type="submit" class="btn btn-primary btn-block">
										Login
									</button>
								</div>
								<div class="mt-4 text-center">
									Don't have an account? <a href="{{ route('register') }}">Sign up</a>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


@endsection
