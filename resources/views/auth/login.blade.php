@extends( 'layouts.plantilla' )
<link rel="stylesheet" media="screen" href="css/style.css">
@section( 'cuerpo' )

<main role="main" >
	<div class="card"><!-- {{ __('Login') }} -->
				<div class="card-header">
					<img style="opacity: 0.4; width: 70%; height: 120px;" src="/images/logotipo-05.jpg"></div>
					
				</div>
				<div class="card-body">
					<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">
						{!! trans('messages.login') !!}

						<form method="POST" action="{{ route('login') }}">
								@csrf
								<div class="form-group	">
									<label for="email" class="col-form-label text-md-right">{!! trans('messages.E-Mail Address') !!}<!-- {{ __('E-Mail Address') }} --></label>

									<div class="col-12">
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text" id="basic-addon1">@</span>
											</div>
											<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus> @error('email')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
											@enderror
										</div>
									</div>
								</div>
								<div class="form-group mb-4">
									<label for="password" class="col-form-label text-md-right">{!! trans('messages.Password') !!}<!-- {{ __('Password') }} --></label>

									<div class="col-12">
										<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"> @error('password')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>
								</div>
								<div class="form-row mb-2">
									<div class="col-12">
										<button type="submit" class="btn btn-primary ">
										{{ __('Login') }}
									</button>
										
									</div>
									
								</div>
								<div class="form-row">
									<div class="col-lg-6 col-md-12 col-sm-12">
										<div class="form-check">
											<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old( 'remember') ? 'checked' : '' }}>
											<label class="form-check-label" for="remember">
											{!! trans('messages.Remember Me') !!}
											<!-- {{ __('Remember Me') }} -->
										</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-12 col-sm-12">
										@if (Route::has('password.request'))
											<a class="btn btn-link" href="{{ route('password.request') }}">
												{{ __('Forgot Your Password?') }}
											</a>
										@endif
									</div>
								</div>
						</form>
						
				</div>
	</div>
</main>
	
	
@endsection