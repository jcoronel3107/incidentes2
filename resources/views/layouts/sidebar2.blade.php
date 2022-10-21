<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
    
      <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-ambulance"></i>
      </div>
      <div class="sidebar-brand-text mx-3">{!! trans('messages.name_app') !!}<sup>2</sup></div>
    </a>
  
    <hr class="sidebar-divider d-none d-md-block"><!--   Divider -->
    <div class="sidebar-heading"><!--  Heading Menu incident's -->
          {!! trans('messages.operations') !!}
    </div>
    <hr class="sidebar-divider d-none d-md-block"><!--   Divider -->
    <li class="nav-item"><!--          Nav Item - Utilities Collapse Menu Operaciones-->  
        
        <li class="nav-item"><!--     Nav Item - Pages Collapse Menu Incidentes-->
          <a rel="nofollow noopener noreferrer" class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" target="_blank" aria-controls="collapseTwo">
            <i class="fa fa-star-half" aria-hidden="true"></i>
            <span>{!! trans('messages.Incidents') !!}</span>
          </a>
          <div id="collapse1" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">{!! trans('messages.Choices') !!}:</h6>
              <a rel="nofollow noopener noreferrer" class="collapse-item" target="_blank" href="/eventoE1/">{!! trans('messages.Station1') !!}</a>
              <a rel="nofollow noopener noreferrer" class="collapse-item" target="_blank" href="/eventoE2/">{!! trans('messages.Station2') !!}</a>
              <a rel="nofollow noopener noreferrer" class="collapse-item" target="_blank" href="/eventoE3/">{!! trans('messages.Station3') !!}</a>
              <a rel="nofollow noopener noreferrer" class="collapse-item" target="_blank" href="/eventoE4">{!! trans('messages.Station4') !!}</a>
              <a rel="nofollow noopener noreferrer" class="collapse-item" target="_blank" href="/eventoE5">{!! trans('messages.Station5') !!}</a>
              <a rel="nofollow noopener noreferrer" class="collapse-item" target="_blank" href="/eventoE6">{!! trans('messages.Station6') !!}</a>
              <a rel="nofollow noopener noreferrer" class="collapse-item" target="_blank" href="/eventoE7">{!! trans('messages.Station7') !!}</a>
              <a rel="nofollow noopener noreferrer" class="collapse-item" target="_blank" href="/eventoE8">{!! trans('messages.Station8') !!}</a>
              <a rel="nofollow noopener noreferrer" class="collapse-item" target="_blank" href="/eventoE9">{!! trans('messages.Station9') !!}</a>
            </div>
          </div>
        </li>
        
        <li class="nav-item"><!--     Nav Item - Utilities Collapse Menu C14-->
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseClave14" aria-expanded="true" aria-controls="collapseClave14">
            <i class="fas fa-fw fa-wallet"></i>
            <span>{!! trans('messages.Clave14')!!}</span>
          </a>
          <div id="collapseClave14" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">{!! trans('messages.Choices') !!}</h6>
              <a rel="nofollow noopener noreferrer" class="collapse-item" target="_blank" href="{{route('clave.index')}}">{!! trans('messages.Index') !!}</a>
            </div>
          </div>
        </li>
    
        <li class="nav-item"><!--     Nav Item - Utilities Collapse Menu Servicio-->
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
    </li> 
    <hr class="sidebar-divider d-none d-md-block"><!--   Divider -->
    <div class="sidebar-heading"><!--  Heading Menu Prevencion -->
        {!! trans('messages.Prevention Unit') !!}
    </div>
    <hr class="sidebar-divider d-none d-md-block"><!--   Divider --> 
    <li class="nav-item"><!--          Nav Item - Utilities Collapse Prevencion-->
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
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePrevencionInsp" aria-expanded="true" aria-controls="collapsePrevencionInsp">
            <i class="fab fa-searchengin"></i>
            <span>{!! trans('messages.Inspection')!!}</span>
          </a>
          <div id="collapsePrevencionInsp" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">{!! trans('messages.Choices') !!}</h6>
              
                <a rel="nofollow noopener noreferrer" class="collapse-item" href="#">{!! trans('messages.Index') !!}</a>         
            
            </div>
          </div>
    </li>
    
    
    <hr class="sidebar-divider d-none d-md-block"><!-- Divider -->
    

    <div class="sidebar-heading"><!--  Heading -->
      Addons
    </div>

    <hr class="sidebar-divider d-none d-md-block"><!--   Divider -->

    <li class="nav-item"><!--          Nav Item - Pages Collapse Menu estadisticas-->
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEstadistica" aria-expanded="true" aria-controls="collapseEstadistica">
        <i class="fas fa-fw fa-filter"></i>
        <span>{!! trans('messages.statistics') !!}</span>
      </a>
      <div id="collapseEstadistica" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">{!! trans('messages.Choices') !!}</h6>
          <a class="collapse-item" href="/consulta">{!! trans('messages.Index') !!}</a>
          <a class="collapse-item" href="/consultaentrefechas">{!! trans('messages.Search between dates') !!}</a>
          <a class="collapse-item" href="{{route('googlemymapsoptions')}}">Mapas</a>
        </div>
      </div>
    </li>

    <li class="nav-item"><!--         Nav Item - Pages Collapse Menu parametrizacion-->
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

    <li class="nav-item"><!--       Nav Item - Pages Collapse Menu Users -->
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers" aria-expanded="true" aria-controls="collapseUsers">
          <i class="fas fa-users-cog"></i>
          <span>{!! trans('messages.Users')!!}</span>
        </a>
        <div id="collapseUsers" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">{!! trans('messages.Choices') !!}</h6>
            <a class="collapse-item" href="/user">{!! trans('messages.Index') !!}</a>
            
            <a class="collapse-item" href="/users/roles"> {!! trans('messages.Permissions') !!}</a>
            
          </div>
        </div>
      </li>
    
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block"><!--   Divider -->
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0 vibrate-1" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->