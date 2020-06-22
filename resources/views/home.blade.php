<?php
    # Iniciando la variable de control que permitirá mostrar o no el modal
    if (isset($_GET['exibirModal'])) {
      $exibirModal = $_REQUEST['exibirModal'];

    }

    if(!isset($exibirModal)) {
      $exibirModal = "false";
    }

    if (isset($_GET['dni']) == true) {
        $dni=$_GET['dni'];
    }

    if(!isset($dni)) {
        $dni = "";
    }

    if (isset($_GET['cod_nov2']) == true) {
        $cod_nov=$_GET['cod_nov2'];
    }

    if(!isset($cod_nov)) {
        $cod_nov = "";
    }
?>

@extends('layouts.app')

@section('styles')
    <!-- SWEET ALERT-->
    <link rel="stylesheet" href="/vendor/sweetalert/dist/sweetalert.css">
@endsection

@section('content')

@if($agregar == true)
    <form method="post" action="{{ url('/home/add') }}" enctype="multipart/form-data">
@else
    <form method="post" action="{{ url('/home/edit/'.$legajo->id) }}" enctype="multipart/form-data">
@endif

{{ csrf_field() }}

<div class="content-heading" style="height: 67px;max-height: 90px">
   <div class="col-md-3">Vehículos activos
      <small></small>
   </div>

   <div class="col-md-1">
   </div>

   <div class="col-md-3">
        <a class="btn btn-labeled btn-default" type="button" href="/home/{{ $legajo?$legajo->id:'' }}/-1">
            <span class="btn-label"><i class="fa fa-arrow-left"></i>
            </span>
        </a>
        <a class="btn btn-labeled btn-default" type="button" href="/home/{{ $legajo?$legajo->id:'' }}/1">
            <span class="btn-label"><i class="fa fa-arrow-right"></i>
            </span>
        </a>
   </div>
   <div class="col-md-4" style="text-align: right;">
       @if($edicion == true)
           <!-- <button class="btn btn-success">Grabar nueva categoría !</button> -->

           <button class="btn btn-labeled btn-success mb-2">
             <span class="btn-label"><i class="fa fa-check"></i>
             </span>Grabar
           </button>

           <a href="{{ url('/home') }}" class="btn btn-labeled btn-danger mb-2">
              <span class="btn-label"><i class="fa fa-times"></i>
              </span>Cancelar
           </a>
      @else
           <a class="btn btn-oval btn-success" href="/home/add" >Agregar</a>
           <a class="btn btn-oval btn-success" href="/home/edit/{{ $legajo->id }}">Editar</a>
           <!-- <a class="btn btn-oval btn-danger" href="/home/delete/{{ $legajo->id }}">Borrar</a> -->
      @endif
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
       <div class="card-header text-white bg-danger">Datos principales</div>
       <div class="row">
          <div class="card-body">
              <div class="col-xl-12 col-md-12">
                  <div class="col-md-12">
                       <div class="form-row">
                          <div class="col-lg-2 mb-2">
                              <label class="col-form-label">Dominio *</label>
                              <input class="form-control"
                                type="text" name="dominio" id="dominio"
                                {{ $edicion?'':'disabled' }}
                                {{ $agregar?'enabled autofocus=""':'disabled' }}
                                value="{{ old('dominio',$legajo->dominio) }}" maxlength="7" required>
                          </div>
                          @if ($errors->has('dominio'))
                              <div class="alert alert-danger">
                                  <ul>
                                    <li>{{ $errors->first('dominio') }}</li>
                                  </ul>
                              </div>
                          @endif

                          <div class="col-lg-1 mb-1">
                              &nbsp;
                          </div>

                          <div class="col-lg-2 mb-2">
                              <label class="col-form-label">Nro. Interno</label>
                              <input class="form-control"
                                type="text" name="codigo" id="codigo"
                                {{ $edicion?'':'disabled' }}
                                {{ $agregar?'enabled autofocus=""':'disabled' }}
                                value="{{ old('codigo',$legajo->codigo) }}" maxlength="5" required>
                          </div>

                          <div class="col-lg-2 mb-2">
                              &nbsp;
                          </div>


                          <!-- Widgets de imagenes (foto) -->
                          <div class="col-lg-5 mb-5">
                              <img class="img-fluid" src="/img/vehiculos/compactador.jpg" alt="..." style="width: 180.99306px; height: 100.99306px;margin-left: 60px">
                              &nbsp;&nbsp;
                              <button class="mb-sm btn btn-warning" type="button">Cambiar ...</button>
                          </div>

                          <!--
                          <div class="col-lg-3 mb-3">
                              <img class="img-fluid circle" src="/img/personal/5051.jpg" alt="Image"
                                  style="width: 85.99306px; height: 80.99306px;">
                          </div> -->
                     </div>
                  </div>



                  <div class="col-xl-10 col-md-10">
                    <div class="form-row">
                        <div class="col-md-5" style="margin-top: -40px;">
                          <label class="col-form-label">Detalle Vehículo *</label>
                          <input class="form-control" type="text" name="detalle" id="detalle"
                          {{ $edicion?'enabled':'disabled' }}
                          value="{{ old('detalle',$legajo->detalle) }}" autocomplete="off">

                          @if ($errors->has('detalle'))
                              <div class="alert alert-danger">
                                  <ul>
                                      <li>{{ $errors->first('detalle') }}</li>
                                  </ul>
                              </div>
                          @endif
                        </div>

                        <div class="col-md-5" style="margin-top: -40px;">
                            <label class="col-form-label">Modelo *</label>
                            <input class="form-control" type="text" name="modelo"
                            {{ $edicion?'enabled':'disabled' }}
                            value="{{ old('modelo',$legajo->modelo) }}" required>

                            @if ($errors->has('modelo'))
                                <div class="alert alert-danger">
                                    <ul>
                                        <li>{{ $errors->first('modelo') }}</li>
                                    </ul>
                                </div>
                            @endif
                        </div>
                      </div>
                  </div>

                  <div class="col-md-10">
                       <div class="form-row">
                           <div class="col-md-5">
                             <label class="col-form-label">Tipo de Vehículo *</label>
                             <select class="form-control" id="grupo" name="grupo" {{ $edicion?'enabled':'disabled' }}>
                                @foreach ($tipos as $tipo)
                                    <option value = "{{ $tipo->codigo  }}"
                                      @if ($legajo->grupo == $tipo->codigo)  selected   @endif  >
                                      {{ $tipo->detalle }}   ({{ $tipo->codigo  }})
                                    </option>
                                @endforeach
                            </select>

                             @if ($errors->has('grupo'))
                                 <div class="alert alert-danger">
                                     <ul>
                                         <li>{{ $errors->first('grupo') }}</li>
                                     </ul>
                                 </div>
                             @endif
                           </div>

                          <div class="col-lg-2 mb-2">
                            <label class="col-form-label">Año</label>
                            <input class="form-control" type="text" name="anio" id="anio"
                            {{ $edicion?'enabled':'disabled' }}
                            value="{{ old('anio',$legajo->anio) }}" required>
                          </div>

                          <div class="col-md-1"></div>


                        </div>

                 </div>


                  <div class="col-xl-10 col-md-10">
                    <div class="form-row">
                        <div class="col-md-5">
                          <label class="col-form-label">Motor</label>
                          <input class="form-control" type="text" name="motor" id="motor"
                          {{ $edicion?'enabled':'disabled' }}
                          value="{{ old('motor',$legajo->motor) }}" >

                          @if ($errors->has('motor'))
                              <div class="alert alert-danger">
                                  <ul>
                                      <li>{{ $errors->first('motor') }}</li>
                                  </ul>
                              </div>
                          @endif
                        </div>

                        <div class="col-md-5">
                            <label class="col-form-label">Chasis</label>
                            <input class="form-control" type="text" name="chasis"
                            {{ $edicion?'enabled':'disabled' }}
                            value="{{ old('chasis',$legajo->chasis) }}" required>

                            @if ($errors->has('chasis'))
                                <div class="alert alert-danger">
                                    <ul>
                                        <li>{{ $errors->first('chasis') }}</li>
                                    </ul>
                                </div>
                            @endif
                        </div>
                      </div>
                  </div>

                  <!--
                  <div class="col-xl-10 col-md-10">
                    <div class="form-row">
                        <div class="col-md-5">
                            <label class="col-form-label">Estado</label>
                            <input class="form-control" type="text" name="estado"
                            {{ $edicion?'enabled':'disabled' }}
                            value="{{ old('estado',$legajo->estado) }}" required>

                            @if ($errors->has('estado'))
                                <div class="alert alert-danger">
                                    <ul>
                                        <li>{{ $errors->first('estado') }}</li>
                                    </ul>
                                </div>
                            @endif
                        </div>
                      </div>
                  </div> -->

                  <div class="col-xl-10 col-md-10">
                    <div class="form-row">
                        <div class="col-md-5">
                          <label class="col-form-label">Equipo / Acoplado</label>
                          <input class="form-control" type="text" name="equipo" id="equipo"
                          {{ $edicion?'enabled':'disabled' }}
                          value="{{ old('equipo',$legajo->equipo) }}" >

                          @if ($errors->has('equipo'))
                              <div class="alert alert-danger">
                                  <ul>
                                      <li>{{ $errors->first('equipo') }}</li>
                                  </ul>
                              </div>
                          @endif
                        </div>

                        <div class="col-md-5">
                            <label class="col-form-label">Modelo (Equipo/Acoplado)</label>
                            <input class="form-control" type="text" name="modelo_eq"
                            {{ $edicion?'enabled':'disabled' }}
                            value="{{ old('modelo_eq',$legajo->modelo_eq) }}">

                            @if ($errors->has('modelo_eq'))
                                <div class="alert alert-danger">
                                    <ul>
                                        <li>{{ $errors->first('modelo_eq') }}</li>
                                    </ul>
                                </div>
                            @endif
                        </div>

                        <div class="col-md-5">
                            <label class="col-form-label">Afectado a Empresa</label>
                            <select class="form-control" id="empresa" name="empresa" {{ $edicion?'enabled':'disabled' }} autocomplete='country-name'>
                              <option value="00" @if ($legajo->empresa == "00")  selected   @endif  >Agrotecnica Fueguina</option>
                              <option value="01" @if ($legajo->empresa == "01")  selected   @endif  >Impacto Ambiental</option>
                            </select>

                            @if ($errors->has('modelo_eq'))
                                <div class="alert alert-danger">
                                    <ul>
                                        <li>{{ $errors->first('modelo_eq') }}</li>
                                    </ul>
                                </div>
                            @endif
                        </div>
                      </div>
                  </div>

              </div>
          </div>


          <!-- </div de widget de imagenes > -->
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
              
               <!--======================================================
               //                  Inscripcion
               ========================================================-->
               <div class="card card-default mb-1 border-info">
                  <div class="card-header text-white bg-info" id="headingOne">
                     <h5 class="mb-0"><a class="text-inherit collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" href="" >
                        Inscripción</a>
                     </h5>
                  </div>
                  <div class="collapse" id="collapseOne" aria-labelledby="headingOne" data-parent="#accordion">
                     <div class="card-body border-top">

                        <fieldset>
                           <div class="col-md-10">
                             <div class="form-row">
                                <div class="col-lg-5 mb-3">
                                  <label class="col-form-label">Inscripto en Provincia</label>

                                  <select class="form-control" id="inscripto" name="inscripto" {{ $edicion?'enabled':'disabled' }} autocomplete='country-name'>
                                    <option value="00" @if ($legajo->inscripto == "00")  selected   @endif  >Ciudad Autónoma de Buenos Aires</option>
                                    <option value="01" @if ($legajo->inscripto == "01")  selected   @endif  >Buenos Aires</option>
                                    <option value="02" @if ($legajo->inscripto == "02")  selected   @endif  >Catamara</option>
                                    <option value="03" @if ($legajo->inscripto == "03")  selected   @endif  >Córdoba</option>
                                    <option value="04" @if ($legajo->inscripto == "04")  selected   @endif  >Corrientes</option>
                                    <option value="05" @if ($legajo->inscripto == "05")  selected   @endif  >Entre Ríos</option>
                                    <option value="06" @if ($legajo->inscripto == "06")  selected   @endif  >Jujuy</option>
                                    <option value="07" @if ($legajo->inscripto == "07")  selected   @endif  >Mendoza</option>
                                    <option value="08" @if ($legajo->inscripto == "08")  selected   @endif  >La Rioja</option>
                                    <option value="09" @if ($legajo->inscripto == "09")  selected   @endif  >Salta</option>
                                    <option value="10" @if ($legajo->inscripto == "10")  selected   @endif  >San Juan</option>
                                    <option value="11" @if ($legajo->inscripto == "11")  selected   @endif  >San Luis</option>
                                    <option value="12" @if ($legajo->inscripto == "12")  selected   @endif  >Santa Fe</option>
                                    <option value="13" @if ($legajo->inscripto == "13")  selected   @endif  >Santiago del Estero</option>
                                    <option value="14" @if ($legajo->inscripto == "14")  selected   @endif  >Tucumán</option>
                                    <option value="16" @if ($legajo->inscripto == "16")  selected   @endif  >Chaco</option>
                                    <option value="17" @if ($legajo->inscripto == "17")  selected   @endif  >Chubut</option>
                                    <option value="18" @if ($legajo->inscripto == "18")  selected   @endif  >Formosa</option>
                                    <option value="19" @if ($legajo->inscripto == "19")  selected   @endif  >Misiones</option>
                                    <option value="20" @if ($legajo->inscripto == "20")  selected   @endif  >Neuquén</option>
                                    <option value="21" @if ($legajo->inscripto == "21")  selected   @endif  >La Pampa</option>
                                    <option value="22" @if ($legajo->inscripto == "22")  selected   @endif  >Río Negro</option>
                                    <option value="23" @if ($legajo->inscripto == "23")  selected   @endif  >Santa Cruz</option>
                                    <option value="24" @if ($legajo->inscripto == "24")  selected   @endif  >Tierra del Fuego</option>
                                  </select>

                                  </div>
                                  <div class="col-lg-3 mb-3">
                                    <label class="col-form-label">Numero</label>
                                    <input class="form-control" type="text" name="numero"
                                    {{ $edicion?'enabled':'disabled' }}
                                    value="{{ old('numero',$legajo->numero) }}" >
                                  </div>
                              </div>
                           </div>
                           <div class="col-md-10">
                             <div class="form-row">
                                <div class="col-lg-5 mb-3">
                                  <label class="col-form-label">Municipalidad</label>
                                  <input class="form-control" type="text" name="municipal"
                                  {{ $edicion?'enabled':'disabled' }}
                                  value="{{ old('municipal',$legajo->municipal) }}" >
                                  </div>
                                  <div class="col-lg-2 mb-2">
                                    <label class="col-form-label">Pin #</label>
                                    <input class="form-control" type="text" name="pin"
                                    {{ $edicion?'enabled':'disabled' }}
                                    value="{{ old('pin',$legajo->pin) }}" >
                                  </div>

                              </div>
                           </div>
                           <div class="col-md-10">
                             <div class="form-row">
                               <div class="col-lg-3 mb-3">
                                   <label class="col-form-label">Vencimiento Ruta</label>
                                   <div class="input-group date" id="datetimepicker1" data-provide="datepicker" data-date-format="dd/mm/yyyy" keyboardNavigation="true" title="Seleccione fecha" autoclose="true">
                                       <input class="form-control" type="text" value="{{ $legajo->vto_ruta }}" name="vto_ruta" {{ $edicion?'enabled':'disabled' }}>
                                       <span class="input-group-append input-group-addon">
                                         <span class="input-group-text fa fa-calendar"></span>
                                       </span>
                                   </div>
                               </div>

                              </div>
                           </div>

                           <div class="col-md-12">
                             <div class="form-row">
                               <div class="col-lg-3 mb-3">
                                   <label class="col-form-label">Vencimiento Tarjeta</label>
                                   <div class="input-group date" id="datetimepicker1" data-provide="datepicker" data-date-format="dd/mm/yyyy" keyboardNavigation="true" title="Seleccione fecha" autoclose="true">
                                       <input class="form-control" type="text" value="{{ $legajo->vto_tecni }}" name="vto_tecni" {{ $edicion?'enabled':'disabled' }}>
                                       <span class="input-group-append input-group-addon">
                                         <span class="input-group-text fa fa-calendar"></span>
                                       </span>
                                   </div>
                               </div>
                                <div class="col-lg-3 mb-3">
                                  <label class="col-form-label">Fecha de Alta</label>
                                  <div class="input-group date" id="datetimepicker1" data-provide="datepicker" data-date-format="dd/mm/yyyy" keyboardNavigation="true" title="Seleccione fecha" autoclose="true">
                                      <input class="form-control" type="text" value="{{ old('f_alta',$legajo->f_alta) }}" name="f_alta" id="f_alta" {{ $edicion?'enabled':'disabled' }}>
                                      <span class="input-group-append input-group-addon">
                                        <span class="input-group-text fa fa-calendar"></span>
                                      </span>
                                  </div>

                                  @if ($errors->has('f_alta'))
                                      <div class="alert alert-danger">
                                          <ul>
                                            <li>{{ $errors->first('f_alta') }}</li>
                                          </ul>
                                      </div>
                                  @endif
                               </div>

                               <hr></hr>
                               <legend>DNRPA (Direccion Nacional de los registros Nacionales de la propiedad automotor y de creditos prendarios)</legend>

                               <div class="col-md-12">
                                  <div class="form-row">
                                     <div class="col-lg-4 mb-4">
                                        <label class="col-form-label">Número de Registro Seccional</label>
                                        <input class="form-control" type="number" id="seccional" name="seccional"
                                        {{ $edicion?'enabled':'disabled' }}
                                        value="{{ old('seccional',$legajo->seccional) }}" >
                                      </div>

                                     <div class="col-lg-4 mb-4">
                                        <label class="col-form-label">Número de Trámite</label>
                                        <input class="form-control" type="number" id="tramite" name="tramite"
                                        {{ $edicion?'enabled':'disabled' }}
                                        value="{{ old('tramite',$legajo->tramite) }}" >
                                      </div>

                                     <div class="col-lg-4 mb-4">
                                        <label class="col-form-label">Número de Control Web</label>
                                        <input class="form-control" type="text" id="controlweb" name="controlweb"
                                        {{ $edicion?'enabled':'disabled' }}
                                        value="{{ old('controlweb',$legajo->controlweb) }}" >
                                      </div>

                                      <a class="btn btn-labeled btn-success" type="button" style="height: 31px;color: white" target="_blank"
                                          href="https://www2.jus.gov.ar/dnrpa-site/#!/consultarTramite/2030/220950/914B88D7E2/titulo">
                                        <span class="btn-label"><i class="fa fa-globe"></i>
                                        </span>Descargar formulario</a>
                                  </div>
                              </div>


                            </div>
                           </div>

                       </fieldset>

                     </div>
                  </div>
               </div>

               <!--======================================================
               //                  Seguros
               ========================================================-->
               <div class="card card-default mb-1 border-info">
                  <div class="card-header text-white bg-info" id="headingSeguros">
                     <h5 class="mb-0"><a class="text-inherit collapsed" data-toggle="collapse" data-target="#collapseSeguros" aria-expanded="true" aria-controls="collapseSeguros" href="" >
                        Seguros</a>
                     </h5>
                  </div>
                  <div class="collapse" id="collapseSeguros" aria-labelledby="headingSeguros" data-parent="#accordion">
                     <div class="card-body border-top">

                        <fieldset>
                           <div class="col-md-10">
                             <div class="form-row">
                                <div class="col-lg-5 mb-3">
                                   <label class="col-form-label">Compañia de Seguros</label>
                                   <input class="form-control" type="text" name="cia_seguro"
                                     {{ $edicion?'enabled':'disabled' }}
                                     value="{{ old('cia_seguro',$legajo->cia_seguro) }}" >
                                 </div>
                                 <div class="col-lg-4 mb-3">
                                    <label class="col-form-label">Nro. Póliza</label>
                                    <input class="form-control" type="text" name="n_poliza"
                                      {{ $edicion?'enabled':'disabled' }}
                                      value="{{ old('n_poliza',$legajo->n_poliza) }}">
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-10">
                             <div class="form-row">
                               <div class="col-lg-10 mb-10">
                                   <label class="col-form-label">Detalle de la Póliza</label>
                                   <input class="form-control" type="text" name="n_poliza"
                                     {{ $edicion?'enabled':'disabled' }}
                                     value="{{ old('n_poliza',$legajo->n_poliza) }}" >
                               </div>

                              </div>
                           </div>

                           <div class="col-md-10">
                             <div class="form-row">
                               <div class="col-lg-3 mb-3">
                                   <label class="col-form-label">Fecha de inicio</label>
                                   <div class="input-group date" id="datetimepicker1" data-provide="datepicker" data-date-format="dd/mm/yyyy" keyboardNavigation="true" title="Seleccione fecha" autoclose="true">
                                       <input class="form-control" type="text" value="{{ $legajo->vto_ruta }}" name="vto_ruta" {{ $edicion?'enabled':'disabled' }}>
                                       <span class="input-group-append input-group-addon">
                                         <span class="input-group-text fa fa-calendar"></span>
                                       </span>
                                   </div>
                               </div>
                               <div class="col-lg-3 mb-3">
                                   <label class="col-form-label">Vencimiento Póliza</label>
                                   <div class="input-group date" id="datetimepicker1" data-provide="datepicker" data-date-format="dd/mm/yyyy" keyboardNavigation="true" title="Seleccione fecha" autoclose="true">
                                       <input class="form-control" type="text" value="{{ $legajo->vto_tecni }}" name="vto_tecni" {{ $edicion?'enabled':'disabled' }}>
                                       <span class="input-group-append input-group-addon">
                                         <span class="input-group-text fa fa-calendar"></span>
                                       </span>
                                   </div>
                               </div>

                              </div>
                           </div>

                           @if ($errors->has('f_alta'))
                                <div class="alert alert-danger">
                                    <ul>
                                      <li>{{ $errors->first('f_alta') }}</li>
                                    </ul>
                                </div>
                            @endif

                       </fieldset>

                     </div>
                  </div>
               </div>

               <!-- =====================================================
               //                   Patentes
               =======================================================-->
               <div class="card card-default mb-1 border-info">
                      <div class="card-header text-white bg-info" id="headingPatente">
                          <h5 class="mb-0"><a class="text-inherit collapsed" data-toggle="collapse" data-target="#collapsePatente" aria-expanded="false" aria-controls="collapsePatente" href="">
                             Pago de Impuesto Automotor (Patente)</a>
                          </h5>
                      </div>
                      <div class="collapse" id="collapsePatente" aria-labelledby="headingPatente" data-parent="#accordion">
                         <div class="col-md-12">
                           <!-- START card-->
                           <div class="col-lg-2 mb-2">

                           </div>
                           <div class="col-lg-2 mb-2">
                              <a class="btn btn-labeled btn-success" type="button" style="height: 31px;color: white" target="_blank"
                                  href="https://www.dgrmsalta.gov.ar/rentasmuni/jsp/servicios/lnk_automotorLogin_1.jsp?estadoDeuda=CON_ESTADO&impuesto=0006">
                                <span class="btn-label"><i class="fa fa-globe"></i>
                                </span>Sitio web (ARMSa)</a>
                           </div>

                            <div class="card card-default">
                               <!-- <div class="card-header">
                               </div> -->



                               <!-- START table-responsive-->

                               <div class="table-responsive">
                                  <table class="table table-striped table-bordered table-hover">
                                     <thead>
                                       <th style="width: 800px">
                                         <strong>Fecha</strong>
                                       </th>
                                       <th style="width: 500px">
                                         <strong>Nro. Siniestro</strong>
                                       </th>
                                       <th>
                                         <strong>Encargado</strong>
                                       </th>
                                       <th style="width: 3000px">
                                         <strong>Comentarios</strong>
                                       </th>
                                       <th style="width: 1000px">
                                         <strong>Estado</strong>
                                       </th>
                                       <th></th>
                                       <th></th>
                                     </thead>
                                     <tbody>

                                       @if($siniestrosTer != null)
                                          @foreach ($siniestrosTer as $novedad)
                                             <tr>

                                               <td>
                                                  <div class="media align-items-center">
                                                     <div class="media-body d-flex">
                                                        <div>
                                                           {{ $novedad?$novedad->fecha :'' }}
                                                        </div>
                                                     </div>
                                                  </div>
                                               </td>

                                               <td>
                                                  <div class="media align-items-center">
                                                     <div class="media-body d-flex">
                                                        <div>
                                                           {{ $novedad?$novedad->nro_siniestro :'' }}
                                                        </div>
                                                     </div>
                                                  </div>
                                               </td>

                                               <td>
                                                  <div class="media align-items-center">
                                                     <div class="media-body d-flex">
                                                        <div>
                                                           {{ $novedad?$novedad->encarga:'' }}
                                                        </div>

                                                     </div>
                                                  </div>
                                               </td>

                                               <td>
                                                  <div class="media align-items-center">
                                                     <div class="media-body d-flex">
                                                        <div>
                                                           {{ $novedad?$novedad->detalle:'' }}
                                                        </div>

                                                     </div>
                                                  </div>
                                               </td>

                                               <td>
                                                  <div class="media align-items-center">
                                                     <div class="media-body d-flex">
                                                        <div>
                                                           {{ $novedad?$novedad->estado:'' }}
                                                        </div>

                                                     </div>
                                                  </div>
                                               </td>

                                               <td>
                                                 <div class="ml-auto">
                                                    <a title="Editar siniestro 3ros." class="btn btn-warning btn-sm" onclick="showModalEditT({{ $novedad->id }})">
                                                    <em class="fa fa-pencil" style="color: white"></em></a>

                                                    <!-- <button class="btn btn-warning btn-lg" name="btnAgregar" id="btnAgregar"
                                                      type="button" data-toggle="modal" data-target="#myModalEdit">
                                                      <em class="fa fa-sticky-note"></em>
                                                       Editar
                                                    </button>  -->
                                                 </div>
                                               </td>

                                               <td>
                                                 <div class="ml-auto">
                                                    <a title="Borrar siniestro 3ros." class="btn btn-danger btn-sm" onclick="showModaltBorrar({{ $novedad->id }})">
                                                      <em class="fa fa-trash" style="color: white"></em></a>
                                                    <!-- <button type="button" data-product_id="{{ $novedad->id }}" data-product_name="{{ $novedad->name }}" class="btn btn-xs btn-default btn-flat" data-toggle="modal" data-target="#confirmDelete"><i class="fa fa-trash"></i></button> -->
                                                    <!--<a title="Borrar novedad" class="btn btn-danger btn-sm" onclick="showModal({{ $novedad->id }})">
                                                      <em class="fa fa-trash" style="color: red"></em>
                                                    </a> -->
                                                 </div>
                                               </td>

                                             </tr>
                                          @endforeach
                                       @endif

                                     </tbody>
                                  </table>
                               </div>
                               <!-- END table-responsive-->
                               <div class="card-footer">
                                  <div class="d-flex">
                                     @if($siniestrosTer != null)
                                         <button class="btn btn-warning btn-lg" name="btnAgregar" id="btnAgregar"
                                           type="button" data-toggle="modal" data-target="#myModal-sinies3">
                                           <em class="fa fa-sticky-note"></em>
                                            Agregar Pago patente ...
                                         </button>
                                     @endif

                                     <!-- <a href="#myModalLarge" data-toggle="modal" name="modal1" id="modal1" >abrir</a> -->

                                     <nav class="ml-auto">
                                        <ul class="pagination pagination-sm">
                                           @if($siniestrosTer != null)
                                              {{ $siniestrosTer->links() }}
                                           @endif
                                        </ul>
                                     </nav>
                                  </div>
                                </div>

                            </div>
                            <!-- END card-->

                         </div>

                      </div>
               </div>

               <!--=======================================================
               /              Siniestros propios
               =========================================================-->
               <div class="card card-default mb-1 border-info">
                      <div class="card-header text-white bg-info" id="headingNine">
                         <h5 class="mb-0"><a class="text-inherit collapsed" data-toggle="collapse" data-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine" href="">Siniestros propios</a>
                         </h5>
                      </div>
                      <div class="collapse" id="collapseNine" aria-labelledby="headingNine" data-parent="#accordion">
                         <div class="col-md-12">
                           <!-- START card-->
                           <div class="col-lg-2 mb-2">
                           </div>

                            <div class="card card-default">
                               <!-- <div class="card-header">
                               </div> -->

                               <!-- START table-responsive-->
                               <div class="table-responsive">
                                  <table class="table table-striped table-bordered table-hover">
                                     <thead>
                                       <th style="width: 300px">
                                         <strong>Fecha</strong>
                                       </th>
                                       <th style="width: 200px">
                                         <strong>Nro.Siniestro</strong>
                                       </th>
                                       <th>
                                         <strong>Encargado</strong>
                                       </th>
                                       <th style="width: 800px">
                                         <strong>Comentarios
                                         </strong>
                                       </th>
                                       <th></th>
                                       <th></th>
                                     </thead>
                                     <tbody>
                                       @if($siniestros != null)
                                            @foreach ($siniestros as $novedad)
                                               <tr>

                                                 <td>
                                                    <div class="media align-items-center">
                                                       <div class="media-body d-flex">
                                                          <div>
                                                             {{ $novedad?$novedad->fecha :'' }}
                                                          </div>
                                                       </div>
                                                    </div>
                                                 </td>

                                                 <td>
                                                    <div class="media align-items-center">
                                                       <div class="media-body d-flex">
                                                          <div>
                                                             {{ $novedad?$novedad->nro_siniestro :'' }}
                                                          </div>
                                                       </div>
                                                    </div>
                                                 </td>

                                                 <td>
                                                    <div class="media align-items-center">
                                                       <div class="media-body d-flex">
                                                          <div>
                                                             {{ $novedad?$novedad->encarga:'' }}
                                                          </div>

                                                       </div>
                                                    </div>
                                                 </td>

                                                 <td>
                                                    <div class="media align-items-center">
                                                       <div class="media-body d-flex">
                                                          <div>
                                                             {{ $novedad?$novedad->detalle:'' }}
                                                          </div>

                                                       </div>
                                                    </div>
                                                 </td>

                                                 <td>
                                                   <div class="ml-auto">
                                                      <a title="Editar siniestro" class="btn btn-warning btn-sm" onclick="showModalEdits({{ $novedad->id }})">
                                                      <em class="fa fa-pencil" style="color: white"></em></a>

                                                      <!-- <button class="btn btn-warning btn-lg" name="btnAgregar" id="btnAgregar"
                                                        type="button" data-toggle="modal" data-target="#myModalEdit">
                                                        <em class="fa fa-sticky-note"></em>
                                                         Editar
                                                      </button>  -->
                                                   </div>
                                                 </td>

                                                 <td>
                                                   <div class="ml-auto">
                                                      <a title="Borrar siniestro" class="btn btn-danger btn-sm" onclick="showModalsBorrar({{ $novedad->id }})">
                                                        <em class="fa fa-trash" style="color: white"></em></a>
                                                      <!-- <button type="button" data-product_id="{{ $novedad->id }}" data-product_name="{{ $novedad->name }}" class="btn btn-xs btn-default btn-flat" data-toggle="modal" data-target="#confirmDelete"><i class="fa fa-trash"></i></button> -->
                                                      <!--<a title="Borrar novedad" class="btn btn-danger btn-sm" onclick="showModal({{ $novedad->id }})">
                                                        <em class="fa fa-trash" style="color: red"></em>
                                                      </a> -->
                                                   </div>
                                                 </td>

                                               </tr>
                                            @endforeach
                                       @endif
                                     </tbody>
                                  </table>
                               </div>
                               <!-- END table-responsive-->
                               <div class="card-footer">
                                  <div class="d-flex">
                                     @if($siniestros != null)
                                       <button class="btn btn-warning btn-lg" name="btnAgregar" id="btnAgregar"
                                         type="button" data-toggle="modal" data-target="#myModal-sinies">
                                         <em class="fa fa-sticky-note"></em>
                                          Agregar siniestros...
                                       </button>
                                     @endif

                                     <!-- <a href="#myModalLarge" data-toggle="modal" name="modal1" id="modal1" >abrir</a> -->

                                     <nav class="ml-auto">
                                        <ul class="pagination pagination-sm">
                                            @if($siniestros != null)
                                                {{ $siniestros->links() }}
                                            @endif
                                        </ul>
                                     </nav>
                                  </div>
                                </div>

                            </div>
                            <!-- END card-->

                         </div>

                      </div>
               </div>

               <!--=======================================================
               /              Siniestros recibidos por 3ros
               =========================================================-->
               <div class="card card-default mb-1 border-info">
                      <div class="card-header text-white bg-info" id="headingTwo">
                          <h5 class="mb-0"><a class="text-inherit collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" href="">Siniestros sufridos por la empresa</a>
                          </h5>
                      </div>
                      <div class="collapse" id="collapseTwo" aria-labelledby="headingTwo" data-parent="#accordion">
                         <div class="col-md-12">
                           <!-- START card-->
                           <div class="col-lg-2 mb-2">
                           </div>

                            <div class="card card-default">
                               <!-- <div class="card-header">
                               </div> -->

                               <!-- START table-responsive-->
                               <div class="table-responsive">
                                  <table class="table table-striped table-bordered table-hover">
                                     <thead>
                                       <th style="width: 800px">
                                         <strong>Fecha</strong>
                                       </th>
                                       <th style="width: 500px">
                                         <strong>Nro. Siniestro</strong>
                                       </th>
                                       <th>
                                         <strong>Encargado</strong>
                                       </th>
                                       <th style="width: 3000px">
                                         <strong>Comentarios</strong>
                                       </th>
                                       <th style="width: 1000px">
                                         <strong>Estado</strong>
                                       </th>
                                       <th></th>
                                       <th></th>
                                     </thead>
                                     <tbody>

                                       @if($siniestrosTer != null)
                                          @foreach ($siniestrosTer as $novedad)
                                             <tr>

                                               <td>
                                                  <div class="media align-items-center">
                                                     <div class="media-body d-flex">
                                                        <div>
                                                           {{ $novedad?$novedad->fecha :'' }}
                                                        </div>
                                                     </div>
                                                  </div>
                                               </td>

                                               <td>
                                                  <div class="media align-items-center">
                                                     <div class="media-body d-flex">
                                                        <div>
                                                           {{ $novedad?$novedad->nro_siniestro :'' }}
                                                        </div>
                                                     </div>
                                                  </div>
                                               </td>

                                               <td>
                                                  <div class="media align-items-center">
                                                     <div class="media-body d-flex">
                                                        <div>
                                                           {{ $novedad?$novedad->encarga:'' }}
                                                        </div>

                                                     </div>
                                                  </div>
                                               </td>

                                               <td>
                                                  <div class="media align-items-center">
                                                     <div class="media-body d-flex">
                                                        <div>
                                                           {{ $novedad?$novedad->detalle:'' }}
                                                        </div>

                                                     </div>
                                                  </div>
                                               </td>

                                               <td>
                                                  <div class="media align-items-center">
                                                     <div class="media-body d-flex">
                                                        <div>
                                                           {{ $novedad?$novedad->estado:'' }}
                                                        </div>

                                                     </div>
                                                  </div>
                                               </td>

                                               <td>
                                                 <div class="ml-auto">
                                                    <a title="Editar siniestro 3ros." class="btn btn-warning btn-sm" onclick="showModalEditT({{ $novedad->id }})">
                                                    <em class="fa fa-pencil" style="color: white"></em></a>

                                                    <!-- <button class="btn btn-warning btn-lg" name="btnAgregar" id="btnAgregar"
                                                      type="button" data-toggle="modal" data-target="#myModalEdit">
                                                      <em class="fa fa-sticky-note"></em>
                                                       Editar
                                                    </button>  -->
                                                 </div>
                                               </td>

                                               <td>
                                                 <div class="ml-auto">
                                                    <a title="Borrar siniestro 3ros." class="btn btn-danger btn-sm" onclick="showModaltBorrar({{ $novedad->id }})">
                                                      <em class="fa fa-trash" style="color: white"></em></a>
                                                    <!-- <button type="button" data-product_id="{{ $novedad->id }}" data-product_name="{{ $novedad->name }}" class="btn btn-xs btn-default btn-flat" data-toggle="modal" data-target="#confirmDelete"><i class="fa fa-trash"></i></button> -->
                                                    <!--<a title="Borrar novedad" class="btn btn-danger btn-sm" onclick="showModal({{ $novedad->id }})">
                                                      <em class="fa fa-trash" style="color: red"></em>
                                                    </a> -->
                                                 </div>
                                               </td>

                                             </tr>
                                          @endforeach
                                       @endif

                                     </tbody>
                                  </table>
                               </div>
                               <!-- END table-responsive-->
                               <div class="card-footer">
                                  <div class="d-flex">
                                     @if($siniestrosTer != null)
                                         <button class="btn btn-warning btn-lg" name="btnAgregar" id="btnAgregar"
                                           type="button" data-toggle="modal" data-target="#myModal-sinies3">
                                           <em class="fa fa-sticky-note"></em>
                                            Agregar siniestro sufrido ...
                                         </button>
                                     @endif

                                     <!-- <a href="#myModalLarge" data-toggle="modal" name="modal1" id="modal1" >abrir</a> -->

                                     <nav class="ml-auto">
                                        <ul class="pagination pagination-sm">
                                           @if($siniestrosTer != null)
                                              {{ $siniestrosTer->links() }}
                                           @endif
                                        </ul>
                                     </nav>
                                  </div>
                                </div>

                            </div>
                            <!-- END card-->

                         </div>

                      </div>
               </div>

               <!--=======================================================
               /              Multas
               =========================================================-->
               <div class="card card-default mb-1 border-info">
                      <div class="card-header bg-info" id="headingFour">
                         <h5 class="mb-0"><a class="text-inherit collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour" href="">Multas</a>
                       </h5>
                      </div>
                      <div class="collapse" id="collapseFour" aria-labelledby="headingFour" data-parent="#accordion">
                        <div class="col-md-12">
                          <!-- START card-->
                          <div class="col-lg-2 mb-2">
                          </div>

                           <div class="card card-default">
                              <!-- <div class="card-header">
                              </div> -->

                              <!-- START table-responsive-->
                              <div class="table-responsive">
                                 <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                      <th style="width: 700px">
                                        <strong>Fecha</strong>
                                      </th>
                                      <th>
                                        <strong>Encargado</strong>
                                      </th>
                                      <th style="width: 1800px">
                                        <strong>Comentarios</strong>
                                      </th>
                                      <th style="width: 500px">
                                        <strong>Importe</strong>
                                      </th>
                                      <th style="width: 700px">
                                        <strong>Fecha de pago</strong>
                                      </th>

                                      <th></th>
                                      <th></th>
                                    </thead>
                                    <tbody>

                                      @if($multas != null)
                                         @foreach ($multas as $novedad)
                                            <tr>

                                              <td>
                                                 <div class="media align-items-center">
                                                    <div class="media-body d-flex">
                                                       <div>
                                                          {{ $novedad?$novedad->fecha :'' }}
                                                       </div>
                                                    </div>
                                                 </div>
                                              </td>

                                              <td>
                                                 <div class="media align-items-center">
                                                    <div class="media-body d-flex">
                                                       <div>
                                                          {{ $novedad?$novedad->encarga :'' }}
                                                       </div>
                                                    </div>
                                                 </div>
                                              </td>

                                              <td>
                                                 <div class="media align-items-center">
                                                    <div class="media-body d-flex">
                                                       <div>
                                                          {{ $novedad?$novedad->detalle:'' }}
                                                       </div>

                                                    </div>
                                                 </div>
                                              </td>

                                              <td>
                                                 <div class="media align-items-center">
                                                    <div class="media-body d-flex">
                                                       <div>
                                                          {{ $novedad?$novedad->importe:'' }}
                                                       </div>

                                                    </div>
                                                 </div>
                                              </td>

                                              <td>
                                                 <div class="media align-items-center">
                                                    <div class="media-body d-flex">
                                                       <div>
                                                          {{ $novedad?$novedad->fecha_pago:'' }}
                                                       </div>

                                                    </div>
                                                 </div>
                                              </td>

                                              <td>
                                                <div class="ml-auto">
                                                   <a title="Editar multa" class="btn btn-warning btn-sm" onclick="showModalEditm({{ $novedad->id }})">
                                                   <em class="fa fa-pencil" style="color: white"></em></a>

                                                   <!-- <button class="btn btn-warning btn-lg" name="btnAgregar" id="btnAgregar"
                                                     type="button" data-toggle="modal" data-target="#myModalEdit">
                                                     <em class="fa fa-sticky-note"></em>
                                                      Editar
                                                   </button>  -->
                                                </div>
                                              </td>

                                              <td>
                                                <div class="ml-auto">
                                                   <a title="Borrar multa" class="btn btn-danger btn-sm" onclick="showModalmBorrar({{ $novedad->id }})">
                                                     <em class="fa fa-trash" style="color: white"></em></a>
                                                   <!-- <button type="button" data-product_id="{{ $novedad->id }}" data-product_name="{{ $novedad->name }}" class="btn btn-xs btn-default btn-flat" data-toggle="modal" data-target="#confirmDelete"><i class="fa fa-trash"></i></button> -->
                                                   <!--<a title="Borrar novedad" class="btn btn-danger btn-sm" onclick="showModal({{ $novedad->id }})">
                                                     <em class="fa fa-trash" style="color: red"></em>
                                                   </a> -->
                                                </div>
                                              </td>

                                            </tr>
                                         @endforeach
                                      @endif

                                    </tbody>
                                 </table>
                              </div>
                              <!-- END table-responsive-->
                              <div class="card-footer">
                                 <div class="d-flex">
                                     @if($multas != null)
                                       <button class="btn btn-warning btn-lg" name="btnAgregar" id="btnAgregar"
                                         type="button" data-toggle="modal" data-target="#myModal-multac">
                                         <em class="fa fa-sticky-note"></em>
                                          Agregar multa ...
                                       </button>
                                     @endif

                                    <!-- <a href="#myModalLarge" data-toggle="modal" name="modal1" id="modal1" >abrir</a> -->

                                    <nav class="ml-auto">
                                       <ul class="pagination pagination-sm">
                                          @if($multas != null)
                                              {{ $multas->links() }}
                                          @endif
                                       </ul>
                                    </nav>
                                 </div>
                               </div>

                           </div>
                           <!-- END card-->

                        </div>

                      </div>
               </div>

               <!--=======================================================
               /              Rto
               =========================================================-->
               <div class="card card-default mb-1 border-info">
                      <div class="card-header bg-info" id="headingFive">
                         <h5 class="mb-0"><a class="text-inherit collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive" href="">Revisión Técnica Obligatoria</a>
                       </h5>
                      </div>
                      <div class="collapse" id="collapseFive" aria-labelledby="headingFive" data-parent="#accordion">
                         <div class="col-md-12">
                           <!-- START card-->
                           <div class="col-lg-2 mb-2">
                           </div>

                            <div class="card card-default">

                                 <!-- START table-responsive-->
                                 <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                       <thead>
                                         <th style="width: 415px">
                                           <strong>Fecha</strong>
                                         </th>
                                         <th style="width: 500px">
                                           <strong>Tipo de novedad</strong>
                                         </th>
                                         <!-- <th>
                                           <strong>Encargado</strong>
                                         </th> -->
                                         <th style="width: 800px">
                                           <strong>
                                             Detalle
                                           </strong>
                                         </th>
                                         <th>
                                           <strong>
                                             Vencimiento
                                           </strong>
                                         </th>
                                         <th></th>
                                         <th></th>
                                       </thead>
                                       <tbody>
                                         @if($novedades != null)
                                            @foreach ($novedades as $novedad)
                                               <tr>

                                                 <td>
                                                    <div class="media align-items-center">
                                                       <div class="media-body d-flex">
                                                          <div>
                                                             {{ $novedad?$novedad->fecha :'' }}
                                                          </div>
                                                       </div>
                                                    </div>
                                                 </td>

                                                 <td>
                                                    <div class="media align-items-center">
                                                       <div class="media-body d-flex">
                                                          <div>
                                                             {{ $novedad?$novedad->tipo :'' }}
                                                          </div>
                                                       </div>
                                                    </div>
                                                 </td>

                                                 <!-- <td>
                                                    <div class="media align-items-center">
                                                       <div class="media-body d-flex">
                                                          <div>
                                                             {{ $novedad?$novedad->encarga:'' }}
                                                          </div>

                                                       </div>
                                                    </div>
                                                 </td> -->

                                                 <td>
                                                    <div class="media align-items-center">
                                                       <div class="media-body d-flex">
                                                          <div>
                                                             {{ $novedad?$novedad->detalle:'' }}
                                                          </div>

                                                       </div>
                                                    </div>
                                                 </td>

                                                 <td>
                                                    <div class="media align-items-center">
                                                       <div class="media-body d-flex">
                                                          <div>
                                                             {{ $novedad?$novedad->vencimient :'' }}
                                                          </div>

                                                       </div>
                                                    </div>
                                                 </td>

                                                 <td>
                                                   <div class="ml-auto">
                                                      <a title="Editar R.T.O." class="btn btn-warning btn-sm" onclick="showModalEditR({{ $novedad->id }})">
                                                      <em class="fa fa-pencil" style="color: white"></em></a>

                                                      <!-- <button class="btn btn-warning btn-lg" name="btnAgregar" id="btnAgregar"
                                                        type="button" data-toggle="modal" data-target="#myModalEdit">
                                                        <em class="fa fa-sticky-note"></em>
                                                         Editar
                                                      </button>  -->
                                                   </div>
                                                 </td>

                                                 <td>
                                                   <div class="ml-auto">
                                                      <a title="Borrar R.T.O." class="btn btn-danger btn-sm" onclick="showModalrBorrar({{ $novedad->id }})">
                                                        <em class="fa fa-trash" style="color: white"></em></a>
                                                      <!-- <button type="button" data-product_id="{{ $novedad->id }}" data-product_name="{{ $novedad->name }}" class="btn btn-xs btn-default btn-flat" data-toggle="modal" data-target="#confirmDelete"><i class="fa fa-trash"></i></button> -->
                                                      <!--<a title="Borrar novedad" class="btn btn-danger btn-sm" onclick="showModal({{ $novedad->id }})">
                                                        <em class="fa fa-trash" style="color: red"></em>
                                                      </a> -->
                                                   </div>
                                                 </td>

                                               </tr>
                                            @endforeach
                                         @endif
                                       </tbody>
                                    </table>
                                 </div>
                                 <!-- END table-responsive-->
                                 <div class="card-footer">
                                    <div class="d-flex">
                                       @if($novedades != null)
                                           <button class="btn btn-warning btn-lg" name="btnAgregar" id="btnAgregar"
                                             type="button" data-toggle="modal" data-target="#myModalLarge">
                                             <em class="fa fa-sticky-note"></em>
                                              Agregar nueva R.T.O.
                                           </button>
                                       @endif

                                       <!-- <a href="#myModalLarge" data-toggle="modal" name="modal1" id="modal1" >abrir</a> -->

                                       <nav class="ml-auto">
                                          <ul class="pagination pagination-sm">
                                             @if($novedades != null)
                                                {{ $novedades->links() }}
                                             @endif
                                          </ul>
                                       </nav>
                                    </div>


                                   </div>

                             </div>

                         </div>

                      </div>
               </div>

               <!--=======================================================
               /              Baja
               =========================================================-->
               <div class="card card-default mb-1 border-info">
                      <div class="card-header bg-info" id="headingSeven">
                         <h5 class="mb-0"><a class="text-inherit collapsed" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven" href="">Venta o Baja</a>
                         </h5>
                      </div>
                      <div class="collapse" id="collapseSeven" aria-labelledby="headingSeven" data-parent="#accordion">
                         <div class="card-body border-top">

                            <div class="col-md-12">
                              <!-- START list group-->
                              <div class="list-group mb-0">
                                 @if($baja == null)
                                      <a title="Realizar venta o baja" class="list-group-item list-group-item-action"
                                        type="button" data-toggle="modal"

                                        @if($legajo->dominio == null)
                                        @else
                                          data-target="#myModalbaja"
                                        @endif

                                        href="#">
                                        <span class="badge badge-purple float-right">Sin datos</span>
                                   @else
                                      <a title="Realizar venta o baja" class="list-group-item list-group-item-action"
                                          type="button" data-toggle=""
                                          href="#" onclick="showModalEditbaja({{ $legajo->id }})">
                                      <span class="badge badge-green float-right">Proceso de {{ $baja->tipo_baja }} iniciado el {{ $baja->fecha }}</span>
                                   @endif

                                   @if($baja != null)
                                       @if($baja->tipo_baja == 'Venta')
                                              <em class="fa fa-fw fa-truck mr-2"></em>Datos de Venta</a>
                                              @if($comprador != null)
                                                  <a class="list-group-item list-group-item-action" data-toggle="" data-target=""
                                                    href="#" onclick="showModalEditcomprador({{ $legajo->id }})">
                                                  <span class="badge badge-green float-right">{{ $comprador->comprador }}</span>
                                              @else
                                                  <a class="list-group-item list-group-item-action"
                                                    data-toggle="modal" data-target="#myModalcomprador" href="#">
                                                  <span class="badge badge-purple float-right">Sin datos</span>
                                              @endif
                                              <em class="fa fa-fw fa-user mr-2"></em>Datos del comprador</a>

                                              @if($libreDM != null)
                                                  <a class="list-group-item list-group-item-action" data-toggle="" data-target=""
                                                    href="#" onclick="showmyModalfactura({{ $legajo->id }})">
                                                    <span class="badge badge-green float-right">{{ $libreDM->fecha }}</span>
                                                    <em class="fa fa-fw fa-check mr-2"></em>Factura de Venta</a>
                                              @else
                                                  <a class="list-group-item list-group-item-action" data-toggle="modal" data-target="#myModalfactura" href="#">
                                                    <span class="badge badge-purple float-right">Sin datos</span>
                                                    <em class="fa fa-fw fa-square-o mr-2"></em>Factura de Venta</a>
                                              @endif

                                              @if($libreDM != null)
                                                  <a class="list-group-item list-group-item-action" data-toggle="" data-target=""
                                                    href="#" onclick="showModalEditlibreDM({{ $legajo->id }})">
                                                    <span class="badge badge-green float-right">{{ $libreDM->fecha }}</span>
                                                    <em class="fa fa-fw fa-check mr-2"></em>Libre deuda Municiaplidad</a>
                                              @else
                                                  <a class="list-group-item list-group-item-action" data-toggle="modal" data-target="#myModalLibreDM" href="#">
                                                    <span class="badge badge-purple float-right">Sin datos</span>
                                                    <em class="fa fa-fw fa-square-o mr-2"></em>Libre deuda Municiaplidad</a>
                                              @endif


                                              @if($libreDP != null)
                                                  <a class="list-group-item list-group-item-action" data-toggle="" data-target=""
                                                    href="#" onclick="showModalEditlibreDP({{ $legajo->id }})">
                                                    <span class="badge badge-green float-right">{{ $libreDP->fecha }}</span>
                                                    <em class="fa fa-fw fa-check mr-2"></em>Baja Municipalidad</a>
                                              @else
                                                  <a class="list-group-item list-group-item-action" data-toggle="modal" data-target="#myModalLibreDP" href="#">
                                                    <span class="badge badge-purple float-right">Sin datos</span>
                                                    <em class="fa fa-fw fa-square-o mr-2"></em>Baja Municipalidad</a>
                                              @endif

                                              @if($dominio != null)
                                                  <a class="list-group-item list-group-item-action" data-toggle="" data-target=""
                                                    href="#" onclick="showModalEditDominio({{ $legajo->id }})">
                                                    <span class="badge badge-green float-right">{{ $dominio->fecha }}</span>
                                                    <em class="fa fa-fw fa-check mr-2"></em>Informe de dominio</a>
                                              @else
                                                  <a class="list-group-item list-group-item-action" data-toggle="modal" data-target="#myModalDominio" href="#">
                                                    <span class="badge badge-purple float-right">Sin datos</span>
                                                    <em class="fa fa-fw fa-square-o mr-2"></em>Informe de dominio</a>
                                              @endif

                                              @if($denuncia != null)
                                                  <a class="list-group-item list-group-item-action" data-toggle="" data-target=""
                                                    href="#" onclick="showModalEditDenuncia({{ $legajo->id }})">
                                                    <span class="badge badge-green float-right">{{ $denuncia->fecha }}</span>
                                                    <em class="fa fa-fw fa-check mr-2"></em>Denuncia de venta</a>
                                              @else
                                                  <a class="list-group-item list-group-item-action" data-toggle="modal" data-target="#myModalDenuncia" href="#">
                                                    <span class="badge badge-purple float-right">Sin datos</span>
                                                    <em class="fa fa-fw fa-square-o mr-2"></em>Denuncia de venta</a>
                                              @endif

                                              @if($denuncia != null)
                                                  <a class="list-group-item list-group-item-action" data-toggle="" data-target=""
                                                    href="#" onclick="showModalEditDenuncia({{ $legajo->id }})">
                                                    <span class="badge badge-green float-right">{{ $denuncia->fecha }}</span>
                                                    <em class="fa fa-fw fa-check mr-2"></em>Transferencia de venta</a>
                                              @else
                                                  <a class="list-group-item list-group-item-action" data-toggle="modal" data-target="#myModalDenuncia" href="#">
                                                    <span class="badge badge-purple float-right">Sin datos</span>
                                                    <em class="fa fa-fw fa-square-o mr-2"></em>Transferencia de venta</a>
                                              @endif


                                              @if($policial != null)
                                                  <a class="list-group-item list-group-item-action" data-toggle="" data-target=""
                                                    href="#" onclick="showModalEditPolicial({{ $legajo->id }})">
                                                    <span class="badge badge-green float-right">{{ $policial->fecha }}</span>
                                                    <em class="fa fa-fw fa-check mr-2"></em>Verificación policial</a>
                                              @else
                                                  <a class="list-group-item list-group-item-action" data-toggle="modal" data-target="#myModalPolicial" href="#">
                                                    <span class="badge badge-purple float-right">Sin datos</span>
                                                    <em class="fa fa-fw fa-square-o mr-2"></em>Verificación policial</a>
                                              @endif

                                              @if($ceta != null)
                                                  <a class="list-group-item list-group-item-action" data-toggle="" data-target=""
                                                    href="#" onclick="showModalEditCeta({{ $legajo->id }})">
                                                    <span class="badge badge-green float-right">{{ $ceta->fecha }}</span>
                                                    <em class="fa fa-fw fa-check mr-2"></em>Formulario CETA</a>
                                              @else
                                                  <a class="list-group-item list-group-item-action" data-toggle="modal" data-target="#myModalCeta" href="#">
                                                    <span class="badge badge-purple float-right">Sin datos</span>
                                                    <em class="fa fa-fw fa-square-o mr-2"></em>Formulario CETA</a>
                                              @endif

                                              @if($ceta != null)
                                                  <a class="list-group-item list-group-item-action" data-toggle="" data-target=""
                                                    href="#" onclick="showModalEditCeta({{ $legajo->id }})">
                                                    <span class="badge badge-green float-right">{{ $ceta->fecha }}</span>
                                                    <em class="fa fa-fw fa-check mr-2"></em>Formulario 08</a>
                                              @else
                                                  <a class="list-group-item list-group-item-action" data-toggle="modal" data-target="#myModalCeta" href="#">
                                                    <span class="badge badge-purple float-right">Sin datos</span>
                                                    <em class="fa fa-fw fa-square-o mr-2"></em>Formulario 08</a>
                                              @endif

                                            <a class="list-group-item list-group-item-action" data-toggle="" data-target=""
                                              href="#" onclick="confirmarVenta({{ $legajo->id }})">
                                              <span class="badge badge-purple float-right">Sin datos</span>
                                              <em class="fa fa-fw fa-square-o mr-2"></em>Finalizar Venta</a>
                                        @elseif ($baja->tipo_baja == 'Baja por transferencia de Destino')
                                            <em class="fa fa-fw fa-truck mr-2"></em>Datos de Baja</a>
                                        @else
                                            <em class="fa fa-fw fa-truck mr-2"></em>Datos de Baja</a>

                                            @if($f381 != null)
                                                <a class="list-group-item list-group-item-action" data-toggle="" data-target=""
                                                  href="#" onclick="showModalEditF381({{ $legajo->id }})">
                                                  <span class="badge badge-green float-right">{{ $f381->fecha }}</span>
                                                  <em class="fa fa-fw fa-check mr-2"></em>Formulario 381</a>
                                            @else
                                                <a class="list-group-item list-group-item-action" data-toggle="modal" data-target="#myModalF381" href="#">
                                                  <span class="badge badge-purple float-right">Sin datos</span>
                                                  <em class="fa fa-fw fa-square-o mr-2"></em>Formulario 381</a>
                                            @endif

                                            @if($policial != null)
                                                <a class="list-group-item list-group-item-action" data-toggle="" data-target=""
                                                  href="#" onclick="showModalEditPolicial({{ $legajo->id }})">
                                                  <span class="badge badge-green float-right">{{ $policial->fecha }}</span>
                                                  <em class="fa fa-fw fa-check mr-2"></em>Verificación policial</a>
                                            @else
                                                <a class="list-group-item list-group-item-action" data-toggle="modal" data-target="#myModalPolicial" href="#">
                                                  <span class="badge badge-purple float-right">Sin datos</span>
                                                  <em class="fa fa-fw fa-square-o mr-2"></em>Verificación policial</a>
                                            @endif

                                            @if($dnrpa != null)
                                                <a class="list-group-item list-group-item-action" data-toggle="" data-target=""
                                                  href="#" onclick="showModalEditDNRPA({{ $legajo->id }})">
                                                  <span class="badge badge-green float-right">{{ $dnrpa->fecha }}</span>
                                                  <em class="fa fa-fw fa-check mr-2"></em>Formulario 13 de la DNRPA</a>
                                            @else
                                                <a class="list-group-item list-group-item-action" data-toggle="modal" data-target="#myModalDNRPA" href="#">
                                                  <span class="badge badge-purple float-right">Sin datos</span>
                                                  <em class="fa fa-fw fa-square-o mr-2"></em>Formulario 13 de la DNRPA</a>
                                            @endif

                                            @if($dnrpa != null)
                                                <a class="list-group-item list-group-item-action" data-toggle="" data-target=""
                                                  href="#" onclick="showModalEditDNRPA({{ $legajo->id }})">
                                                  <span class="badge badge-green float-right">{{ $dnrpa->fecha }}</span>
                                                  <em class="fa fa-fw fa-check mr-2"></em>Formulario 04 DNRPA</a>
                                            @else
                                                <a class="list-group-item list-group-item-action" data-toggle="modal" data-target="#myModalDNRPA" href="#">
                                                  <span class="badge badge-purple float-right">Sin datos</span>
                                                  <em class="fa fa-fw fa-square-o mr-2"></em>Formulario 04 DNRPA</a>
                                            @endif

                                            <a class="list-group-item list-group-item-action" data-toggle="" data-target=""
                                              href="#" onclick="confirmarBaja({{ $legajo->id }})">
                                               <span class="badge badge-purple float-right">Sin datos</span>
                                               <em class="fa fa-fw fa-square-o mr-2"></em>Finalizar Baja</a>
                                        @endif
                                    @else
                                       <em class="fa fa-fw fa-truck mr-2"></em>Datos de Venta o Baja</a>
                                    @endif
                              </div>
                              <!-- END list group
                              <div class="card-footer text-right"><a class="btn btn-secondary btn-sm" href="#">View All Activity</a>
                              </div> -->
                            </div>
                         </div>
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
<?php
if($exibirModal === "true") : // Si nuestra variable de control "$exibirModal" es igual a TRUE activa nuestro modal y será visible a nuestro usuario. ?>
<script>
  $(document).ready(function()
  {
      //var cod_nov = '<?php echo $cod_nov ?>'

      //tipoNovedad2(cod_nov);

      // id de nuestro modal
      $("#myModalEditS").modal("show");
  });
</script>
<?php endif; ?>

<script type="text/javascript">

  $(function() {
    $( "#datepicker" ).datepicker({
      changeMonth: true,
      autoclose: true,
      changeYear: true
    });
  });

  function showModalsBorrar(e) {
      //alert(e);
      var punto = e;

      $.ajax({
              url: "/siniestros/delete/" + punto,
              data: "id="+punto+"&_token={{ csrf_token()}}",
              dataType: "json",
              method: "POST",
              success: function(result)
              {
                if (result['result'] == 'ok')
                  {
                      swal("El siniestro no puede eliminarse !", "Contiene digitalizaciones adjuntas, borrelas antes de poder eliminar el examen...")
                  }
                  else
                  {
                      swal({
                            title: "Está seguro(a) ?",
                            text: "Está a punto de eliminar el siniestro!  # " + punto,
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Si, eliminar !",
                            closeOnConfirm: false
                        },
                        function() {
                          $.ajax({
                                  url: "/siniestros/delete_drop/" + punto,
                                  data: "id="+punto+"&_token={{ csrf_token()}}",
                                  dataType: "json",
                                  method: "POST",
                                  success: function(result)
                                  {
                                      if (result['result'] != 'ok') // Era ==
                                      {
                                          swal("El siniestro no puede eliminarse !", "Contiene digitalizaciones adjuntas, borrelas antes de poder eliminar el examen...")
                                      }
                                      else
                                      {
                                          swal("Eliminado!", "El siniestro fue eliminado.", "success");

                                          location.reload();
                                      }
                                  },
                                  fail: function(){
                                      swal("Error !", "Contiene digitalizaciones adjuntas, borrelas antes de poder eliminar la novedad...");
                                  },
                                  beforeSend: function(){

                                  }
                              });

                            swal("Eliminado!", "La novedad fue eliminada.", "success");
                        })
                  }
              },
              fail: function(){
                  swal("Error !", "Contiene digitalizaciones adjuntas, borrelas antes de poder eliminar la novedad...");
              },
              beforeSend: function(){

              }
          });

      }


  function showModalEdits(e) {
    var punto = e;
    var id = e;

    $.ajax({
            url: "/siniestros/edit/" + punto,
            data: "id="+punto+"&_token={{ csrf_token()}}",
            dataType: "json",
            method: "GET",
            success: function(result)
            {
                if (result['result'] == 'ok')
                {
                    swal("El siniestro no puede editarse !", "Contiene digitalizaciones adjuntas, borrelas antes de poder eliminar el examen...")
                }
                else
                {
                    //console.log(result);
                    //alert(result.novedad2);
                    var $id = result.id;
                    $("#nid").val(result.id);
                    $("#sin_edit_encarga").val(result.encarga);
                    $("#nro_siniestro_edit").val(result.nro_siniestro);
                    $("#sin_fecha_edit").val(result.fecha);
                    $("#sin_ed_comenta").val(result.detalle);
                    $("#sin-edit").attr("action","/siniestros/edit/" + punto);

                    // alert("/novedadeslist/edit/" + punto);

                    $('#myModalEditS').modal('show');
                }
            },
            fail: function(){
                swal("Error !", "Contiene digitalizaciones adjuntas, borrelas antes de poder eliminar la novedad...");
            },
            beforeSend: function(){

            }
        });
    }




    function showModalEditR(e) {
      //alert(e);
      var punto = e;
      var id = e;

      $.ajax({
              url: "/rto/edit/" + punto,
              data: "id="+punto+"&_token={{ csrf_token()}}",
              dataType: "json",
              method: "GET",
              success: function(result)
              {
                  if (result['result'] == 'ok')
                  {
                      swal("La novedad no puede editarse !", "Contiene digitalizaciones adjuntas, borrelas antes de poder eliminar el examen...")
                  }
                  else
                  {
                      //console.log(result);
                      //alert(result.novedad2);
                      var $id = result.id;
                      $("#nid").val(result.id);
                      $("#legajoEdit").val(result.legajo);
                      $("#ApynomEdit").val(result.detalle);
                      $("#rto_edit_encarga").val(result.encarga);
                      $("#rto_fechaEdit").val(result.fecha);
                      $("#rto_fechaEdit2").val(result.vencimient);
                      $("#rto_ed_comenta").val(result.detalle);

                      $("#myModalEdit").attr("action","/rto/edit/" + punto);

                      // alert("/novedadeslist/edit/" + punto);

                      $('#myModalEdit').modal('show');
                  }
              },
              fail: function(){
                  swal("Error !", "Contiene digitalizaciones adjuntas, borrelas antes de poder eliminar la novedad...");
              },
              beforeSend: function(){

              }
          });

      }


      function showModalrBorrar(e) {
        //alert(e);
        var punto = e;

        $.ajax({
                url: "/rto/delete/" + punto,
                data: "id="+punto+"&_token={{ csrf_token()}}",
                dataType: "json",
                method: "POST",
                success: function(result)
                {
                  if (result['result'] == 'ok')
                    {
                        swal("La R.T.O. no puede eliminarse !", "Contiene digitalizaciones adjuntas, borrelas antes de poder eliminar el examen...")
                    }
                    else
                    {
                        swal({
                              title: "Está seguro(a) ?",
                              text: "Está a punto de eliminar la R.T.O. !  # " + punto,
                              type: "warning",
                              showCancelButton: true,
                              confirmButtonColor: "#DD6B55",
                              confirmButtonText: "Si, eliminar !",
                              closeOnConfirm: false
                          },
                          function() {
                            $.ajax({
                                    url: "/rto/delete_drop/" + punto,
                                    data: "id="+punto+"&_token={{ csrf_token()}}",
                                    dataType: "json",
                                    method: "POST",
                                    success: function(result)
                                    {
                                        if (result['result'] != 'ok') // Era ==
                                        {
                                            swal("La R.T.O. no puede eliminarse !", "Contiene digitalizaciones adjuntas, borrelas antes de poder eliminar el examen...")
                                        }
                                        else
                                        {
                                            swal("Eliminado!", "La R.T.O. fue eliminada.", "success");

                                            location.reload();
                                        }
                                    },
                                    fail: function(){
                                        swal("Error !", "Contiene digitalizaciones adjuntas, borrelas antes de poder eliminar la novedad...");
                                    },
                                    beforeSend: function(){

                                    }
                                });

                              swal("Eliminado!", "La R.T.O. fue eliminada.", "success");
                          })
                    }
                },
                fail: function(){
                    swal("Error !", "Contiene digitalizaciones adjuntas, borrelas antes de poder eliminar la R.T.O. ...");
                },
                beforeSend: function(){

                }
            });

        }



    function showModalmBorrar(e) {
        //alert(e);
        var punto = e;

        $.ajax({
                url: "/rto/delete/" + punto,
                data: "id="+punto+"&_token={{ csrf_token()}}",
                dataType: "json",
                method: "POST",
                success: function(result)
                {
                  if (result['result'] == 'ok')
                    {
                        swal("La R.T.O. no puede eliminarse !", "Contiene digitalizaciones adjuntas, borrelas antes de poder eliminar el examen...")
                    }
                    else
                    {
                        swal({
                              title: "Está seguro(a) ?",
                              text: "Está a punto de eliminar la R.T.O.!  # " + punto,
                              type: "warning",
                              showCancelButton: true,
                              confirmButtonColor: "#DD6B55",
                              confirmButtonText: "Si, eliminar !",
                              closeOnConfirm: false
                          },
                          function() {
                            $.ajax({
                                    url: "/rto/delete_drop/" + punto,
                                    data: "id="+punto+"&_token={{ csrf_token()}}",
                                    dataType: "json",
                                    method: "POST",
                                    success: function(result)
                                    {
                                        if (result['result'] != 'ok') // Era ==
                                        {
                                            swal("La R.T.O. no puede eliminarse !", "Contiene digitalizaciones adjuntas, borrelas antes de poder eliminar el examen...")
                                        }
                                        else
                                        {
                                            swal("Eliminado!", "La R.T.O. fue eliminada.", "success");

                                            location.reload();
                                        }
                                    },
                                    fail: function(){
                                        swal("Error !", "Contiene digitalizaciones adjuntas, borrelas antes de poder eliminar la R.T.O. ...");
                                    },
                                    beforeSend: function(){

                                    }
                                });

                              swal("Eliminado!", "La R.T.O. fue eliminada.", "success");
                          })
                    }
                },
                fail: function(){
                    swal("Error !", "Contiene digitalizaciones adjuntas, borrelas antes de poder eliminar la R.T.O. ...");
                },
                beforeSend: function(){

                }
            });

        }


    function showModalEditT(e) {
      var punto = e;
      var id = e;

      $.ajax({
              url: "/sinies3/edit/" + punto,
              data: "id="+punto+"&_token={{ csrf_token()}}",
              dataType: "json",
              method: "GET",
              success: function(result)
              {
                  if (result['result'] == 'ok')
                  {
                      swal("El siniestro no puede editarse !", "Contiene digitalizaciones adjuntas, borrelas antes de poder eliminar el examen...")
                  }
                  else
                  {
                      //console.log(result);
                      //alert(result.novedad2);
                      var $id = result.id;
                      $("#nid").val(result.id);
                      $("#sint_edit_encarga").val(result.encarga);
                      $("#nro_siniestro_edit").val(result.nro_siniestro);
                      $("#sinT_fecha_edit").val(result.fecha);
                      $("#aseguradora_edit").val(result.cia);
                      $("#estadoT_edit").val(result.estado);
                      $("#sinT_ed_comenta").val(result.detalle);
                      $("#sinT-edit").attr("action","/sinies3/edit/" + punto);

                      //alert("/sinies3/edit/" + punto);

                      $('#myModalEditT').modal('show');
                  }
              },
              fail: function(){
                  swal("Error !", "Contiene digitalizaciones adjuntas, borrelas antes de poder eliminar la novedad...");
              },
              beforeSend: function(){

              }
          });

      }


    function showModaltBorrar(e) {

        //alert(e);
        var punto = e;

        $.ajax({
                url: "/sinies3/delete/" + punto,
                data: "id="+punto+"&_token={{ csrf_token()}}",
                dataType: "json",
                method: "POST",
                success: function(result)
                {
                  if (result['result'] == 'ok')
                    {
                        swal("El siniestro recibido no puede eliminarse !", "Contiene digitalizaciones adjuntas, borrelas antes de poder eliminar el examen...")
                    }
                    else
                    {
                        swal({
                              title: "Está seguro(a) ?",
                              text: "Está a punto de eliminar el siniestro recibido!  # " + punto,
                              type: "warning",
                              showCancelButton: true,
                              confirmButtonColor: "#DD6B55",
                              confirmButtonText: "Si, eliminar !",
                              closeOnConfirm: false
                          },
                          function() {
                            $.ajax({
                                    url: "/sinies3/delete_drop/" + punto,
                                    data: "id="+punto+"&_token={{ csrf_token()}}",
                                    dataType: "json",
                                    method: "POST",
                                    success: function(result)
                                    {
                                        if (result['result'] != 'ok') // Era ==
                                        {
                                            swal("El siniestro recibido no puede eliminarse !", "Contiene digitalizaciones adjuntas, borrelas antes de poder eliminar el examen...")
                                        }
                                        else
                                        {
                                            swal("Eliminado!", "El siniestro recibido fue eliminado.", "success");

                                            location.reload();
                                        }
                                    },
                                    fail: function(){
                                        swal("Error !", "Contiene digitalizaciones adjuntas, borrelas antes de poder eliminar el siniestro recibido...");
                                    },
                                    beforeSend: function(){

                                    }
                                });

                              swal("Eliminado!", "La novedad fue eliminada.", "success");
                          })
                    }
                },
                fail: function(){
                    swal("Error !", "Contiene digitalizaciones adjuntas, borrelas antes de poder eliminar la novedad...");
                },
                beforeSend: function(){

                }
            });

        }


    function showModalEditm(e) {
      var punto = e;
      var id = e;

      $.ajax({
              url: "/multas/edit/" + punto,
              data: "id="+punto+"&_token={{ csrf_token()}}",
              dataType: "json",
              method: "GET",
              success: function(result)
              {
                  if (result['result'] == 'ok')
                  {
                      swal("La multa no puede editarse !", "Contiene digitalizaciones adjuntas, borrelas antes de poder eliminar ...")
                  }
                  else
                  {
                      //console.log(result);
                      //alert(result.novedad2);
                      var $id = result.id;
                      $("#nid").val(result.id);
                      $("#multa_edit_encarga").val(result.encarga);
                      $("#multa_ed_importe").val(result.importe);
                      $("#multa_fecha_edit").val(result.fecha);
                      $("#multa_ed_fecha_pgo").val(result.fecha_pago);
                      $("#multa_ed_comenta").val(result.detalle);
                      $("#multa_ed_form").attr("action","/multas/edit/" + punto);

                      // alert("/novedadeslist/edit/" + punto);

                      $('#myModalEditM').modal('show');
                  }
              },
              fail: function(){
                  swal("Error !", "Contiene digitalizaciones adjuntas, borrelas antes de poder eliminar la multa ...");
              },
              beforeSend: function(){

              }
          });

      }


      function showModalmBorrar(e) {
          //alert(e);
          var punto = e;

          $.ajax({
                  url: "/multas/delete/" + punto,
                  data: "id="+punto+"&_token={{ csrf_token()}}",
                  dataType: "json",
                  method: "POST",
                  success: function(result)
                  {
                    if (result['result'] == 'ok')
                      {
                          swal("La multa no puede eliminarse !", "Contiene digitalizaciones adjuntas, borrelas antes de poder eliminar el examen...")
                      }
                      else
                      {
                          swal({
                                title: "Está seguro(a) ?",
                                text: "Está a punto de eliminar la multa!  # " + punto,
                                type: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "Si, eliminar !",
                                closeOnConfirm: false
                            },
                            function() {
                              $.ajax({
                                      url: "/multas/delete_drop/" + punto,
                                      data: "id="+punto+"&_token={{ csrf_token()}}",
                                      dataType: "json",
                                      method: "POST",
                                      success: function(result)
                                      {
                                          if (result['result'] != 'ok') // Era ==
                                          {
                                              swal("La multa no puede eliminarse !", "Contiene digitalizaciones adjuntas, borrelas antes de poder eliminar el examen...")
                                          }
                                          else
                                          {
                                              swal("Eliminado!", "La multa fue eliminada.", "success");

                                              location.reload();
                                          }
                                      },
                                      fail: function(){
                                          swal("Error !", "Contiene digitalizaciones adjuntas, borrelas antes de poder eliminar la multa ...");
                                      },
                                      beforeSend: function(){

                                      }
                                  });

                                swal("Eliminado!", "La multa fue eliminada.", "success");
                            })
                      }
                  },
                  fail: function(){
                      swal("Error !", "Contiene digitalizaciones adjuntas, borrelas antes de poder eliminar la multa...");
                  },
                  beforeSend: function(){

                  }
              });

          }


      function showModalEditbaja(e) {
        var punto = e;
        var id = e;

        $.ajax({
                url: "/baja_venta/edit/" + punto,
                data: "id="+punto+"&_token={{ csrf_token()}}",
                dataType: "json",
                method: "GET",
                success: function(result)
                {
                    if (result['result'] == 'ok')
                    {
                        swal("La multa no puede editarse !", "Contiene digitalizaciones adjuntas, borrelas antes de poder eliminar ...")
                    }
                    else
                    {
                        //console.log(result);
                        //alert(result.novedad2);
                        var $id = result.id;
                        $("#nid").val(result.id);
                        $("#ventas_ed_fecha").val(result.fecha);
                        $("#ventas_ed_tipo").val(result.tipo_baja);
                        $("#ventas_ed_detalle").val(result.detalle);
                        $("#ventas_ed_form").attr("action","/baja_venta/edit/" + $id);

                        // alert("/novedadeslist/edit/" + punto);

                        $('#myModalbajaedit').modal('show');
                    }
                },
                fail: function(){
                    swal("Error !", "Contiene digitalizaciones adjuntas, borrelas antes de poder eliminar la multa ...");
                },
                beforeSend: function(){

                }
            });

      }

      //----------------------------------
      //    Modificacion de comprador
      //----------------------------------
      function showModalEditcomprador(e) {
        var punto = e;
        var id = e;

        $.ajax({
                url: "/comprador/edit/" + punto,
                data: "id="+punto+"&_token={{ csrf_token()}}",
                dataType: "json",
                method: "GET",
                success: function(result)
                {
                    if (result['result'] == 'ok')
                    {
                        swal("La multa no puede editarse !", "Contiene digitalizaciones adjuntas, borrelas antes de poder eliminar ...")
                    }
                    else
                    {
                        //console.log(result);

                        var $id = result.id;
                        $("#nid").val(result.id);
                        $("#comprador_ed").val(result.comprador);
                        $("#domic_ed").val(result.domic);
                        $("#email_ed").val(result.email);
                        $("#telefono_ed1").val(result.telefono1);
                        $("#telefono_ed2").val(result.telefono2);
                        $("#comprad_ed_form").attr("action","/comprador/edit/" + $id);

                        $('#myModalCompradoredit').modal('show');
                    }
                },
                fail: function(){
                    swal("Error !", "Contiene digitalizaciones adjuntas, borrelas antes de poder eliminar la multa ...");
                },
                beforeSend: function(){

                }
            });

        }

      //------------------------------------------
      // Modificacion de libre deudas de multas
      //------------------------------------------
      function showModalEditlibreDM(e) {
        var punto = e;
        var id = e;

        $.ajax({
                url: "/libredmultas/edit/" + punto,
                data: "id="+punto+"&_token={{ csrf_token()}}",
                dataType: "json",
                method: "GET",
                success: function(result)
                {
                    if (result['result'] == 'ok')
                    {
                        swal("El libre deuda de multas no puede editarse !", "Contiene digitalizaciones adjuntas, borrelas antes de poder eliminar ...")
                    }
                    else
                    {
                        //console.log(result);

                        var $id = result.id;
                        $("#nid").val(result.id);
                        $("#libredm_ed_fecha").val(result.fecha);
                        $("#libredm_ed_detalle").val(result.detalle);
                        $("#libredm_ed_form").attr("action","/libredmultas/edit/" + $id);

                        $('#myModalLibreDM_ed').modal('show');
                    }
                },
                fail: function(){
                    swal("Error !", "Contiene digitalizaciones adjuntas, borrelas antes de poder eliminar el libre deuda de multas ...");
                },
                beforeSend: function(){

                }
            });

        }

      function showmyModalfactura(e) {
         var punto = e;
         var id = e;

         $.ajax({
                 url: "/factura/edit/" + punto,
                 data: "id="+punto+"&_token={{ csrf_token()}}",
                 dataType: "json",
                 method: "GET",
                 success: function(result)
                 {
                     if (result['result'] == 'ok')
                     {
                         swal("La factura no puede editarse !", "Contiene digitalizaciones adjuntas, borrelas antes de poder eliminar ...")
                     }
                     else
                     {
                         //console.log(result);

                         var $id = result.id;
                         $("#nid").val(result.id);
                         $("#libredm_ed_fecha").val(result.fecha);
                         $("#libredm_ed_detalle").val(result.detalle);
                         $("#libredm_ed_form").attr("action","/factura/edit/" + $id);

                         $('#myModalLibreDM_ed').modal('show');
                     }
                 },
                 fail: function(){
                     swal("Error !", "Contiene digitalizaciones adjuntas, borrelas antes de poder eliminar la factura ...");
                 },
                 beforeSend: function(){

                 }
             });
      }


      //------------------------------------------
      // Modificacion de libre deudas de multas
      //------------------------------------------
      function showModalEditlibreDP(e) {
        var punto = e;
        var id = e;

        $.ajax({
                url: "/libredpatente/edit/" + punto,
                data: "id="+punto+"&_token={{ csrf_token()}}",
                dataType: "json",
                method: "GET",
                success: function(result)
                {
                    if (result['result'] == 'ok')
                    {
                        swal("El libre deuda de patente no puede editarse !", "Contiene digitalizaciones adjuntas, borrelas antes de poder eliminar ...")
                    }
                    else
                    {
                        //console.log(result);

                        var $id = result.id;
                        $("#nid").val(result.id);
                        $("#libredp_ed_fecha").val(result.fecha);
                        $("#libredp_ed_detalle").val(result.detalle);
                        $("#libredp_ed_form").attr("action","/libredpatente/edit/" + $id);

                        $('#myModalLibreDP_ed').modal('show');
                    }
                },
                fail: function(){
                    swal("Error !", "Contiene digitalizaciones adjuntas, borrelas antes de poder eliminar el libre deuda de patente ...");
                },
                beforeSend: function(){

                }
            });

        }


        //------------------------------------------
        // Modificacion de libre deudas de multas
        //------------------------------------------
        function showModalEditlibreDP(e) {
          var punto = e;
          var id = e;

          $.ajax({
                  url: "/libredpatente/edit/" + punto,
                  data: "id="+punto+"&_token={{ csrf_token()}}",
                  dataType: "json",
                  method: "GET",
                  success: function(result)
                  {
                      if (result['result'] == 'ok')
                      {
                          swal("El libre deuda de patente no puede editarse !", "Contiene digitalizaciones adjuntas, borrelas antes de poder eliminar ...")
                      }
                      else
                      {
                          //console.log(result);

                          var $id = result.id;
                          $("#nid").val(result.id);
                          $("#libredp_ed_fecha").val(result.fecha);
                          $("#libredp_ed_detalle").val(result.detalle);
                          $("#libredp_ed_form").attr("action","/libredpatente/edit/" + $id);

                          $('#myModalLibreDP_ed').modal('show');
                      }
                  },
                  fail: function(){
                      swal("Error !", "Contiene digitalizaciones adjuntas, borrelas antes de poder eliminar el libre deuda de patente ...");
                  },
                  beforeSend: function(){

                  }
              });

          }


        //------------------------------------------
        // Modificacion de Infome de Dominio
        //------------------------------------------
        function showModalEditDominio(e) {
          var punto = e;
          var id = e;

          $.ajax({
                  url: "/dominio/edit/" + punto,
                  data: "id="+punto+"&_token={{ csrf_token()}}",
                  dataType: "json",
                  method: "GET",
                  success: function(result)
                  {
                      if (result['result'] == 'ok')
                      {
                          swal("El informe de dominio no puede editarse !", "Contiene digitalizaciones adjuntas, borrelas antes de poder eliminar ...")
                      }
                      else
                      {
                          //console.log(result);

                          var $id = result.id;
                          $("#nid").val(result.id);
                          $("#dominio_ed_fecha").val(result.fecha);
                          $("#dominio_ed_detalle").val(result.detalle);
                          $("#dominio_ed_form").attr("action","/dominio/edit/" + $id);

                          $('#myModalDominioEdit').modal('show');
                      }
                  },
                  fail: function(){
                      swal("Error !", "Contiene digitalizaciones adjuntas, borrelas antes de poder eliminar el informe de dominio...");
                  },
                  beforeSend: function(){

                  }
              });

          }



        //------------------------------------------
        // Modificacion de Denuncia de venta
        //------------------------------------------
        function showModalEditDenuncia(e) {
          var punto = e;
          var id = e;

          $.ajax({
                  url: "/denuncia/edit/" + punto,
                  data: "id="+punto+"&_token={{ csrf_token()}}",
                  dataType: "json",
                  method: "GET",
                  success: function(result)
                  {
                      if (result['result'] == 'ok')
                      {
                          swal("La denuncia de venta no puede editarse !", "Contiene digitalizaciones adjuntas, borrelas antes de poder eliminar ...")
                      }
                      else
                      {
                          //console.log(result);

                          var $id = result.id;
                          $("#nid").val(result.id);
                          $("#denuncia_ed_fecha").val(result.fecha);
                          $("#denuncia_ed_detalle").val(result.detalle);
                          $("#denuncia_ed_form").attr("action","/denuncia/edit/" + $id);

                          $('#myModalDenunciaEdit').modal('show');
                      }
                  },
                  fail: function(){
                      swal("Error !", "Contiene digitalizaciones adjuntas, borrelas antes de poder eliminar la denuncia de ventas...");
                  },
                  beforeSend: function(){

                  }
              });

          }



        //------------------------------------------
        // Modificacion de Denuncia de venta
        //------------------------------------------
        function showModalEditPolicial(e) {
          var punto = e;
          var id = e;

          $.ajax({
                  url: "/policial/edit/" + punto,
                  data: "id="+punto+"&_token={{ csrf_token()}}",
                  dataType: "json",
                  method: "GET",
                  success: function(result)
                  {
                      if (result['result'] == 'ok')
                      {
                          swal("La Verificación policial no puede editarse !", "Contiene digitalizaciones adjuntas, borrelas antes de poder eliminar ...")
                      }
                      else
                      {
                          //console.log(result);

                          var $id = result.id;
                          $("#nid").val(result.id);
                          $("#policial_ed_fecha").val(result.fecha);
                          $("#policial_ed_detalle").val(result.detalle);
                          $("#policial_ed_form").attr("action","/policial/edit/" + $id);

                          $('#myModalPolicialEdit').modal('show');
                      }
                  },
                  fail: function(){
                      swal("Error !", "Contiene digitalizaciones adjuntas, borrelas antes de poder eliminar la Verificación Policial...");
                  },
                  beforeSend: function(){

                  }
              });

          }



        //------------------------------------------
        // Modificacion de form. CETA
        //------------------------------------------
        function showModalEditCeta(e) {
          var punto = e;
          var id = e;

          $.ajax({
                  url: "/ceta/edit/" + punto,
                  data: "id="+punto+"&_token={{ csrf_token()}}",
                  dataType: "json",
                  method: "GET",
                  success: function(result)
                  {
                      if (result['result'] == 'ok')
                      {
                          swal("El formulario CETA no puede editarse !", "Contiene digitalizaciones adjuntas, borrelas antes de poder eliminar ...")
                      }
                      else
                      {
                          //console.log(result);

                          var $id = result.id;
                          $("#nid").val(result.id);
                          $("#ceta_ed_fecha").val(result.fecha);
                          $("#ceta_ed_detalle").val(result.detalle);
                          $("#ceta_ed_form").attr("action","/ceta/edit/" + $id);

                          $('#myModalCetaEdit').modal('show');
                      }
                  },
                  fail: function(){
                      swal("Error !", "Contiene digitalizaciones adjuntas, borrelas antes de poder eliminar el form. CETA ...");
                  },
                  beforeSend: function(){

                  }
              });

          }


        //------------------------------------------
        //       Confirmacion de Vta
        //------------------------------------------
        function confirmarVenta(e) {
          var punto = e;
          var id = e;

          $.ajax({
                  url: "/vender/" + punto,
                  data: "id="+punto+"&_token={{ csrf_token()}}",
                  dataType: "json",
                  method: "POST",
                  success: function(result)
                  {
                    if (result['result'] == 'ok')
                      {
                          swal("No se puede confirmar la venta del vehiculo !", "Contiene datos pendientes o incorrectos, corrijalos antes de poder confirmarla ...")
                      }
                      else
                      {
                          swal({
                                title: "Está seguro(a) de cerrar la venta ?",
                                text: "Está a punto de confirmar la venta del vehículo!  # " + punto,
                                type: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "Si, confirmar !",
                                closeOnConfirm: false
                            },
                            function() {
                              $.ajax({
                                      url: "/vender/confirmar/" + punto,
                                      data: "id="+punto+"&_token={{ csrf_token()}}",
                                      dataType: "json",
                                      method: "POST",
                                      success: function(result)
                                      {
                                          if (result['result'] != 'ok') // Era ==
                                          {
                                              swal("El vehículo no puede venderse !", "Contiene datos pendientes, borrelas antes de poder continuar...")
                                          }
                                          else
                                          {
                                              swal("Eliminado!", "El vehículo fue eliminado.", "success");

                                              location.reload();
                                          }
                                      },
                                      fail: function(){
                                          swal("Error !", "Existen datos pendientes, antes de poder realizar la venta ...");
                                      },
                                      beforeSend: function(){

                                      }
                                  });

                                swal("Eliminado!", "El Vehiculo fue vendido.", "success");
                            })
                      }
                  },
                  fail: function(){
                      swal("Error !", "Contiene digitalizaciones adjuntas, borrelas antes de poder eliminar la novedad...");
                  },
                  beforeSend: function(){

                  }
              });

          }


        //------------------------------------------
        // Modificacion de form. CETA
        //------------------------------------------
        function showModalEditF381(e) {
          var punto = e;
          var id = e;

          $.ajax({
                  url: "/f381/edit/" + punto,
                  data: "id="+punto+"&_token={{ csrf_token()}}",
                  dataType: "json",
                  method: "GET",
                  success: function(result)
                  {
                      if (result['result'] == 'ok')
                      {
                          swal("El formulario CETA no puede editarse !", "Contiene digitalizaciones adjuntas, borrelas antes de poder eliminar ...")
                      }
                      else
                      {
                          //console.log(result);

                          var $id = result.id;
                          $("#nid").val(result.id);
                          $("#f381_ed_fecha").val(result.fecha);
                          $("#f381_ed_detalle").val(result.detalle);
                          $("#f381_ed_form").attr("action","/f381/edit/" + $id);

                          $('#myModalF381Edit').modal('show');
                      }
                  },
                  fail: function(){
                      swal("Error !", "Contiene digitalizaciones adjuntas, borrelas antes de poder eliminar el form. CETA ...");
                  },
                  beforeSend: function(){

                  }
              });

          }

        //------------------------------------------
        // Modificacion de Denuncia de venta
        //------------------------------------------
        function showModalEditDNRPA(e) {
          var punto = e;
          var id = e;

          $.ajax({
                  url: "/dnrpa/edit/" + punto,
                  data: "id="+punto+"&_token={{ csrf_token()}}",
                  dataType: "json",
                  method: "GET",
                  success: function(result)
                  {
                      if (result['result'] == 'ok')
                      {
                          swal("El Formulario F13 no puede editarse !", "Contiene digitalizaciones adjuntas, borrelas antes de poder eliminar ...")
                      }
                      else
                      {
                          //console.log(result);

                          var $id = result.id;
                          $("#nid").val(result.id);
                          $("#dnrpa_ed_fecha").val(result.fecha);
                          $("#dnrpa_ed_detalle").val(result.detalle);
                          $("#dnrpa_ed_form").attr("action","/dnrpa/edit/" + $id);

                          $('#myModalDNRPAEdit').modal('show');
                      }
                  },
                  fail: function(){
                      swal("Error !", "Contiene digitalizaciones adjuntas, borrelas antes de poder eliminar la Verificación Policial...");
                  },
                  beforeSend: function(){

                  }
              });

          }


        //------------------------------------------
        //       Confirmacion de Baja
        //------------------------------------------
        function confirmarBaja(e) {
          var punto = e;
          var id = e;

          $.ajax({
                  url: "/baja_otros/" + punto,
                  data: "id="+punto+"&_token={{ csrf_token()}}",
                  dataType: "json",
                  method: "POST",
                  success: function(result)
                  {
                    if (result['result'] == 'ok')
                      {
                          swal("No se puede confirmar la baja del vehiculo !", "Contiene datos pendientes o incorrectos, corrijalos antes de poder confirmarla ...")
                      }
                      else
                      {
                          swal({
                                title: "Está seguro(a)?",
                                text: "Está a punto de confirmar la baja del vehículo!  # " + punto,
                                type: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "Si, confirmar !",
                                closeOnConfirm: false
                            },
                            function() {
                              $.ajax({
                                      url: "/baja_otros/confirmar/" + punto,
                                      data: "id="+punto+"&_token={{ csrf_token()}}",
                                      dataType: "json",
                                      method: "POST",
                                      success: function(result)
                                      {
                                          if (result['result'] != 'ok') // Era ==
                                          {
                                              swal("El vehículo no puede ser dado de Baja !", "Contiene datos pendientes, borrelas antes de poder continuar...")
                                          }
                                          else
                                          {
                                              swal("Eliminado!", "El vehículo fue eliminado.", "success");

                                              location.reload();
                                          }
                                      },
                                      fail: function(){
                                          swal("Error !", "Existen datos pendientes, antes de poder eliminar la novedad...");
                                      },
                                      beforeSend: function(){

                                      }
                                  });

                                swal("Eliminado!", "El Vehiculo fue vendido.", "success");
                            })
                      }
                  },
                  fail: function(){
                      swal("Error !", "Contiene digitalizaciones adjuntas, borrelas antes de poder eliminar la novedad...");
                  },
                  beforeSend: function(){

                  }
              });

          }
</script>

<!-- SWEET ALERT-->
<!-- <script src="/vendor/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{ asset('js/sweetalert.min.js') }}"></script>-->
<script src="/vendor/sweetalert/dist/sweetalert.min.js"></script>

@endsection

@include('novedadeslist.sini3-create')
@include('novedadeslist.sini3-edit')
@include('novedadeslist.rto-create')
@include('novedadeslist.rto-edit')
@include('novedadeslist.multa-create')
@include('novedadeslist.multa-edit')
@include('novedadeslist.sini-create')
@include('novedadeslist.sini-edit')
@include('novedadeslist.baja-create')
@include('novedadeslist.baja-edit')
@include('novedadeslist.comprador-create')
@include('novedadeslist.comprador-edit')
@include('novedadeslist.libredm-create')
@include('novedadeslist.libredm-edit')
@include('novedadeslist.libredp-create')
@include('novedadeslist.libredp-edit')
@include('novedadeslist.dominio-create')
@include('novedadeslist.dominio-edit')
@include('novedadeslist.denuncia-create')
@include('novedadeslist.denuncia-edit')
@include('novedadeslist.policial-create')
@include('novedadeslist.policial-edit')
@include('novedadeslist.ceta-create')
@include('novedadeslist.ceta-edit')
@include('novedadeslist.f381-create')
@include('novedadeslist.f381-edit')
@include('novedadeslist.dnrpa-create')
@include('novedadeslist.dnrpa-edit')
@include('novedadeslist.factura-create')
