<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" id="bscss">
<!-- Modals must be declare at body level so the content overlaps the background-->
<!-- Modal Large-->
<div class="modal fade" id="myModalLarge" name="myModalLarge" tabindex="-2" role="dialog" aria-labelledby="myModalLabelLarge" aria-hidden="true">
  <div class="modal-dialog modal-lg">

    <form method="post" action="{{ url('/rto/add') }}" enctype="multipart/form-data">

    {{ csrf_field() }}

     <div class="modal-content">
        <div class="modal-header">
           <h4 class="modal-title" id="myModalLabelLarge">Agregar Revisación Técnica</h4>
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

                       <input class="form-control" type="text" value="{{ $legajo->dominio }}" name="rto_dominio2" id="rto_dominio2"
                       autocomplete="off" maxlength="7" style="width: 80px" disabled>
                       <input class="form-control" type="text" value="{{ $legajo->dominio }}" name="rto_dominio" id="rto_dominio"
                       autocomplete="off" maxlength="7" style="width: 80px" hidden readonly>
                     </div>
                </div>

                <div class="col-lg-3 mb-3">
                   <label class="col-form-label">Nro. Interno</label>
                   <input class="form-control" type="text" name="rto_interno2" id="rto_interno2"
                   disabled value="{{ old('codigo',$legajo->codigo) }}" autocomplete='off'>
                   <input class="form-control" type="text" name="rto_interno" id="rto_interno"
                   readonly value="{{ old('codigo',$legajo->codigo) }}" autocomplete='off' hidden>
                </div>

                <div class="col-lg-6 mb-6">
                   <label class="col-form-label">Detalle</label>
                   <input class="form-control" type="text" name="detalle" id="detalle"
                   disabled
                   value="{{ old('codigo',$legajo->detalle) }}" autocomplete='off'>
                </div>

             </div>
          </div>

          <div class="col-md-12">
               <div class="form-row">
                  <div class="col-lg-3 mb-3">
                       <label class="col-form-label">Operario</label>
                       <input class="form-control" type="number" name="rto_encarga" id="rto_encarga"
                          value="" autocomplete='off' max="99999" min="0">
                  </div>
                  <!-- <div class="col-lg-1 mb-1" style="padding-top: 35px; max-width: 50px">
                     <span class="input-group-append input-group-addon">
                     <a href="/preocupacional/add_new" class="input-group-text fa fa-address-book-o" {{ $edicion?'':'disabled' }} ></a>
                     </span>
                  </div>
                  <div class="col-lg-6 mb-6">
                     <label class="col-form-label">Detalle</label>
                     <input class="form-control" type="text" name="detalle" id="detalle"
                     disabled
                     value="{{ old('codigo',$legajo->detalle) }}" autocomplete='off'>
                  </div>
                  -->
              </div>
           </div>

         <div class="col-lg-12 mb-12">
            <div class="form-row">
                 <div class="col-lg-3 mb-3">
                    <label class="col-form-label">Fecha revisión * </label>
                        <div class="input-group date" id="datetimepicker1" data-provide="datepicker" data-date-format="dd/mm/yyyy"
                            keyboardNavigation="true" title="Seleccione fecha" autoclose="true">
                            <input class="form-control" type="text" value="{{ old('fecha',$legajoNew->fecha) }}" name="rto_fecha" id="rto_fecha"
                                enabled required autocomplete="off" autofocus="on">
                            <span class="input-group-append input-group-addon">
                              <span class="input-group-text fa fa-calendar"></span>
                            </span>
                        </div>
                 </div>
                 <div class="col-lg-3 mb-3">
                     <label class="col-form-label" id="lblfecha2" >Fecha Vencimiento * </label>
                         <div class="input-group date" id="datetimepicker1" data-provide="datepicker" data-date-format="dd/mm/yyyy"
                             keyboardNavigation="true" title="Seleccione fecha" autoclose="true">

                             <input class="form-control" type="text" value="{{ old('vencimient',$legajoNew->vencimient) }}"
                                  name="rto_vencimient" id="rto_vencimient"
                                  required autocomplete="off" onchange="calcularDias()">

                             <span class="input-group-append input-group-addon" id="btncalendar2">
                               <span class="input-group-text fa fa-calendar"></span>
                             </span>
                         </div>
                 </div>
              </div>
          </div>

          <div class="col-lg-12 mb-12">
              <label class="col-form-label">Comentarios</label>
              <textarea cols="7" placeholder=".." class="form-control" enabled
              name="rto_detalle" id="rto_detalle">{{ $legajoNew->detalle }}</textarea>
          </div>

          <div class="errors">
          </div>


          </div>
          <div class="modal-footer">
             <button class="btn btn-danger" type="button" data-dismiss="modal" id="btncancelar"> Cancelar </button>
             <button class="btn btn-success" type="submit" id="btngrabar"> Grabar... </button>
             <!-- <input type="submit" value="Enviar información"> -->
          </div>
     </div>

   </form>

  </div>
</div>
