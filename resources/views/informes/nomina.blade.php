<!-- Vista de Legajos Activos -->

@extends('layouts.app')

@section('content')

<form method="post" action="{{ url('/infvehiculo/print') }}" enctype="multipart/form-data" id="formMain" name="formMain">

{{ csrf_field() }}

<div class="content-heading" style="height: 67px;max-height: 90px">
   <div class="col-md-7">Informes de Vehículos
      <small></small>
   </div>

   <div class="col-md-4" style="text-align: right;">
      <button class="btn btn-labeled btn-info" onclick="pdfexport(this)">
          <span class="btn-label"><i class="fa fa-print"></i>
          </span>Imprimir
        </button>

        <button class="btn btn-labeled btn-success" style="color: text-white" onclick="excel(this)">
            <span class="btn-label"><i class="fa fa-file-excel-o"></i>
            </span>Excel
        </button>
    </div>
</div>

<div class="col-md-12">

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card mb-3 border-danger">
       <div class="card-header text-white bg-danger">Seleccione los parámetros</div>
       <div class="row">
          <div class="card-body">
              <div class="col-xl-12">
                  <div class="form-row">
                    <div class="col-lg-4 mb-3">
                       <label class="col-form-label">Desde Vehículo</label>
                       <select class="form-control" id="vehiculo" name="vehiculo">
                         @foreach ($legajos as $legajo)
                             <option value = "{{ old('vehiculo',$legajo->codigo) }}">
                               {{ $legajo->codigo  }} - {{ $legajo->detalle }} {{ $legajo->nombres }}
                             </option>
                         @endforeach
                       </select>

                       <select class="form-control" id="vehiculob" name="vehiculob" style="display: none;">
                         @foreach ($legajosb as $legajob)
                             <option value = "{{ old('vehiculo',$legajo->codigo) }}">
                               {{ $legajob->codigo  }} - {{ $legajob->detalle }} {{ $legajob->nombres }}
                             </option>
                         @endforeach
                       </select>
                     </div>

                     <div class="col-lg-4 mb-3">
                        <label class="col-form-label" id="lblvehiculo2">Hasta Vehículo</label>
                        <select class="form-control" id="vehiculo2" name="vehiculo2">
                          @foreach ($legajos as $legajo)
                              <option value = "{{ old('vehiculo2',$legajo->codigo) }}" 
                                @if ($legajo->codigo == $lastRegActive2)
                                    selected
                                @endif
                                >
                                {{ $legajo->codigo  }} - {{ $legajo->detalle }} {{ $legajo->nombres }}
                              </option>
                          @endforeach
                        </select>

                        <select class="form-control" id="vehiculob2" name="vehiculob2" style="display: none;">
                          @foreach ($legajosb as $legajob)
                              <option value = "{{ old('vehiculo2',$legajob->codigo) }}"
                                @if ($legajob->codigo == $lastRegBajas2)
                                    selected
                                @endif
                                >
                                {{ $legajob->codigo  }} - {{ $legajob->detalle }} {{ $legajob->nombres }}
                              </option>
                          @endforeach
                        </select>
                      </div>
                   </div>

                  <hr>

                  <div class="col-md-12" style="padding-left: 0px;">
                    <div class="form-row">
                      <div class="form-row">
                         <label class="col-form-label"><b>Tipo de informe&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
                            <div class="col-md-6" >

                              <input id="RadioOpcion" type="number" name="RadioOpcion" value=1 hidden>

                              <label class="c-radio">
                                 <input id="inlineradio1" type="radio" name="inlineradio1" value="1" checked onclick="VActivos(this)" onselect="VActivos(this)">
                                 <span class="fa fa-circle"></span>Vehículos Activos</label>
                               <label class="c-radio">
                                  <input id="inlineradio1" type="radio" name="inlineradio1" value="2" onclick="VBajas(this)" onselect="VBajas(this)">
                                  <span class="fa fa-circle"></span>Vehículos de Baja&nbsp;&nbsp;&nbsp;&nbsp;</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </div>
                      </div>
                    </div>
                </div>

                <hr>




              </div>
          </div>


       </div>
    </div>



    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <!-- Formulario de carga de legajos -->
    <div class="row">
       <div class="col-lg-12">
             <!-- START card-->
             <div class="card card-default">
                <!-- <div class="card-header">
                   <div class="card-title">Form Login</div>
                </div> -->



               <div class="card-footer" style="text-align: right;">
                   <div class="col-md-11" style="text-align: right;">
                       <!-- @if ( auth()->user()->rol == 'Administración' or auth()->user()->rol == 'Supervisor' )
                           <a class="btn btn-oval btn-warning" href="/ausentismo/print" id="lnkimprimir" hidden>Imprimir</a> -->

                           <button class="btn btn-labeled btn-info" onclick="pdfexport(this)">
                               <span class="btn-label"><i class="fa fa-print"></i>
                               </span>Imprimir
                           </button>


                           <button class="btn btn-labeled btn-success" onclick="excel(this)">
                               <span class="btn-label"><i class="fa fa-file-excel-o"></i>
                               </span>Excel
                           </button>

                       <!-- @endif -->
                    </div>
               </div>

             </div>
             <!-- END card-->

       </div>
    </div>
</div>
</form>

@endsection


@section('scripts')
<script type="text/javascript">

    // Total x empresa
    function VActivos(e) {
        document.getElementById('vehiculo').style.display = 'block';
        document.getElementById('vehiculo2').style.display = 'block';

        document.getElementById('vehiculob').style.display = 'none';
        document.getElementById('vehiculob2').style.display = 'none';

        //$("#empresa2").val("1").trigger("change");
        //document.getElementById('lblempresa2').style.display = 'block';
        //document.getElementById('empresa2').style.display = 'block';
        //document.getElementById('lnkimprimir').href="{{ url('/infvehiculo/print') }}";
        //document.getElementById('lnkimprimir2').href="{{ url('/infvehiculo/print') }}";
        document.getElementById('formMain').action="{{ url('/infvehiculo/print') }}";
        document.getElementById('RadioOpcion').value=1;
    }

    // Detallado x empleado
    function VBajas(e) {
        document.getElementById('vehiculo').style.display = 'none';
        document.getElementById('vehiculo2').style.display = 'none';

        document.getElementById('vehiculob').style.display = 'block';
        document.getElementById('vehiculob2').style.display = 'block';
        //document.getElementById('empresa2').style.display = 'none';
        //document.getElementById('lnkimprimir').href="{{ url('/infvehiculo/print2') }}";
        //document.getElementById('lnkimprimir2').href="{{ url('/infvehiculo/print2') }}";
        document.getElementById('formMain').action="{{ url('/infvehiculo/print2') }}";
        document.getElementById('RadioOpcion').value=2;
    }

    // Detallado x parte
    function VAmbos(e) {
        document.getElementById('vehiculob2').style.display = 'none';
        //document.getElementById('empresa2').style.display = 'none';
        //document.getElementById('lnkimprimir').href="{{ url('/infvehiculo/print2') }}";
        //document.getElementById('lnkimprimir2').href="{{ url('/infvehiculo/print2') }}";
        document.getElementById('formMain').action="{{ url('/infvehiculo/print3') }}";
        document.getElementById('RadioOpcion').value=3;
    }

    // Salida del informe a PDF
    function pdfexport(e) {
        if (document.getElementById('RadioOpcion').value == 1) {
            document.getElementById('formMain').action="{{ url('/infvehiculo/print') }}";
        }
        if (document.getElementById('RadioOpcion').value == 2) {
            document.getElementById('formMain').action="{{ url('/infvehiculo/print2') }}";
        }
        if (document.getElementById('RadioOpcion').value == 3) {
            document.getElementById('formMain').action="{{ url('/infvehiculo/print3') }}";
        }
    }

    // Salida del informe a Excel
    function excel(e) {
        //document.getElementById('lblempresa2').style.display = 'none';
        //document.getElementById('empresa2').style.display = 'none';
        //document.getElementById('lnkimprimir').href="{{ url('/ausentismo/print2') }}";
        //document.getElementById('lnkimprimir2').href="{{ url('/ausentismo/print2') }}";
        //alert(document.getElementById('formMain').action);
        if (document.getElementById('RadioOpcion').value == 1) {
            document.getElementById('formMain').action="{{ url('/infvehiculo/excel') }}";
        }
        if (document.getElementById('RadioOpcion').value == 2) {
            document.getElementById('formMain').action="{{ url('/infvehiculo/excel2') }}";
        }
        if (document.getElementById('RadioOpcion').value == 3) {
            document.getElementById('formMain').action="{{ url('/infvehiculo/excel3') }}";  // Total x empresa
        }
    }

 </script>
 @endsection
