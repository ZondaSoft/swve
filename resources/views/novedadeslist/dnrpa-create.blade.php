<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" id="bscss">
<!-- Modals must be declare at body level so the content overlaps the background-->
<!-- Modal Large-->
<div class="modal fade" id="myModalDNRPA" name="myModalDNRPA" tabindex="-2" role="dialog" aria-labelledby="multa-create" aria-hidden="true">
  <div class="modal-dialog modal-lg">

    <form method="post" action="{{ url('/dnrpa/add') }}" enctype="multipart/form-data">

     {{ csrf_field() }}

     <div class="modal-content">
        <div class="modal-header">
           <h4 class="modal-title" id="multa-create">Agregar Formulario 13 DNRPA</h4>
           <button class="close" type="button" data-dismiss="modal" aria-label="Close" autofocus="off" tabindex="-1">
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

                       <input class="form-control" type="text" value="{{ $legajo->dominio }}" name="dnrpa_dominio" id="dnrpa_dominio"
                       autocomplete="off" maxlength="7" style="width: 80px" readonly>
                     </div>
                </div>

                <div class="col-lg-3 mb-3">
                   <label class="col-form-label">Nro. Interno</label>
                   <input class="form-control" type="number" name="dnrpa_interno" id="dnrpa_interno"
                   readonly
                   value="{{ old('codigo',$legajo->codigo) }}" autocomplete='off'>
                </div>

                <div class="col-lg-6 mb-6">
                   <label class="col-form-label">Detalle</label>
                   <input class="form-control" type="text" name="dnrpa_det_veh" id="dnrpa_det_veh"
                   disabled
                   value="{{ old('codigo',$legajo->detalle) }}" autocomplete='off'>
                </div>

             </div>
          </div>

          <div class="col-lg-12 mb-12">
              <div class="form-row">
                  <div class="col-lg-3 mb-3">
                      <label class="col-form-label">Fecha de emisión * </label>
                          <div class="input-group date" id="datetimepicker1" data-provide="datepicker" data-date-format="dd/mm/yyyy"
                              keyboardNavigation="true" title="Seleccione fecha" autoclose="true">
                              <input class="form-control" type="text" value="{{ old('fecha',$legajoNew->fecha) }}" name="dnrpa_fecha" id="dnrpa_fecha"
                                  enabled required autocomplete="off">
                              <span class="input-group-append input-group-addon">
                                <span class="input-group-text fa fa-calendar"></span>
                              </span>
                          </div>
                   </div>
                </div>
            </div>

           <div class="col-lg-12 mb-12">
                <label class="col-form-label">Comentarios</label>
                <textarea cols="7" placeholder=".." class="form-control" enabled
                name="dnrpa_detalle" id="dnrpa_detalle">{{ $legajoNew->detalle }}</textarea>
           </div>

           <div class="errors">
           </div>

          </div>
          <div class="modal-footer">
             <button class="btn btn-danger" type="button" data-dismiss="modal" id="btncancelar"> Cancelar </button>
             <button class="btn btn-success" type="submit" id="btngrabarPolicial"> Grabar... </button>
             <!-- <input type="submit" value="Enviar información"> -->
          </div>
     </div>

   </form>

  </div>
</div>
