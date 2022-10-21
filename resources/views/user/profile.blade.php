@extends( "layouts.plantilla" )
@section('cuerpo')
@if (session('status'))
  <div class="alert alert-success" role="alert">
    {{ session('status') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  </div>
  @endif
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card" >
          <div class="card-body">
            <div class="row justify-content-start">
                <ul class="nav nav-tabs" id="v-pills-tab" >
                  <li class="nav-item"><a class="nav-link  p-2 active"  href="#datos">Perfil</a></li>
                  <li class="nav-item"><a class="nav-link  p-2"  href="#roles" >Rol Pago</a></li>
                  <li class="nav-item"><a class="nav-link  p-2"  href="#cert" >Certificados</a></li>
                  <li class="nav-item"><a class="nav-link  p-2"  href="#evaluacion" >Evaluación Desempeño</a></li>
                  <li class="nav-item"><a class="nav-link  p-2"  href="#anticipo">Anticipo de Remuneraciones</a></li>
                </ul>
            </div>
          </div>
        </div>
  </div>
</div>
<div class="row mt-2">
  <div class="col-lg-12 col-m6-12 col-sm-12">
    <div class="card" >
      <div class="card-body">
        <div class="tab-content" id="v-pills-tabContent">
          <div id="datos" class="tab-pane fade show active" role="tabpanel">
            <h2>Visualización Usuario</h2>
            <hr>
            <div class="row justify-content-center">
              <div class="card col-4 mt-2 ml-2">
               
                  <div class="card border-left-info shadow">
                   
                    <div class="card-body text-center">
                      
                        <img id="img_prev" src="http://biotime8.bomberos.gob.ec:8787/files/photo/{{$Listpersonnel_employee->emp_code}}.jpg" style="width:35mm; height:49mm; box-shadow: 2px 2px 5px #000;">
             
                    </div>
                    <div class="card-footer blockquote-footer">
                      {{Auth::user()->name}}
                    </div>
                   
                  </div>
                  <div class="card mt-2">
                    <div class="card-header bg-info.bg-gradient text-black">
                      Sobre Mi
                    </div>
                    <div class="card-body mt-2">
                      <div class="form-group row">
                        <label class="text-sm-right"><b>Passport</b></label>
                        <div class="col-sm-9">
                          <label class="col-form-label text-sm-right">{{ old('Passport', $Listpersonnel_employee->passport) }}</label>
                        </div><!-- /.col -->
                      </div><!-- /.form-group row -->
                      <div class="form-group row">
                        <label class="text-sm-right"><b>Direccion</b></label>
                        <div class="col-sm-9">
                          <label class="col-form-label text-sm-right">{{ old('Direccion', $Listpersonnel_employee->address) }}</label>
                
                        </div><!-- /.col -->
                        
                      </div><!-- /.form-group row -->
                      <div class="form-group row">
                        <label class="text-sm-right"><b>Mobile</b></label>
                        <div class="col-sm-9">
                          <label class="col-form-label text-sm-right">{{ old('Mobile', $Listpersonnel_employee->mobile) }}</label>
                        </div><!-- /.col -->       
                      </div><!-- /.form-group row -->
                      <div class="form-group row">
                        <label class="text-sm-right"><b>Birthday</b> </label>
                        <div class="col-sm-9">
                          <label class="col-form-label text-sm-right">{{ old('Birthday', $Listpersonnel_employee->birthday) }}</label>
                          
                        </div><!-- /.col -->
                        
                      </div><!-- /.form-group row -->
                      <div class="form-group row">
                        <label class="text-sm-right"><b>Genero</b></label>
                        <div class="col-sm-9">
                          
                          <label class="col-form-label text-sm-right">{{ old('Genero', $Listpersonnel_employee->gender) }}</label>
                          
                        </div><!-- /.col -->
                      </div><!-- /.form-group row -->
                    </div>
                  </div>
              </div>
           
              <div class="card col-7 mt-2 ml-4">
               
                <div class="card border-left-secondary shadow mb-2">
                  <div class="card-header bg-info.bg-gradient text-black">Información Laboral</div>
                  <div class="card-body">
                    <div class="form-group row">
                      <label class="col-sm-4 col-form-label text-sm-right">Codigo</label>
                      <div class="col-sm-8">
                        <input type="text" readonly class="form-control" name="Codigo" maxlength="254" value="{{ old('Codigo', $Listpersonnel_employee->emp_code) }}" >
                      </div><!-- /.col -->
                    </div><!-- /.form-group row -->
                    
                    <div class="form-group row">
                      <label class="col-sm-4 col-form-label text-sm-right">Email</label>
                      <div class="col-sm-8">
                        <input type="text" readonly class="form-control" name="email" maxlength="254" value="{{ old('email', Auth::user()->email) }}">
                        
                      </div><!-- /.col -->
                      
                    </div><!-- /.form-group row -->
                    
                    
                    <div class="form-group row">
                      <label class="col-sm-4 col-form-label text-sm-right">Hire Date</label>
                      <div class="col-sm-8">
                        <input type="text" readonly class="form-control" name="hire_date" maxlength="254" value="{{ old('hire_date', $Listpersonnel_employee->hire_date) }}">
                      
                      </div><!-- /.col -->
                    </div><!-- /.form-group row -->
                    <div class="form-group row">
                      <label class="col-sm-4 col-form-label text-sm-right">Departamento</label>
                      <div class="col-sm-8">
                        <input type="text" readonly class="form-control " name="Departamento" maxlength="254" value="{{ old('Departamento', $Listpersonnel_employee->dept_name) }}">
                        
                      </div><!-- /.col -->
                    </div><!-- /.form-group row -->
                    <div class="form-group row">
                      <label class="col-sm-4 col-form-label text-sm-right">Cargo</label>
                      <div class="col-sm-8">
                        <input type="text" readonly class="form-control " name="cargo" maxlength="254" value="{{ old('cargo', $Listpersonnel_employee->position_name) }}">
              
                      </div><!-- /.col -->
                    </div><!-- /.form-group row -->
                    <div class="form-group row">
                      <label class="col-sm-4 col-form-label text-sm-right">Tipo</label>
                      <div class="col-sm-8">
                        <input type="text" readonly class="form-control " name="Tipo" maxlength="254" value="{{ old('Tipo', $Listpersonnel_employee->cert_name) }}">
              
                      </div><!-- /.col -->
                    </div><!-- /.form-group row -->
                    <div class="form-group row">
                      <label class="col-sm-4 col-form-label text-sm-right">Last_login</label>
                      <div class="col-sm-8">
                        <input type="text" readonly class="form-control " name="last_login" maxlength="254" value="{{ old('last_login', $Listpersonnel_employee->last_login) }}">
                    
                      </div><!-- /.col -->
                    </div><!-- /.form-group row -->
                  </div>
                    
                </div>
                  
    
              </div>  <!-- Info Usuario-->
            </div>
          </div><!-- /#datos-tab -->

          <div id="roles" class="tab-pane fade" role="tabpanel">
            <h2>Roles de Pago</h2>
            <hr>
            
            <form action="/users/rol" method="get">
          
              <div class="form-group row">
                <label class="col-sm-3 col-form-label text-sm-right">Seleccion Fecha</label>
                <div class="col-md-6 text-center mb-2">
                <input class="date-picker form-control" type="text" id="mesrol" name="mesrol" >
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

          <div id="cert" class="tab-pane fade" role="tabpanel">
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

          <div id="evaluacion" class="tab-pane fade" role="tabpanel">
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

          <div id="anticipo" class="tab-pane fade" role="tabpanel">
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
      </div>
    </div>
  </div>
</div><!-- /.container -->
@push('scripts')
  <script type="text/javascript">

    window.addEventListener('load', function() {
      tabs();
      $("#anio").datepicker({
      format: " yyyy",
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

@endpush('scripts')
@endsection