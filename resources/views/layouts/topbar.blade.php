<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>
    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml"><!-- Div Logo -->
          <div class="d-flex justify-content-start ">
            <img style="opacity: 0.3; width: 190px; height: 40px;" src="/images/logotipo-05.jpg" alt="BCBVC">
        </div> 
    </ul>
    <ul class="navbar-nav ml-auto"><!-- Div Reloj -->
            <div id="clockdate">
                    <div class="clockdate-wrapper">
                        <div id="clock"></div>
                        <div id="date"></div>
                    </div>
                
            </div>
        
    </ul>
    <ul class="navbar-nav"><!-- Topbar NavItem Lenguaje -->
        <div class="topbar-divider d-none d-sm-block"></div>
        <!--Comprobamos si el status esta a true y existe más de un lenguaje-->
        @if (config('locale.status') && count(config('locale.languages')) > 1)
        <div class="top-right links">
            @foreach (array_keys(config('locale.languages')) as $lang)
            @if ($lang != App::getLocale())
            <a class="nav-link" href="{!! route('lang.swap', $lang) !!}" title="{!! trans('messages.language') !!}">
                <i class="fa fa-language fa-lg"></i>{{$lang}}
            </a>
            @endif
            @endforeach
        </div>
        @endif

    </ul>
    <ul class="navbar-nav">
        <div class="topbar-divider d-none d-sm-block">
        </div>
    </ul>
    <ul class="navbar-nav"><!-- Topbar NavItem Clima -->
        <a class="nav-link" data-toggle="modal" data-target="#climaModal">
            <i class="fa fa-cloud-sun"></i>
            Clima
        </a>
    </ul>
    <ul class="navbar-nav">
        <div class="topbar-divider d-none d-sm-block">
        </div>
    </ul>
    <ul class="navbar-nav"><!-- Topbar NavItem Carretera -->
        <a class="nav-link" data-toggle="modal" data-target="#carreterasModal">
            <i class="fa fa-road"></i>
            Carreteras
        </a>
    </ul>
    <ul class="navbar-nav ml-right ">
        <div class="topbar-divider d-none d-sm-block"></div>
        <!-- Authentication Links -->
        @guest
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @if (Route::has('register'))
            <!-- <li class="nav-item">
                                    <a class="nav-link dropdown-toggle" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li> -->
            @endif @else
            <li class="nav-item dropdown no-arrow">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre><span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }} </span><img src="{{ asset('storage/avatar/'.Auth::user()->avatar) }}" height="40px" style="max-width: 100%" /><span class="caret"> </span>
                </a>

                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="{{route('profile.index')}}">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Profile</a>
                    @can('view parametrizacion')
                    <a rel="nofollow noopener noreferrer" class="dropdown-item" target="_blank" href="/activitylog">
                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>Activity Log</a>
                    @endcan
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" data-toggle="modal" data-target="#logoutModal"><i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
                
            </li>
        
        @endguest

    </ul>
</nav>
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><!-- Logout Modal Logout-->
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{!! trans('messages.Ready to Leave?') !!}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">{!! trans('messages.Select "Logout" below if you are ready to end your current session.') !!}</div>
            <div class="modal-footer">
                <button class="btn btn-outline-secondary" type="button" data-dismiss="modal">Cancel</button>

                <a class="btn btn-outline-danger" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">Logout</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="climaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><!-- Clima Modal -->
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Consulte Clima</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col"><!-- Div Clima -->
        
                    <div class="card">
                        <h4 class="card-header text-white bg-secondary">
                        
                            <div id="searchbox">
                                <input type="text" id="search" placeholder="Digite Ciudad">
                                <button>Search</button>
                            </div>
                            <div id="topbar">Clima<span id="searchicon">🔍</span></div>
                        </h4>
                        <div class="card-body">
                                <div id="mainbody">
                                    <img>
                                    <span id="city"></span>
                                    <span id="temp"></span>
                                    <span id="cond"></span>
                                    <hr>
                                    <div id="more">
                                        <span id="label">Humedad: </span><span id="humidity"></span>
                                    </div>
                                    <div id="more">
                                        <span id="label">Viento: </span><span id="wind"></span>
                                    </div>
                                    <div id="more">
                                        <span id="label">Dirección Viento: </span><span id="direction"></span>
                                    </div>
                                    <div>
                                        <span id="label">Sensación Térmica: </span><span id="feel"></span>
                                    </div>								
                                    <span style="font-size: 8px;">Ultima Actualización: </span><span style="font-size: 8px;" id="update"></span>
                                </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline-secondary" type="button" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="carreterasModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><!-- carreteras Modal -->
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Consulte Estado Carreteras</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col"><!-- Div Clima -->
        
                    <div class="card lg">
                        <iframe src="{{url('https://www.ecu911.gob.ec/consulta-de-vias/')}}">Your browser isn't compatible</iframe>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline-secondary" type="button" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- End of Topbar -->