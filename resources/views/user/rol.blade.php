@extends( "layouts.plantilla" )
@section('cuerpo')
<div class="container">

  @include('user.messages')

  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-sm-3 mb-2">
          <div class="nav flex-md-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            @can('edit permissions')
            <a class="nav-link  p-2" data-toggle="pill" href="#permission" role="tab" aria-controls="permission" aria-selected="true">Permisos</a>
            @endcan
            @can('edit rol')
            <a class="nav-link  p-2" data-toggle="pill" href="#rol" role="tab" aria-controls="rol" aria-selected="false">Rol</a>
            @endcan
          </div>
        </div><!-- /.col -->
        <div class="col-sm-9">
          <div class="tab-content" id="v-pills-tabContent">
            <div id="permission" class="tab-pane fade" role="tabpanel" aria-labelledby="v-pills-profile-tab">
              <h2>Cambiar Permisos a Rol</h2>
              <hr>
              <form action="{{ route('changepermissions') }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label text-sm-right">Seleccione Rol</label>
                  <div class="col-sm-9">
                    <select class="selectpicker form-control" data-live-search="true" id="Roles" name="Roles" required="">
                      @foreach($all_roles_in_database as $rol)
                      <option>{{$rol->name}}</option>
                      @endforeach
                    </select>
                    @error('Roles') <div class="invalid-feedback">{{ $message }}</div> @enderror
                  </div><!-- /.col -->
                </div><!-- /.form-group row -->

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label text-sm-right">Permisos actuales</label>
                  <div id="response" class="col-sm-9">
                  </div><!-- /.col -->
                </div><!-- /.form-group row -->

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label text-sm-right">Asignar Permisos</label>
                  <div class="col-sm-9">
                    <select class="selectpicker form-control" data-live-search="true" size="15" id="permissions" name="permissions" required="" multiple>
                      @foreach($all_permissions_in_database as $permission)
                      <option>{{$permission->name}}</option>
                      @endforeach
                    </select>
                    @error('permissions') <div class="invalid-feedback">{{ $message }}</div> @enderror
                  </div><!-- /.col -->
                </div><!-- /.form-group row -->
                <hr>
                <div class="form-group row">
                  <div class="col-sm-4 mx-auto">
                    <button type="submit" class="btn btn-outline-primary btn-block">Cambiar</button>
                  </div><!-- /.col -->
                </div><!-- /.form-group -->
              </form>
            </div><!-- /#pass-tab -->

            <div id="rol" class="tab-pane fade" role="tabpanel" aria-labelledby="v-pills-profile-tab">
              <h2>Cambiar Rol a Usuario</h2>
              <hr>
              <form action="{{ route('changerol') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label text-sm-right">Usuario</label>
                  <div class="col-sm-9">
                    <select class="selectpicker form-control" data-live-search="true" id="user" name="user" required="">
                      @foreach($users as $user)
                      <option value="{{$user->id}}">{{$user->name}}</option>
                      @endforeach
                    </select>
                    @error('user') <div class="invalid-feedback">{{ $message }}</div> @enderror
                  </div><!-- /.col -->
                </div><!-- /.form-group row -->
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label text-sm-right">Rol Actual</label>
                  <div id='response2' class="col-sm-9">

                  </div><!-- /.col -->
                </div><!-- /.form-group row -->
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label text-sm-right">Roles</label>
                  <div class="col-sm-9">
                    <select class="selectpicker form-control" data-live-search="true" id="Roles" name="Roles" required="" multiple>
                      @foreach($all_roles_in_database as $rol)
                      <option>{{$rol->name}}</option>
                      @endforeach
                    </select>
                    @error('Roles') <div class="invalid-feedback">{{ $message }}</div> @enderror
                  </div><!-- /.col -->
                </div><!-- /.form-group row -->

                <hr>
                <div class="form-group row">
                  <div class="col-sm-4 mx-auto">
                    <button type="submit" class="btn btn-outline-primary btn-block">Cambiar</button>
                  </div><!-- /.col -->
                </div><!-- /.form-group -->
              </form>
            </div><!-- /#pass-tab -->

          </div><!-- /.tab-content -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.card-body -->
  </div><!-- /.card -->
</div><!-- /.container -->
@push('scripts')
<script type="text/javascript">
  window.addEventListener('load', function() {
    tabs();
  });
  /**
   * Controla el funcionamiento de las tabs
   */
  function tabs() {
    // Abrir tab de la url (si hay)
    var hash = window.location.hash || false;
    if (hash) {
      $('a[href="' + hash + '"]').tab('show');
    }
    // Agregar a la url el tab abierto
    $("#v-pills-tab a").on("shown.bs.tab", function(e) {
      // Si es el primer tab, borrar el hash
      if ($(e.target).attr("href") == $("#v-pills-tab a[data-toggle='pill']").first().attr("href")) {
        history.replaceState(null, null, ' ');
      } else {
        window.location.hash = $(e.target).attr("href").substr(1);
      }
    });
    // En cada cambio de historial, abrir la tab correspondiente
    $(window).on("popstate", function() {
      var anchor = location.hash || $("#v-pills-tab a[data-toggle='pill']").first().attr("href");
      console.log(anchor);
      $("a[href='" + anchor + "']").tab("show");
    });
  } // /tabs

  $(document).ready(function() {
    $("#Roles").change(function() {
      var rol = $(this).val();
      $.get('/users/permisosxrol/' + rol, function(data) {
        //esta el la peticion get, la cual se divide en tres partes. ruta,variables y funcion
        var producto_select = ''
        for (var i = 0; i < data.length; i++)
          producto_select += '<input readonly="true" value="' + data[i].name + '">';
        $("#response").html(producto_select);
      });
    });

    $("#user").change(function() {
      var user = $(this).val();
      //console.log(user);
      $.get('/users/consultarol/' + user, function(data) {
        //esta el la peticion get, la cual se divide en tres partes. ruta,variables y funcion
        var user_select = ''
        for (var i = 0; i < data.length; i++) {
          user_select = user_select + data[i];
        }

        $("#response2").html(user_select);
      });
    });


  });
</script>
@endpush('scripts')
@endsection