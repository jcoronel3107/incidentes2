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
            <a class="nav-link  p-2 active" data-toggle="pill" href="#datos" role="tab" aria-controls="datos" aria-selected="true">Perfil</a>
            <a class="nav-link  p-2" data-toggle="pill" href="#roles" role="tab" aria-controls="roles" aria-selected="false">Roles</a>
            <a class="nav-link  p-2" data-toggle="pill" href="#cert" role="tab" aria-controls="cert" aria-selected="false">Certificados</a>
            <a class="nav-link  p-2" data-toggle="pill" href="#evaluacion" role="tab" aria-controls="evaluacion" aria-selected="false">Evaluación Desempeño</a>
            <a class="nav-link  p-2" data-toggle="pill" href="#anticipo" role="tab" aria-controls="anticipo" aria-selected="false">Anticipo de Remuneraciones</a>
          </div>
        </div><!-- /.col -->
        <div class="col-sm-9">
          <div class="tab-content" id="v-pills-tabContent">

            <div id="datos" class="tab-pane fade show active" role="tabpanel" aria-labelledby="v-pills-home-tab">
              <h2>Información</h2>
              <hr>
              <div class="form-group row">
                <label class="col-sm-3 col-form-label text-sm-right">Foto</label>
                <div class="col-sm-9 ">
                  <img id="img_prev" src="http://biotime8.bomberos.gob.ec:8787/files/photo/{{$Listpersonnel_employee->emp_code}}.jpg" style="width:35mm; height:49mm; box-shadow: 2px 2px 5px #000;">
                
                </div><!-- /.col -->
              </div><!-- /.form-group row -->
                
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label text-sm-right">Usuario</label>
                  <div class="col-sm-9">
                    <input type="text" readonly class="form-control" name="name" maxlength="254" value="{{ old('name', Auth::user()->name) }}" >
                  
                  </div><!-- /.col -->
                </div><!-- /.form-group row -->
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label text-sm-right">Nombres</label>
                  <div class="col-sm-9">
                    <input type="text" readonly class="form-control" name="name" maxlength="254" value="{{ old('name', $Listpersonnel_employee->first_name) }}" >
                    
                  </div><!-- /.col -->

                </div><!-- /.form-group row -->
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label text-sm-right">Apellidos</label>
                  <div class="col-sm-9">
                    <input type="text" readonly class="form-control" name="last_name" maxlength="254" value="{{ old('last_name', $Listpersonnel_employee->last_name) }}" >
                    
                  </div><!-- /.col -->

                </div><!-- /.form-group row -->
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label text-sm-right">Codigo</label>
                  <div class="col-sm-9">
                    <input type="text" readonly class="form-control" name="Codigo" maxlength="254" value="{{ old('Codigo', $Listpersonnel_employee->emp_code) }}" >
                    
                  </div><!-- /.col -->

                </div><!-- /.form-group row -->
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label text-sm-right">Passport</label>
                  <div class="col-sm-9">
                    <input type="text" readonly class="form-control" name="Passport" maxlength="254" value="{{ old('Passport', $Listpersonnel_employee->passport) }}">
                    
                  </div><!-- /.col -->
                </div><!-- /.form-group row -->
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label text-sm-right">Email</label>
                  <div class="col-sm-9">
                    <input type="text" readonly class="form-control" name="email" maxlength="254" value="{{ old('email', Auth::user()->email) }}">
                    
                  </div><!-- /.col -->
                  
                </div><!-- /.form-group row -->
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label text-sm-right">Direccion</label>
                  <div class="col-sm-9">
                    <input type="text" readonly class="form-control" name="Direccion" maxlength="254" value="{{ old('Direccion', $Listpersonnel_employee->address) }}">
           
                  </div><!-- /.col -->
                  
                </div><!-- /.form-group row -->
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label text-sm-right">Mobile</label>
                  <div class="col-sm-9">
                    <input type="text" readonly class="form-control" name="Mobile" maxlength="254" value="{{ old('Mobile', $Listpersonnel_employee->mobile) }}">
                   
                  </div><!-- /.col -->
                  
                </div><!-- /.form-group row -->
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label text-sm-right">Birthday</label>
                  <div class="col-sm-9">
                    <input type="text" readonly class="form-control" name="Birthday" maxlength="254" value="{{ old('Birthday', $Listpersonnel_employee->birthday) }}">
                    
                  </div><!-- /.col -->
                  
                </div><!-- /.form-group row -->
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label text-sm-right">Genero</label>
                  <div class="col-sm-9">
                    
                    <input type="text" readonly class="form-control" name="Genero" maxlength="254" value="{{ old('Genero', $Listpersonnel_employee->gender) }}">
                    
                  </div><!-- /.col -->
                </div><!-- /.form-group row -->
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label text-sm-right">Hire Date</label>
                  <div class="col-sm-9">
                    <input type="text" readonly class="form-control" name="hire_date" maxlength="254" value="{{ old('hire_date', $Listpersonnel_employee->hire_date) }}">
                   
                  </div><!-- /.col -->
                </div><!-- /.form-group row -->
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label text-sm-right">Departamento</label>
                  <div class="col-sm-9">
                    <input type="text" readonly class="form-control " name="Departamento" maxlength="254" value="{{ old('Departamento', $Listpersonnel_employee->dept_name) }}">
                    
                  </div><!-- /.col -->
                </div><!-- /.form-group row -->
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label text-sm-right">Cargo</label>
                  <div class="col-sm-9">
                    <input type="text" readonly class="form-control " name="cargo" maxlength="254" value="{{ old('cargo', $Listpersonnel_employee->position_name) }}">
           
                  </div><!-- /.col -->
                </div><!-- /.form-group row -->
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label text-sm-right">Tipo</label>
                  <div class="col-sm-9">
                    <input type="text" readonly class="form-control " name="Tipo" maxlength="254" value="{{ old('Tipo', $Listpersonnel_employee->cert_name) }}">
           
                  </div><!-- /.col -->
                </div><!-- /.form-group row -->
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label text-sm-right">Last_login</label>
                  <div class="col-sm-9">
                    <input type="text" readonly class="form-control " name="last_login" maxlength="254" value="{{ old('last_login', $Listpersonnel_employee->last_login) }}">
                 
                  </div><!-- /.col -->
                </div><!-- /.form-group row -->

                <hr>
            </div><!-- /#datos-tab -->

            <div id="roles" class="tab-pane fade" role="tabpanel" aria-labelledby="v-pills-profile-tab">
              <h2>Roles de Pago</h2>
              <hr>
              
              <form action="/users/rol" method="get">
            
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label text-sm-right">Seleccion Fecha</label>
                  <div class="col-md-6 text-center mb-2">
                   <input class="date-picker" type="text" id="mesrol" name="mesrol" >
                  </div>
                </div><!-- /.row -->
                <hr>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label text-sm-right">Nro Identificaciòn</label>
                  <div class="col-md-6 text-center mb-2">
                   <input class="form-control " type="text" id="cedula" name="cedula" placeholder="Digite su nro Cédula">
                  </div>
                </div><!-- /.row -->
                
                <div class="form-group row">
                  <div class="col-sm-4 mx-auto">
                    <button type="submit" class="btn btn-outline-primary btn-block">Buscar</button>
                  </div><!-- /.col -->
                </div><!-- /.form-group -->
              </form>
            </div><!-- /#roles-tab -->

            <div id="cert" class="tab-pane fade" role="tabpanel" aria-labelledby="v-pills-profile-tab">
              <h2>Certificado Laboral</h2>
              <hr>
              <p>Por favor seleccione el tipo de certificado que requiere.</p>
              <form action="/downloadPDFCert" method="get">
                
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label text-sm-right">Certificado</label>
                  <div class="col-sm-9">
                    <select class="form-control" id="tipocertificado" name="tipocertificado">
                      <option value="" selected>Seleccione...</option>
                      <option value="1">Certificado de Trabajo</option>
                      <option value="2">Certificado de Salario</option>
                    </select>
                  </div><!-- /.col -->
                </div><!-- /.form-group row -->
               
                <hr>
                <div class="form-group row">
                  <div class="col-sm-4 mx-auto">
                    <button type="submit" class="btn btn-outline-primary btn-block">Generar</button>
                  </div><!-- /.col -->
                </div><!-- /.form-group -->
              </form>
            </div><!-- /#pass-tab -->

            <div id="evaluacion" class="tab-pane fade" role="tabpanel" aria-labelledby="v-pills-profile-tab">
              <h2>Evaluaciones de Desempeño</h2>
              <hr>
              
              <form action="" method="get">
            
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label text-sm-right">Seleccion Año</label>
                  <div class="col-md-6 text-center mb-2">
                   <input class="form-control" type="text" id="anio" name="anio">
                  </div>
                </div><!-- /.row -->
                <hr>
                
                <div class="form-group row">
                  <div class="col-sm-4 mx-auto">
                    <button type="submit" class="btn btn-outline-primary btn-block">Buscar</button>
                  </div><!-- /.col -->
                </div><!-- /.form-group -->
              </form>
            </div><!-- /#evaluacion-tab -->

            <div id="anticipo" class="tab-pane fade" role="tabpanel" aria-labelledby="v-pills-profile-tab">
              <h2>Anticipo de Remuneraciones</h2>
              <hr>
              <p>Por favor seleccione el tipo de certificado que requiere.</p>
              <form action="/downloadPDFAnticipo" method="get">
                
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label text-sm-right">Plazo Solicitado</label>
                  <div class="col-sm-9">
		                <input type="number" required value="{{old('plazo')}}" min="1" max="12" id="plazo" name="plazo" class="form-input">
                  </div><!-- /.col -->
                </div><!-- /.form-group row -->
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label text-sm-right">Monto Solicitado</label>
                  <div class="col-sm-9">
		                <input type="number" required value="{{old('monto')}}" id="monto" name="monto" class="form-input">
                  </div><!-- /.col -->
                </div><!-- /.form-group row -->
               
                <hr>
                <div class="form-group row">
                  <div class="col-sm-4 mx-auto">
                    <button type="submit" class="btn btn-outline-primary btn-block">Generar</button>
                  </div><!-- /.col -->
                </div><!-- /.form-group -->
              </form>
            </div><!-- /#anticipo-tab -->


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
    $("#mes").datepicker({
    format: " yyyy MM",
    viewMode: "years", 
    minViewMode: "years",
    dayHeaderFormat: "showHeaderShort",
  });

  $('.date-picker').datepicker({
            changeMonth: true,
            changeYear: true,
            showButtonPanel: false,
            dateFormat: 'mm-yy',
            onClose: function(dateText, inst) { 
                $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
            }
  });
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>


@endpush('scripts')
@endsection