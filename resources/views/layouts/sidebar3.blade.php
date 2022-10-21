<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
    
      <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-user-tie"></i>
      </div>
      <div class="sidebar-brand-text mx-3">U.A.T.H</div>
    </a>
  
    <hr class="sidebar-divider d-none d-md-block"><!-- Divider -->
    <div class="sidebar-heading"><!--  Heading -->
      Talento Humano
    </div>
    <hr class="sidebar-divider d-none d-md-block"><!-- Divider -->
    <li class="nav-item"><!-- Nav Item - Utilities Collapse Menu Portal empleado-->
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUath2" aria-expanded="true" aria-controls="collapseUath">
        <i class="fas fa-clipboard-check"></i>
        <span>Indice</span>
      </a>
      <div id="collapseUath2" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">{!! trans('messages.Choices') !!}</h6>
          @if(Auth::user())
          <a title="Estado Talento Humano" rel="nofollow noopener noreferrer" class="collapse-item" href="/users/status">Estado</a>    
          @endif
        </div>
      </div>
    </li>
    <li class="nav-item"><!-- Nav Item - Utilities Collapse Menu Portal empleado-->
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUath" aria-expanded="true" aria-controls="collapseUath">
        <i class="fas fa-clipboard-check"></i>
        <span>Asistencia</span>
      </a>
      <div id="collapseUath" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">{!! trans('messages.Choices') !!}</h6>
          
          <a title="Info Empleado" target="_blank" rel="nofollow noopener noreferrer" class="collapse-item" href="http://biotime8.bomberos.gob.ec:8787">Biotime8</a>  
          
        </div>
      </div>
    </li>
    <li class="nav-item"><!-- Nav Item - Utilities Collapse Menu Portal empleado-->
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUath1" aria-expanded="true" aria-controls="collapseUath">
        <i class="fas fa-clipboard-check"></i>
        <span>Portal Empleado</span>
      </a>
      <div id="collapseUath1" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">{!! trans('messages.Choices') !!}</h6>
          @if(Auth::user())
          <a title="Info Empleado" rel="nofollow noopener noreferrer" class="collapse-item" href="/users/profile/{{Auth::user()->email}}">Perfil</a>  
          @endif
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