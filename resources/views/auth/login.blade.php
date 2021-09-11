@extends( 'layouts.plantilla' )
<link rel="stylesheet" media="screen" href="css/style.css">
@section( 'cuerpo' )

<main  role="main" class="flex-shrink-0 scale-in-tr ">
	<div class="container ">
		<div class="row justify-content-center">
			
			<div id="particles-js" class="card col-xl-9 col-lg-9 col-md-9">
					<div class="card-header">{!! trans('messages.login') !!}<!-- {{ __('Login') }} --></div>
					<div class="card-body">
						<form method="POST" action="{{ route('login') }}">
							@csrf
							<div class="form-group row">
								<label for="email" class="col-md-4 col-form-label text-md-right">{!! trans('messages.E-Mail Address') !!}<!-- {{ __('E-Mail Address') }} --></label>

								<div class="col-xl-6 col-lg-6 col-md-6">
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
									<button type="submit" class="btn btn-primary vibrate-1 d-grid">
                                    {{ __('Login') }}
                                </button>
									
								</div>
								<div class="col-md-6 offset-md-4">
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
</main>
	<!-- count particles -->
	<div hidden class="count-particles">
		<span class="js-count-particles">--</span> 
	</div>
	@push('scripts')
	<!-- scripts -->
	<script src="js/particles.js"></script>
	<script src="js/appdot.js"></script>

	<!-- stats.js -->
	<script src="js/lib/stats.js"></script>
	<script>
		var count_particles, stats, update;
		stats = new Stats;
		stats.setMode(0);
		stats.domElement.style.position = 'absolute';
		stats.domElement.style.left = '0px';
		stats.domElement.style.top = '0px';
		document.body.appendChild(stats.domElement);
		count_particles = document.querySelector('.js-count-particles');
		update = function() {
			stats.begin();
			stats.end();
			if (window.pJSDom[0].pJS.particles && window.pJSDom[0].pJS.particles.array) {
			count_particles.innerText = window.pJSDom[0].pJS.particles.array.length;
			}
			requestAnimationFrame(update);
		};
		requestAnimationFrame(update);
	</script>
	@endpush
@endsection