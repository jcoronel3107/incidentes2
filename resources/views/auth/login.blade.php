@extends( 'layouts.plantilla' )

@section( 'cuerpo' )

<main role="main" class="flex-shrink-0 scale-in-tr ">
	<div class="container ">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div><br/><br/><br/>
				</div>
				<div class="card">
					<div class="card-header">{!! trans('messages.login') !!}<!-- {{ __('Login') }} --></div>

					<div class="card-body">
						<form method="POST" action="{{ route('login') }}">
							@csrf

							<div class="form-group row">
								<label for="email" class="col-md-4 col-form-label text-md-right">{!! trans('messages.E-Mail Address') !!}<!-- {{ __('E-Mail Address') }} --></label>

								<div class="col-md-6">
									<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus> @error('email')
									<span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
									@enderror
								</div>
							</div>


							


							<div class="form-group row">
								<label for="password" class="col-md-4 col-form-label text-md-right">{!! trans('messages.Password') !!}<!-- {{ __('Password') }} --></label>

								<div class="col-md-6">
									<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"> @error('password')
									<span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
									@enderror
								</div>
							</div>

							<div class="form-group row">
								<div class="col-md-6 offset-md-4">
									<div class="form-check">
										<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old( 'remember') ? 'checked' : '' }}>

										<label class="form-check-label" for="remember">
                                        {!! trans('messages.Remember Me') !!}
                                        <!-- {{ __('Remember Me') }} -->
                                    </label>
									
									</div>
								</div>
							</div>

							<div class="form-group row mb-0">
								<div class="col-md-6 offset-md-4">
									<button type="submit" class="btn btn-primary vibrate-1">
                                    {{ __('Login') }}
                                </button>
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
			</div>
		</div>
	</div>
</main>
@endsection