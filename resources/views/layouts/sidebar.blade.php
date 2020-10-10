<!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-car"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Incidentes<sup>2</sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Eventos
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-shower"></i>
          <span>Inundacion</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Opciones:</h6>
            <a class="collapse-item" href="/inundacion">Index</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDerrame" aria-expanded="true" aria-controls="collapseDerrame">
          <i class="fa fa-flask"></i>
          <span>Hazmat</span>
        </a>
        <div id="collapseDerrame" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Opciones:</h6>
            <a class="collapse-item" href="/derrame">Index</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRescate" aria-expanded="true" aria-controls="collapseRescate">
          <i class="fas fa-fw fa-life-ring"></i>
          <span>Rescate</span>
        </a>
        <div id="collapseRescate" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Opciones</h6>
            <a class="collapse-item" href="/rescate">Index</a>
          </div>
        </div>
      </li>
      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTransito" aria-expanded="true" aria-controls="collapseTransito">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Transito</span>
        </a>
        <div id="collapseTransito" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Opciones</h6>
            <a class="collapse-item" href="/transito">Index</a>
          </div>
        </div>
      </li>
      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSalud" aria-expanded="true" aria-controls="collapseSalud">
          <i class="fas fa-fw fa-heartbeat"></i>
          <span>Salud</span>
        </a>
        <div id="collapseSalud" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Opciones</h6>
            <a class="collapse-item" href="/salud">Index</a>
          </div>
        </div>
      </li>
      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFuego" aria-expanded="true" aria-controls="collapseFuego">
          <i class="fas fa-fw fa-fire"></i>
          <span>Fuego</span>
        </a>
        <div id="collapseFuego" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Opciones</h6>
            <a class="collapse-item" href="/fuego">Index</a>
          </div>
        </div>
      </li>
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFGas" aria-expanded="true" aria-controls="collapseFGas">
          <i class="fas fa-fw fa-fire-extinguisher"></i>
          <span>F_Gas</span>
        </a>
        <div id="collapseFGas" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Opciones</h6>
            <a class="collapse-item" href="/fuga">Index</a>
          </div>
        </div>
      </li>
      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseClave14" aria-expanded="true" aria-controls="collapseClave14">
          <i class="fas fa-fw fa-wallet"></i>
          <span>Clave14</span>
        </a>
        <div id="collapseClave14" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Opciones</h6>
            <a class="collapse-item" href="/clave">Index</a>
          </div>
        </div>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider">
      <!-- Heading -->
      <div class="sidebar-heading">
        Addons
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      @can('view estadisticas')
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEstadistica" aria-expanded="true" aria-controls="collapseEstadistica">
          <i class="fas fa-fw fa-filter"></i>
          <span>Estadisticas</span>
        </a>
        <div id="collapseEstadistica" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Opciones</h6>
            <a class="collapse-item" href="/consulta">Index</a>
          </div>
        </div>
      </li>
      @endcan
      <!-- Nav Item - Pages Collapse Menu -->
      @can('view parametrizacion')
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseParametros" aria-expanded="true" aria-controls="collapseParametros">
          <i class="fas fa-fw fa-cogs"></i>
          <span>Parametrización</span>
        </a>
        <div id="collapseParametros" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Opciones</h6>
            <a class="collapse-item" href="/incidente/">Incidente</a>
            <a class="collapse-item" href="/estacion">Estación Bomberos</a>
            <a class="collapse-item" href="/gasolinera">Estación Servicio</a>
            <a class="collapse-item" href="/parroquia">Parroquias</a>
            <a class="collapse-item" href="/vehiculo">Vehiculos</a>
            <a class="collapse-item" href="/cie10/importar">Cie10</a>
          </div>
        </div>
      </li>
      @endcan
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">
      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->