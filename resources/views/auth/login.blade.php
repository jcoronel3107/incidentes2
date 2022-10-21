

<html xmlns="http://www.w3.org/1999/xhtml" xmlns:b="http://www.google.com/2005/gml/b" xmlns:data="http://www.google.com/2005/gml/data">
<head>
  <title>
	BCBVC - incidentes2
  </title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Balcon de Servicios internos del BCBVC. Fully responsive system, that is, it works on mobiles, tablets and computers">
  <meta name="Ing. Juan Coronel" content="">
  <link rel="shortcut icon" type="image/png" href="https://incidentes2.bomberos.gob.ec/images/favicon_192x192.png">
  <link rel="shortcut icon" sizes="192x192" href="https://incidentes2.bomberos.gob.ec/images/favicon_192x192.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <link href="/css/waves.css" rel="stylesheet">
  <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
</head>
<body class="bg-dark">
	
	<section>
		<div class="row m-0 vh-100 align-items-center justify-content-center" >
		
			<div class="card bg-dark  col-xl-5 col-lg-5 col-md-5 col-sm-12" >
					<div class="card-header p-2 text-white">
						{!! trans('messages.login') !!}
					</div>
					<div class="card-body " style="background-image: url('/images/logotipo-05.jp');background-size: 10rem;">
							<form method="POST" action="{{ route('login') }}">
									@csrf
									<div class="form-group	">
										<label for="email" class="col-form-label text-white text-md-right">{!! trans('messages.E-Mail Address') !!}<!-- {{ __('E-Mail Address') }} --></label>
	
										<div class="col-12">
											<div class="input-group mb-3">
												<div class="input-group-prepend">
													<span class="input-group-text" id="basic-addon1">@</span>
												</div>
												<input id="email" type="email" class="form-control  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus> @error('email')
												<span class="invalid-feedback" role="alert">
													<strong>{{ $message }}</strong>
												</span>
												@enderror
											</div>
										</div>
									</div>
									<div class="form-group mb-4">
										<label for="password" class="col-form-label text-white text-md-right">{!! trans('messages.Password') !!}<!-- {{ __('Password') }} --></label>
	
										<div class="col-12">
											<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"> @error('password')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
											@enderror
										</div>
									</div>
									<div class="row mb-2">
										<div class="col-lg-4 col-md-12 col-sm-12">
											<button type="submit" class="btn btn-primary ">
											{{ __('Login') }}
											</button>
											
										</div>
										
									
										<div class="col-lg-4 col-md-12 col-sm-12">
											<div class="form-check">
												<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old( 'remember') ? 'checked' : '' }}>
												<label class="form-check-label text-white" for="remember">
												{!! trans('messages.Remember Me') !!}
												<!-- {{ __('Remember Me') }} -->
											</label>
											</div>
										</div>
										<div class="col-lg-4 col-md-12 col-sm-12">
											@if (Route::has('password.request'))
												<a class="btn btn-link" href="{{ route('password.request') }}">
													{{ __('Forgot Your Password?') }}
												</a>
											@endif
										</div>
									
							</form>
					</div>
			</div>				
		</div>	
		<!--Waves Container-->  
		<div class="flex">  
			<svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  
			viewBox="0 20 150 28" preserveAspectRatio="none" shape-rendering="auto">  
			<defs>  
			  <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />  
			</defs>  
			<g class="parallax">  
			  <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7" />  
			  <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)" />  
			  <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)" />  
			  <use xlink:href="#gentle-wave" x="48" y="7" fill="#fff" />  
			</g>  
			</svg>  
		</div>  
		  <!--Waves end--> 
	</section>
	
		
	<footer>
		
	</footer>	
</body>
 
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

 
</html>


	
