<?php
  # Iniciando la variable de control que permitirá mostrar o no el modal
  if (isset($_GET['exibirModal'])) {
    $exibirModal = $_REQUEST['exibirModal'];

  }

  if(!isset($exibirModal)) {
    $exibirModal = "false";
  }
?>

@extends('layouts.app')

@section('styles')
    <!-- SWEET ALERT-->
    <link rel="stylesheet" href="/vendor/sweetalert/dist/sweetalert.css">
@endsection

@section('content')

   <!-- Page content-->
   <div class="content-heading">
      <div>Registracion de Novedades por lista
         <small></small>
      </div>
   </div>
   <div class="row">
      <div class="col-lg-12">
        <fieldset>
            <div class="col-lg-3 mb-3">
                <label class="control-label" for="input-id-1">Período</label>
                <div class="input-group " id="nro_legajo" data-provide=""
                    keyboardNavigation="false" title="Seleccione el período a visualizar">
                    <input class="form-control" id="input-id-1" type="text" value="{{ $novedades->periodo }}"
                        style="width: 50px" readonly>

                    <span class="input-group-append input-group-addon">
                      <a href="/novedadeslist/{{ $periodo?$periodo->id:'' }}/-1" class="input-group-text fa fa-chevron-left"></a>
                    </span>
                    <span class="input-group-append input-group-addon">
                      <a href="/novedadeslist/{{ $periodo?$periodo->id:'' }}/1" class="input-group-text fa fa-chevron-right"></a>
                    </span>
                    <span class="input-group-append input-group-addon">
                      <a href="/periodos/2/search2" class="input-group-text fa fa-search"></a>
                    </span>
                </div>
            </div>

         </fieldset>

         <!-- START card-->
         <div class="card card-default">

            <!-- <div class="card-header">
               <a class="float-right" href="#" data-tool="panel-refresh" data-toggle="tooltip" title="Refresh Card">
                  <em class="fa fa-refresh"></em>
               </a>Search Results</div>
            -->

            <!-- START table-responsive-->
            <div class="table-responsive">
               <table class="table table-striped table-bordered table-hover">
                  <thead>
                    <th>
                      <strong>Fecha</strong>
                    </th>
                    <th>
                      <strong>Legajo</strong>
                    </th>
                    <th>
                      <strong>Apellido y Nombre</strong>
                    </th>
                    <th>
                      <strong>
                        Sector
                      </strong>
                    </th>
                    <th>
                      <strong>
                        Cod.Novedad
                      </strong>
                    </th>
                    <th>
                      <strong>
                        Descripción
                      </strong>
                    </th>
                    <th>
                      <strong>
                        Cantidad
                      </strong>
                    </th>
                    <th>
                      <strong>
                        Comentarios
                      </strong>
                    </th>
                    <th width="1%"></th>
                    <th></th>
                    <th></th>
                  </thead>
                  <tbody>
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
                                      {{ $novedad?$novedad->legajo :'' }}
                                   </div>
                                </div>
                             </div>
                          </td>

                          <td>
                             <div class="media align-items-center">
                                <div class="media-body d-flex">
                                   <div>
                                      {{ $novedad?$novedad->Apynom:'' }}
                                   </div>

                                </div>
                             </div>
                          </td>

                          <td>
                             <div class="media align-items-center">
                                <div class="media-body d-flex">
                                   <div>
                                      {{ $novedad?$novedad->NomSector :'' }}
                                   </div>

                                </div>
                             </div>
                          </td>

                          <td>
                             <div class="media align-items-center">
                                <div class="media-body d-flex">
                                   <div>
                                      {{ $novedad?$novedad->cod_nov:'' }}
                                   </div>

                                </div>
                             </div>
                          </td>

                          <td>
                             <div class="media align-items-center">
                                <div class="media-body d-flex">
                                   <div>
                                      {{ $novedad?$novedad->CodNovName:'' }}
                                   </div>

                                </div>
                             </div>
                          </td>

                          <td>
                             <div class="media align-items-center">
                                <div class="media-body d-flex">
                                   <div>
                                      {{ $novedad?$novedad->cantidad:'' }}
                                   </div>

                                </div>
                             </div>
                          </td>

                          <td>
                             <div class="media align-items-center">
                                <div class="media-body d-flex">
                                   <div>
                                      {{ $novedad?$novedad->comenta1:'' }}
                                   </div>

                                </div>
                             </div>
                          </td>

                          <td>
                            <div class="ml-auto">
                              <button title="Consultar novedad" class="btn btn-info btn-sm" style="color: white" name="btnAgregar" id="btnAgregar"
                                type="button" data-toggle="modal" data-target="#myModalEdit">
                                <em class="fa fa-eye"></em></a>
                            </div>
                          </td>

                          <td>
                            <div class="ml-auto">
                               <a title="Editar novedad" class="btn btn-warning btn-sm" onclick="showModalEdit({{ $novedad->id }})">
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
                               <a title="Borrar novedad" class="btn btn-danger btn-sm" onclick="showModal({{ $novedad->id }})">
                                 <em class="fa fa-trash" style="color: white"></em></a>
                               <!-- <button type="button" data-product_id="{{ $novedad->id }}" data-product_name="{{ $novedad->name }}" class="btn btn-xs btn-default btn-flat" data-toggle="modal" data-target="#confirmDelete"><i class="fa fa-trash"></i></button> -->
                               <!--<a title="Borrar novedad" class="btn btn-danger btn-sm" onclick="showModal({{ $novedad->id }})">
                                 <em class="fa fa-trash" style="color: red"></em>
                               </a> -->
                            </div>
                          </td>

                        </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
            <!-- END table-responsive-->
            <div class="card-footer">
               <div class="d-flex">
                  <button class="btn btn-warning btn-lg" name="btnAgregar" id="btnAgregar"
                    type="button" data-toggle="modal" data-target="#myModalLarge">
                    <em class="fa fa-sticky-note"></em>
                     Agregar...
                  </button>

                  <!-- <a href="#myModalLarge" data-toggle="modal" name="modal1" id="modal1" >abrir</a> -->

                  <nav class="ml-auto">
                     <ul class="pagination pagination-sm">
                        {{ $novedades->links() }}
                     </ul>
                  </nav>
               </div>

               <fieldset></fieldset>
                <div class="row">
                   <div class="col-lg-8">
                     <fieldset>
                      <div class="form-group mb-4">
                         <input class="form-control mb-2" type="text" placeholder="Texto a buscar...">
                         <div class="d-flex">
                            <button class="btn btn-secondary" type="button">Buscar</button>
                            <div class="ml-auto">
                               <label class="c-checkbox">
                                  <input id="inlineCheckbox10" type="checkbox" value="option1" checked>
                                  <span class="fa fa-check"></span>Ver Novedades</label>
                               <label class="c-checkbox">
                                  <input id="inlineCheckbox20" type="checkbox" value="option2" checked>
                                  <span class="fa fa-check"></span>Ver Adelantos</label>
                               <label class="c-checkbox">
                                  <input id="inlineCheckbox30" type="checkbox" value="option3" checked>
                                  <span class="fa fa-check"></span>Ver Horas extras</label>
                            </div>
                         </div>
                      </div>
                    </fieldset>
                    </div>
                  </div>

              </div>

         </div>
         <!-- END card-->
      </div>
      <!--
      <div class="col-lg-3">
         <h3 class="m-0 pb-3">Filters</h3>
         <div class="form-group mb-4">
            <label class="col-form-label mb-2">by Text</label>
            <br>
            <select class="chosen-select form-control">
               <optgroup label="NFC EAST">
                  <option>Dallas Cowboys</option>
                  <option>New York Giants</option>
                  <option>Philadelphia Eagles</option>
                  <option>Washington Redskins</option>
               </optgroup>
               <optgroup label="NFC NORTH">
                  <option>Chicago Bears</option>
                  <option>Detroit Lions</option>
                  <option>Green Bay Packers</option>
                  <option>Minnesota Vikings</option>
               </optgroup>
               <optgroup label="NFC SOUTH">
                  <option>Atlanta Falcons</option>
                  <option>Carolina Panthers</option>
                  <option>New Orleans Saints</option>
                  <option>Tampa Bay Buccaneers</option>
               </optgroup>
               <optgroup label="NFC WEST">
                  <option>Arizona Cardinals</option>
                  <option>St. Louis Rams</option>
                  <option>San Francisco 49ers</option>
                  <option>Seattle Seahawks</option>
               </optgroup>
               <optgroup label="AFC EAST">
                  <option>Buffalo Bills</option>
                  <option>Miami Dolphins</option>
                  <option>New England Patriots</option>
                  <option>New York Jets</option>
               </optgroup>
               <optgroup label="AFC NORTH">
                  <option>Baltimore Ravens</option>
                  <option>Cincinnati Bengals</option>
                  <option>Cleveland Browns</option>
                  <option>Pittsburgh Steelers</option>
               </optgroup>
               <optgroup label="AFC SOUTH">
                  <option>Houston Texans</option>
                  <option>Indianapolis Colts</option>
                  <option>Jacksonville Jaguars</option>
                  <option>Tennessee Titans</option>
               </optgroup>
               <optgroup label="AFC WEST">
                  <option>Denver Broncos</option>
                  <option>Kansas City Chiefs</option>
                  <option>Oakland Raiders</option>
                  <option>San Diego Chargers</option>
               </optgroup>
            </select>
         </div>
         <div class="form-group">
            <label class="col-form-label mb-2">by Date</label>
            <br>
            <div class="input-group date" id="datetimepicker">
               <input class="form-control" type="text">
               <span class="input-group-append input-group-addon">
                  <span class="input-group-text fa fa-calendar"></span>
               </span>
            </div>
         </div>
         <div class="form-group mb-4">
            <label class="col-form-label mb-2">by Range</label>
            <br>
            <div class="slider-fw">
               <input class="slider" id="sl2" data-ui-slider="" type="text" value="" data-slider-min="10" data-slider-max="1000" data-slider-step="5" data-slider-value="[250,750]">
            </div>
         </div>
         <button class="btn btn-secondary btn-lg">Apply</button>
      </div> -->
   </div>

@endsection

@section('scripts')
    <?php if($exibirModal === "true") : // Si nuestra variable de control "$exibirModal" es igual a TRUE activa nuestro modal y será visible a nuestro usuario. ?>
      <script>
      $(document).ready(function()
      {
        // id de nuestro modal
        $("#myModalLarge").modal("show");
      });
    </script>
    <?php endif; ?>


    <!-- Gestion de errores -->
    <script type="text/javascript">
    @if (count($errors) > 0)
        $('#register').modal('show');
    @endif
    </script>


    <script>
        // Funcion que se ejecuta cada vez que se pulsa una tecla en cualquier input
        // Tiene que recibir el "event" (evento generado) y el siguiente id donde poner
        // el foco. Si ese id es "submit" se envia el formulario
        function saltar(e,id)
        {
         // Obtenemos la tecla pulsada
         (e.keyCode)?k=e.keyCode:k=e.which;

         // Si la tecla pulsada es enter (codigo ascii 13)
         if(k==13)
         {
           // Si la variable id contiene "submit" enviamos el formulario
           if(id=="submit")
           {
             document.forms[0].submit();
           }else{
             // nos posicionamos en el siguiente input
             document.getElementById(id).focus();
           }
         }
        }

        // Funcion que se carga al comienzo usado en easyAutocomplete
        $(document).ready(function () {
             var options = {
                 url: "/autocomplete/novedades",
                 getValue: "codigo",
                 template: {
                     type: "description",
                     fields: {
                         description: "detalle"
                     }
                 },
                 list: {
                     onSelectItemEvent: function() {
                       var value1 = $("#cod_nov").getSelectedItemData().codigo;
                       var value2 = $("#cod_nov").getSelectedItemData().detalle;

                       $("#cod_nov").val(value1).trigger("change");
                       $("#CodNovName").val(value2).trigger("change");
                     },
                     match: {
                         enabled: true
                     }
                 },
                 theme: "bootstrap",
             };
             var optionsAjax = {
                 url: "/autocomplete/novedades",
                 getValue: "codigo",
                 template: {
                     type: "description",
                     fields: {
                         description: "detalle"
                     }
                 },
                 list: {
                   onSelectItemEvent: function() {
                     var value1 = $("#cod_nov").getSelectedItemData().detalle;
                     var value2 = $("#cod_nov").getSelectedItemData().nombres;

                     $("#ape_nom").val(value1).trigger("change");
                     $("#detalle").val(value1).trigger("change");
                   },
                     match: {
                         enabled: true
                     }
                 },
                 theme: "bootstrap",
                 ajaxSettings: {
                     dataType: "json",
                     method: "GET",
                     data: {
                     }
                 },
                 preparePostData: function(data) {
                     data.term = $("#cod_nov").val();
                     return data;
                 },
                 requestDelay: 500
             };
             $("#cod_nov").easyAutocomplete(options);
         });
    </script>

    <script type="text/javascript">
      @if (count($errors) > 0)
          $('#myModalLarge').modal('show');
      @endif
    </script>


    <!-- SWEET ALERT-->
    <script src="/vendor/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        function showModal(e) {

          //alert(e);
          var punto = e;

          $.ajax({
                  url: "/novedadeslist/delete/" + punto,
                  data: "id="+punto+"&_token={{ csrf_token()}}",
                  dataType: "json",
                  method: "POST",
                  success: function(result)
                  {
                      if (result['result'] == 'ok')
                      {
                          swal("La novedad no puede eliminarse !", "Contiene digitalizaciones adjuntas, borrelas antes de poder eliminar el examen...")
                      }
                      else
                      {
                          swal({
                                title: "Está seguro(a) ?",
                                text: "Está a punto de eliminar la novedad!",
                                type: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "Si, eliminar !",
                                closeOnConfirm: false
                            },
                            function() {
                              $.ajax({
                                      url: "/novedadeslist/delete_drop/" + punto,
                                      data: "id="+punto+"&_token={{ csrf_token()}}",
                                      dataType: "json",
                                      method: "POST",
                                      success: function(result)
                                      {
                                          if (result['result'] != 'ok') // Era ==
                                          {
                                              swal("La novedad no puede eliminarse !", "Contiene digitalizaciones adjuntas, borrelas antes de poder eliminar el examen...")
                                          }
                                          else
                                          {
                                              swal("Eliminado!", "La novedad fue eliminada.", "success");

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
    </script>

    <script>
        function showModalEdit(e) {

          //alert(e);
          var punto = e;
          var id = e;

          $.ajax({
                  url: "/novedadeslist/edit/" + punto,
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
                          $("#cod_novEdit").val(result.cod_nov);
                          $("#CodNovNameEdit").val(result.novedad2);
                          $("#fechaEdit").val(result.fecha);
                          $("#cantidadEdit").val(result.cantidad);
                          $("#comenta1Edit").val(result.comenta1);


                          $("#myModalEdit").attr("action","/novedadeslist/edit/" + punto);

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


    </script>

@endsection

@include('novedadeslist.rto-create')
@include('novedadeslist.rto-edit')
