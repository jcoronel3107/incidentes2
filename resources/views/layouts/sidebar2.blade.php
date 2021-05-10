<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-secondary  sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-car"></i>
    </div>
    <div class="sidebar-brand-text mx-3">{!! trans('messages.name_app') !!}<sup>2</sup></div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-1">

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    {!! trans('messages.Station') !!}
  </div>
  <hr class="sidebar-divider">
  @can('create evento')
  <!-- Nav Item - Pages Collapse Menu E1-->
  <li class="nav-item">
    <a rel="nofollow noopener noreferrer" class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" target="_blank" aria-controls="collapseTwo">
      <i class="fa fa-star-half" aria-hidden="true"></i>
      <span>{!! trans('messages.Station1') !!}</span>
    </a>
    <div id="collapse1" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">{!! trans('messages.Choices') !!}:</h6>
        <a rel="nofollow noopener noreferrer" class="collapse-item" target="_blank" href="/eventoE1/">{!! trans('messages.Incident') !!}</a>

      </div>
    </div>
  </li>

  <!-- Nav Item - Pages Collapse Menu E2-->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
      <i class="fa fa-star-half" aria-hidden="true"></i>
      <span>{!! trans('messages.Station2') !!}</span>
    </a>
    <div id="collapse2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">{!! trans('messages.Choices') !!}:</h6>
        <a rel="nofollow noopener noreferrer" class="collapse-item" target="_blank" href="/eventoE2/">{!! trans('messages.Incident') !!}</a>
      </div>
    </div>
  </li>

  <!-- Nav Item - Utilities Collapse Menu E3 -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapseRescate">
      <i class="fa fa-star-half" aria-hidden="true"></i>
      <span>{!! trans('messages.Station3') !!}</span>
    </a>
    <div id="collapse3" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">{!! trans('messages.Choices') !!}</h6>
        <a rel="nofollow noopener noreferrer" class="collapse-item" target="_blank" href="/eventoE3/">{!! trans('messages.Incident') !!}</a>

      </div>
    </div>
  </li>
  <!-- Nav Item - Utilities Collapse Menu E4 -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapseTransito">
      <i class="fa fa-star-half" aria-hidden="true"></i>
      <span>{!! trans('messages.Station4') !!}</span>
    </a>
    <div id="collapse4" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">{!! trans('messages.Choices') !!}</h6>
        <a rel="nofollow noopener noreferrer" class="collapse-item" target="_blank" href="/eventoE4">{!! trans('messages.Incident') !!}</a>

      </div>
    </div>
  </li>
  <!-- Nav Item - Utilities Collapse Menu E5-->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse5" aria-expanded="true" aria-controls="collapseSalud">
      <i class="fa fa-star-half" aria-hidden="true"></i>
      <span>{!! trans('messages.Station5') !!}</span>
    </a>
    <div id="collapse5" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">{!! trans('messages.Choices') !!}</h6>
        <a rel="nofollow noopener noreferrer" class="collapse-item" target="_blank" href="/eventoE5/">{!! trans('messages.Incident') !!}</a>

      </div>
    </div>
  </li>
  <!-- Nav Item - Utilities Collapse Menu E6-->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFuego" aria-expanded="true" aria-controls="collapseFuego">
      <i class="fa fa-star-half" aria-hidden="true"></i>
      <span>{!! trans('messages.Station6') !!}</span>
    </a>
    <div id="collapseFuego" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">{!! trans('messages.Choices') !!}</h6>
        <a rel="nofollow noopener noreferrer" class="collapse-item" target="_blank" href="/eventoE6/">{!! trans('messages.Incident') !!}</a>

      </div>
    </div>
  </li>
  <!-- Nav Item - Pages Collapse Menu E7-->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse7" aria-expanded="true" aria-controls="collapse7">
      <i class="fa fa-star-half" aria-hidden="true"></i>
      <span>{!! trans('messages.Station7') !!}</span>
    </a>
    <div id="collapse7" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">{!! trans('messages.Choices') !!}</h6>
        <a rel="nofollow noopener noreferrer" class="collapse-item" target="_blank" href="/eventoE7/">{!! trans('messages.Incident') !!}</a>

      </div>
    </div>
  </li>
  <!-- Nav Item - Pages Collapse Menu E8-->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse8" aria-expanded="true" aria-controls="collapse8">
      <i class="fa fa-star-half" aria-hidden="true"></i>
      <span>{!! trans('messages.Station8') !!}</span>
    </a>
    <div id="collapse8" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">{!! trans('messages.Choices') !!}</h6>
        <a rel="nofollow noopener noreferrer" class="collapse-item" target="_blank" href="/eventoE8/">{!! trans('messages.Incident') !!}</a>

      </div>
    </div>
  </li>
  <!-- Nav Item - Pages Collapse Menu E9-->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse9" aria-expanded="true" aria-controls="collapse9">
      <i class="fa fa-star-half" aria-hidden="true"></i>
      <span>{!! trans('messages.Station9') !!}</span>
    </a>
    <div id="collapse9" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">{!! trans('messages.Choices') !!}</h6>
        <a rel="nofollow noopener noreferrer" class="collapse-item" target="_blank" href="/eventoE9/">{!! trans('messages.Incident') !!}</a>

      </div>
    </div>
  </li>
  
   <!-- Heading -->
   <div class="sidebar-heading">
    {!! trans('messages.another') !!}
  </div>
  <!-- Divider -->
  <hr class="sidebar-divider">
  <!-- Nav Item - Utilities Collapse Menu C14-->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseClave14" aria-expanded="true" aria-controls="collapseClave14">
      <i class="fas fa-fw fa-wallet"></i>
      <span>{!! trans('messages.Clave14')!!}</span>
    </a>
    <div id="collapseClave14" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">{!! trans('messages.Choices') !!}</h6>
        <a rel="nofollow noopener noreferrer" class="collapse-item" target="_blank" href="/clave">{!! trans('messages.Index') !!}</a>
      </div>
    </div>
  </li>
  @endcan
  <!-- Nav Item - Utilities Collapse Menu Servicio-->
  
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseServicios" aria-expanded="true" aria-controls="collapseServicios">
      <i class="fas fa-clipboard-check"></i>
      <span>{!! trans('messages.Services')!!}</span>
    </a>
    <div id="collapseServicios" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">{!! trans('messages.Choices') !!}</h6>
        <a rel="nofollow noopener noreferrer" class="collapse-item" target="_blank" href="/servicio">{!! trans('messages.Index') !!}</a>
      </div>
    </div>
  </li>
  
   <!-- Heading -->
   <div class="sidebar-heading">
    {!! trans('messages.Prevention Unit') !!}
  </div>
  <!-- Divider -->
  <hr class="sidebar-divider">
  
  <!-- Nav Item - Utilities Collapse Menu Prevencion-->
  @can('view movements')
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePrevencion" aria-expanded="true" aria-controls="collapsePrevencion">
      <i class="fas fa-clipboard-check"></i>
      <span>{!! trans('messages.Mobilization')!!}</span>
    </a>
    <div id="collapsePrevencion" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">{!! trans('messages.Choices') !!}</h6>
        <a rel="nofollow noopener noreferrer" class="collapse-item" href="/prevencion">{!! trans('messages.Index') !!}</a>
        <a class="collapse-item" href="/consultaentrefechasmov">{!! trans('messages.Search between dates') !!}</a>
      </div>
    </div>
    
  </li>
  @endcan
  
  <!-- Heading -->
  <div class="sidebar-heading">
    Addons
  </div>
  <!-- Divider -->
  <hr class="sidebar-divider">
  <!-- Nav Item - Pages Collapse Menu estadisticas-->
  @can('view estadisticas')
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEstadistica" aria-expanded="true" aria-controls="collapseEstadistica">
      <i class="fas fa-fw fa-filter"></i>
      <span>{!! trans('messages.statistics') !!}</span>
    </a>
    <div id="collapseEstadistica" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">{!! trans('messages.Choices') !!}</h6>
        <a class="collapse-item" href="/consulta">{!! trans('messages.Index') !!}</a>
        <a class="collapse-item" href="/consultaentrefechas">{!! trans('messages.Search between dates') !!}</a>
      </div>
    </div>

  </li>
  @endcan
  
  <!-- Nav Item - Pages Collapse Menu parametrizacion-->
  @can('view parametrizacion')
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseParametros" aria-expanded="true" aria-controls="collapseParametros">
      <i class="fas fa-fw fa-cogs"></i>
      <span>{!! trans('messages.Parameterization')!!}</span>
    </a>
    <div id="collapseParametros" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">{!! trans('messages.Choices') !!}</h6>
        <a class="collapse-item" href="/incidente/"> {!! trans('messages.Incidents') !!}</a>
        <a class="collapse-item" href="/estacion">{!! trans('messages.Firefighter station') !!}</a>
        <a class="collapse-item" href="/gasolinera">{!! trans('messages.Service Station') !!}</a>
        <a class="collapse-item" href="/parroquia">{!! trans('messages.Parishes') !!}</a>
        <a class="collapse-item" href="/vehiculo">{!! trans('messages.Vehicles') !!}</a>
        <a class="collapse-item" href="/cie10/importar">Cie10</a>
      </div>
    </div>
  </li>
  @endcan
  
  <!-- Nav Item - Pages Collapse Menu Users -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers" aria-expanded="true" aria-controls="collapseUsers">
      <i class="fas fa-users-cog"></i>
      <span>{!! trans('messages.Users')!!}</span>
    </a>
    <div id="collapseUsers" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">{!! trans('messages.Choices') !!}</h6>
        <a class="collapse-item" href="/user">{!! trans('messages.Index') !!}</a>
        @can('edit permissions')
        <a class="collapse-item" href="/users/roles"> {!! trans('messages.Permissions') !!}</a>
        @endcan
      </div>
    </div>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">
  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar -->