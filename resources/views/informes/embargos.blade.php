<!-- Vista de Legajos Activos -->

@extends('layouts.app')

@section('content')

<form method="post" action="{{ url('/ausentismo/print') }}" enctype="multipart/form-data" id="formMain" name="formMain">

{{ csrf_field() }}

<div class="content-heading" style="height: 67px;max-height: 90px">
   <div class="col-md-7">Informes de Embargos
      <small></small>
   </div>

   <div class="col-md-4" style="text-align: right;">
      <!-- @if ( auth()->user()->rol == 'Administración' or auth()->user()->rol == 'Supervisor' )
          <a class="btn btn-oval btn-warning" href="/ausentismo/print" id="lnkimprimir" hidden>Imprimir</a>-->

            <button class="btn btn-labeled btn-info" onclick="pdfexport(this)">
              <span class="btn-label"><i class="fa fa-print"></i>
              </span>Imprimir
            </button>

            <button class="btn btn-labeled btn-success" style="color: text-white" onclick="excel(this)">
                <span class="btn-label"><i class="fa fa-file-excel-o"></i>
                </span>Excel
            </button>

      <!-- @endif -->
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
                       <label class="col-form-label">Desde Legajo</label>
                       <select class="form-control" id="empresa" name="empresa">
                         @foreach ($legajos as $legajo)
                             <option value = "{{ old('empresa',$legajo->codigo) }}">
                               {{ $legajo->codigo  }} - {{ $legajo->detalle }} {{ $legajo->nombres }}
                             </option>
                         @endforeach
                       </select>
                     </div>

                     <div class="col-lg-4 mb-3">
                        <label class="col-form-label" id="lblempresa2">Hasta Legajo</label>
                        <select class="form-control" id="empresa2" name="empresa2">
                          @foreach ($legajos as $legajo)
                              <option value = "{{ old('empresa2',$legajo->codigo) }}">
                                {{ $legajo->codigo  }} - {{ $legajo->detalle }} {{ $legajo->nombres }}
                              </option>
                          @endforeach
                        </select>
                      </div>


                    <div class="col-md-10" style="margin-right: 0px">
                         <div class="form-row">
                           <div class="col-lg-3 mb-3">
                               <label class="col-form-label">Desde fecha *</label>
                                 <div class="input-group date" id="datetimepicker1" data-provide="datepicker" data-date-format="dd/mm/yyyy"
                                 keyboardNavigation="true" title="Seleccione fecha" autoclose="true">
                                   <input class="form-control" type="text" value="{{ old('ddesde',$legajo->ddesde) }}" name="ddesde" id="ddesde"
                                     autocomplete='off'>
                                   <span class="input-group-append input-group-addon">
                                     <span class="input-group-text fa fa-calendar"></span>
                                   </span>
                               </div>
                           </div>
                           <div class="col-lg-3 mb-3">
                             <label class="col-form-label">Hasta fecha *</label>
                               <div class="input-group date" id="datetimepicker1" data-provide="datepicker"
                                   data-date-format="dd/mm/yyyy" keyboardNavigation="true" title="Seleccione fecha" autoclose="true">
                                   <input class="form-control" type="text" value="{{ old('dhasta',$legajo->dhasta) }}" name="dhasta" id="dhasta"
                                      autocomplete='off'>
                                   <span class="input-group-append input-group-addon">
                                     <span class="input-group-text fa fa-calendar"></span>
                                   </span>
                               </div>
                           </div>

                       </div>
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
                                 <input id="inlineradio1" type="radio" name="inlineradio1" value="1" checked onclick="hideEmpresa1(this)" onselect="hideEmpresa1(this)">
                                 <span class="fa fa-circle"></span>Legajos activos + Legajos de Baja</label>
                               <label class="c-radio">
                                  <input id="inlineradio1" type="radio" name="inlineradio1" value="2" onclick="hideEmpresa2(this)" onselect="hideEmpresa2(this)">
                                  <span class="fa fa-circle"></span>Solamente legajos Activos</label>
                               <label class="c-radio">
                                  <input id="inlineradio1" type="radio" name="inlineradio1" value="3" onclick="hideEmpresa3(this)" onselect="hideEmpresa2(this)">
                                  <span class="fa fa-circle"></span>Solamente legajos de Baja</label>

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
    function hideEmpresa1(e) {
        //$("#empresa2").val("1").trigger("change");
        document.getElementById('lblempresa2').style.display = 'block';
        document.getElementById('empresa2').style.display = 'block';
        //document.getElementById('lnkimprimir').href="{{ url('/ausentismo/print') }}";
        //document.getElementById('lnkimprimir2').href="{{ url('/ausentismo/print') }}";
        document.getElementById('formMain').action="{{ url('/ausentismo/print') }}";
        document.getElementById('RadioOpcion').value=1;
    }

    // Detallado x empleado
    function hideEmpresa2(e) {
        document.getElementById('lblempresa2').style.display = 'none';
        document.getElementById('empresa2').style.display = 'none';
        //document.getElementById('lnkimprimir').href="{{ url('/ausentismo/print2') }}";
        //document.getElementById('lnkimprimir2').href="{{ url('/ausentismo/print2') }}";
        document.getElementById('formMain').action="{{ url('/ausentismo/print2') }}";
        document.getElementById('RadioOpcion').value=2;
    }

    // Detallado x parte
    function hideEmpresa3(e) {
        document.getElementById('lblempresa2').style.display = 'none';
        document.getElementById('empresa2').style.display = 'none';
        //document.getElementById('lnkimprimir').href="{{ url('/ausentismo/print2') }}";
        //document.getElementById('lnkimprimir2').href="{{ url('/ausentismo/print2') }}";
        document.getElementById('formMain').action="{{ url('/ausentismo/print3') }}";
        document.getElementById('RadioOpcion').value=3;
    }

    // Salida del informe a PDF
    function pdfexport(e) {
        if (document.getElementById('RadioOpcion').value == 1) {
            document.getElementById('formMain').action="{{ url('/ausentismo/print') }}";
        }
        if (document.getElementById('RadioOpcion').value == 2) {
            document.getElementById('formMain').action="{{ url('/ausentismo/print2') }}";
        }
        if (document.getElementById('RadioOpcion').value == 3) {
            document.getElementById('formMain').action="{{ url('/ausentismo/print3') }}";
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
            document.getElementById('formMain').action="{{ url('/ausentismo/excel') }}";
        }
        if (document.getElementById('RadioOpcion').value == 2) {
            document.getElementById('formMain').action="{{ url('/ausentismo/excel2') }}";
        }
        if (document.getElementById('RadioOpcion').value == 3) {
            document.getElementById('formMain').action="{{ url('/ausentismo/excel3') }}";  // Total x empresa
        }
    }

 </script>
 @endsection