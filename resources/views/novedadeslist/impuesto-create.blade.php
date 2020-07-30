<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" id="bscss">
<!-- Modals must be declare at body level so the content overlaps the background-->
<!-- Modal Large-->
<div class="modal fade" id="myModal-impuesto" name="myModal-impuesto" tabindex="-2" role="dialog" aria-labelledby="multa-create" aria-hidden="true">
  <div class="modal-dialog modal-lg">

    <form method="post" action="{{ url('/impuesto/add') }}" enctype="multipart/form-data">

    {{ csrf_field() }}

     <div class="modal-content">
        <div class="modal-header">
           <h4 class="modal-title" id="multa-create">Agregar pago Impuesto Automotor (Patente)</h4>
           <button class="close" type="button" data-dismiss="modal" aria-label="Close" tabindex="8">
              <span aria-hidden="true">&times;</span>
           </button>
        </div>
        <div class="modal-body">

          @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif

         <div class="col-md-12">
              <div class="form-row">
                <div class="col-lg-3 mb-3">
                   <label class="col-form-label">Dominio * </label>
                   <div class="input-group " name="legajo" id="legajo" data-provide="" keyboardNavigation="false">

                       <input class="form-control" type="text" value="{{ $legajo->dominio }}" name="patente_dominio" id="patente_dominio"
                       required autocomplete="off" maxlength="7" style="width: 80px" readonly>
                     </div>
                </div>

                <div class="col-lg-3 mb-3">
                   <label class="col-form-label">Nro. Interno</label>
                   <input class="form-control" type="text" name="patente_interno" id="patente_interno" readonly
                   value="{{ old('codigo',$legajo->codigo) }}" autocomplete='off' tabindex="1">
                </div>

                <div class="col-lg-6 mb-6">
                   <label class="col-form-label">Detalle</label>
                   <input class="form-control" type="text" name="impuesto_detallec" id="impuesto_detallec"
                   disabled
                   value="{{ old('codigo',$legajo->detalle) }}" autocomplete='off'>
                </div>

             </div>
          </div>

          <div class="col-lg-12 mb-12">
              <div class="form-row">
                  <div class="col-lg-3 mb-3">
                      <label class="col-form-label" id="lblfecha2" >Período * </label>
                        <input class="form-control" type="text" value="{{ old('periodo',$legajoNew->periodo) }}"
                             name="patente_periodo" id="patente_periodo" autofocus 
                             data-masked="" data-inputmask="'mask': '99/9999'" placeholder="mm/aaaa"
                             required autocomplete="off" 
                             onchange="cargar_datos()"
                             onsubmit="cargar_datos()">
                        <p id="error_input" class="font-size: 2" style="color: red"></p>
                  </div>
                   <div class="col-lg-3 mb-3">
                      <label class="col-form-label">Fecha pago * </label>
                          <div class="input-group date" id="datetimepicker1" data-provide="datepicker" data-date-format="dd/mm/yyyy"
                              keyboardNavigation="true" title="Seleccione fecha" autoclose="true">
                              <input class="form-control" type="text" value="{{ old('fecha',$legajoNew->fecha) }}" name="patente_fecha" id="patente_fecha"
                                  enabled required autocomplete="off">
                              <span class="input-group-append input-group-addon">
                                <span class="input-group-text fa fa-calendar"></span>
                              </span>
                          </div>
                   </div>
                </div>
            </div>

            <div class="col-md-12">
               <div class="form-row">
                    <div class="col-lg-4 mb-4 ">
                         <label class="col-form-label">Importe *</label>
                         <!-- @ if(isset($novedad)) -->
                            <input class="form-control" type="number" name="patente_importe" id="patente_importe"
                              value="{{ $legajo->importe }}" autocomplete='off' max="9999999.99" min="0.00" required>
                         <!-- @ endif -->
                    </div>
                </div>
            </div>


            <div class="col-lg-12 mb-12">
                <label class="col-form-label">Comentarios</label>
                <textarea cols="7" placeholder=".." class="form-control" enabled
                name="patente_detalle" id="patente_detalle">{{ $legajoNew->detalle }}</textarea>
            </div>

            <div class="errors">
            </div>


            </div>
            <div class="modal-footer">
               <button class="btn btn-danger" type="button" data-dismiss="modal" id="btncancelarIc" tabindex="5"> Cancelar </button>
               <button class="btn btn-success" type="submit" id="btngrabarIc"> Grabar... </button>
               <!-- <input type="submit" value="Enviar información"> -->
            </div>
     </div>

   </form>

  </div>
</div>