@extends( "layouts.plantilla" )
@section('cuerpo')
<div class="container">

  @if (session('status'))
  <div class="alert alert-success" role="alert">
    {{ session('status') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  </div>
  @endif

  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-sm-3 mb-2">
          <div class="nav flex-md-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link  p-2 active" data-toggle="pill" href="#datos" role="tab" aria-controls="datos" aria-selected="true">Datos</a>
            <a class="nav-link  p-2" data-toggle="pill" href="#foto" role="tab" aria-controls="foto" aria-selected="false">Foto</a>
            <a class="nav-link  p-2" data-toggle="pill" href="#pass" role="tab" aria-controls="pass" aria-selected="false">Contraseña</a>
            @can('edit permissions')
            <a class="nav-link  p-2" data-toggle="pill" href="#permission" role="tab" aria-controls="pass" aria-selected="false">Permisos</a>
            @endcan
          </div>
        </div><!-- /.col -->
        <div class="col-sm-9">
          <div class="tab-content" id="v-pills-tabContent">

            <div id="datos" class="tab-pane fade show active" role="tabpanel" aria-labelledby="v-pills-home-tab">
              <h2>Datos</h2>
              <hr>
              <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label text-sm-right">Usuario</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" maxlength="254" value="{{ old('name', Auth::user()->name) }}" required>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                  </div><!-- /.col -->
                </div><!-- /.form-group row -->
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label text-sm-right">Email</label>
                  <div class="col-sm-9">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" maxlength="254" value="{{ old('email', Auth::user()->email) }}" required>
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                  </div><!-- /.col -->
                </div><!-- /.form-group row -->

                <hr>
                <div class="form-group row">
                  <div class="col-sm-4 mx-auto">
                    <button type="submit" class="btn btn-outline-primary btn-block">Guardar</button>
                  </div><!-- /.col -->
                </div><!-- /.form-group -->
              </form>
            </div><!-- /#datos-tab -->

            <div id="foto" class="tab-pane fade" role="tabpanel" aria-labelledby="v-pills-profile-tab">
              <h2>Foto</h2>
              <hr>
              <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-2">
                  <img src="{{ asset('storage/avatar/'.Auth::user()->avatar) }}" height="50px" style="max-width: 100%" />
                </div>
              </div><!-- /.row -->
              <hr>
              <form action="{{ route('profile.avatar') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label text-sm-right">Cambiar foto</label>
                  <div class="col-sm-9">
                    <input type="file" required="" class="form-control-file @error('avatar') is-invalid @enderror" name="avatar" aria-describedby="fileHelp">
                    @error('avatar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    <small class="form-text text-muted">Adjunta un archivo válido de imagen. No debe exceder los 2MB.</small>
                  </div><!-- /.col -->
                </div><!-- /.form-group row -->
                <hr>
                <div class="form-group row">
                  <div class="col-sm-4 mx-auto">
                    <button type="submit" class="btn btn-outline-primary btn-block">Cambiar</button>
                  </div><!-- /.col -->
                </div><!-- /.form-group -->
              </form>
            </div><!-- /#foto-tab -->

            <div id="pass" class="tab-pane fade" role="tabpanel" aria-labelledby="v-pills-profile-tab">
              <h2>Cambiar contraseña</h2>
              <hr>
              <form action="{{ route('profile.pass') }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label text-sm-right">Actual</label>
                  <div class="col-sm-9">
                    <input type="password" class="form-control @error('pass1') is-invalid @enderror" name="pass1" maxlength="254" value="{{ old('pass1') }}" required>
                    @error('pass1') <div class="invalid-feedback">{{ $message }}</div> @enderror
                  </div><!-- /.col -->
                </div><!-- /.form-group row -->
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label text-sm-right">Nueva</label>
                  <div class="col-sm-9">
                    <input type="password" class="form-control @error('nuevo') is-invalid @enderror" name="nuevo" maxlength="254" value="{{ old('nuevo') }}" required>
                    @error('nuevo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                  </div><!-- /.col -->
                </div><!-- /.form-group row -->
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label text-sm-right">Repetir</label>
                  <div class="col-sm-9">
                    <input type="password" class="form-control @error('nuevo_confirmation') is-invalid @enderror" name="nuevo_confirmation" maxlength="254" value="{{ old('nuevo_confirmation') }}" required>
                    @error('nuevo_confirmation') <div class="invalid-feedback">{{ $message }}</div> @enderror
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

            <div id="permission" class="tab-pane fade" role="tabpanel" aria-labelledby="v-pills-profile-tab">
              <h2>Cambiar Permisos</h2>
              <hr>
              <form action="" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label text-sm-right">Rol Actual</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control @error('role') is-invalid @enderror" readonly="true" name="role" maxlength="254" value="{{ old('role', Auth::user()->getRoleNames()) }}">

                  </div><!-- /.col -->
                </div><!-- /.form-group row -->
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label text-sm-right">Roles</label>
                  <div class="col-sm-9">
                    <select class="selectpicker form-control" multiple data-live-search="true" id="Roles" name="Roles" required="" multiple>
                      @foreach($all_roles_in_database as $rol)
                      <option value="{{$rol->id}}">{{$rol->name}}</option>
                      @endforeach
                    </select>
                    @error('nuevo') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
</script>
@endpush('scripts')
@endsection