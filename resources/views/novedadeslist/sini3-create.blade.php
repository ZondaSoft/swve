<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" id="bscss">
<!-- Modals must be declare at body level so the content overlaps the background-->
<!-- Modal Large-->
<div class="modal fade" id="myModal-sinies3" name="myModal-sinies3" tabindex="-2" role="dialog" aria-labelledby="multa-create" aria-hidden="true">
  <div class="modal-dialog modal-lg">

    <form method="post" action="{{ url('/sinies3/add') }}" enctype="multipart/form-data">

    {{ csrf_field() }}

     <div class="modal-content">
        <div class="modal-header">
           <h4 class="modal-title" id="multa-create">Agregar siniestro recibido</h4>
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

                       <input class="form-control" type="text" value="{{ $legajo->dominio }}" name="sint_dominio" id="sint_dominio"
                       required autocomplete="off" maxlength="7" style="width: 80px" readonly>
                     </div>
                </div>

                <div class="col-lg-3 mb-3">
                   <label class="col-form-label">Nro. Interno</label>
                   <input class="form-control" type="text" name="sint_interno" id="sint_interno" readonly
                   value="{{ old('codigo',$legajo->codigo) }}" autocomplete='off' tabindex="1">
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
                       @if(isset($novedad))
                           <input class="form-control" type="number" name="encargaT" id="encargaT"
                             value="{{ $novedad->encarga }}" autocomplete='off'
                             max="99999" min="0">
                       @endif
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
                      <label class="col-form-label" id="lblfecha2" >Nro. Siniestro * </label>
                          <input class="form-control" type="number" value="{{ old('importe',$legajoNew->importe) }}"
                             name="nro_siniestroT" id="nro_siniestroT" autofocus
                             required autocomplete="off" max="9999999999" min="0">
                  </div>
                   <div class="col-lg-3 mb-3">
                      <label class="col-form-label">Fecha siniestro * </label>
                          <div class="input-group date" id="datetimepicker1" data-provide="datepicker" data-date-format="dd/mm/yyyy"
                              keyboardNavigation="true" title="Seleccione fecha" autoclose="true">
                              <input class="form-control" type="text" value="{{ old('fecha',$legajoNew->fecha) }}" name="sint_fecha" id="sint_fecha"
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
                    <div class="col-lg-6 mb-6 ">
                         <label class="col-form-label">Cia.de Seguros</label>
                         <!-- @ if(isset($novedad)) -->
                            <input class="form-control" type="text" name="aseguradora" id="aseguradora"
                              value="{{ $legajo->aseguradora }}" autocomplete='off'>
                         <!-- @ endif -->
                    </div>

                    <div class="col-lg-5 mb-3">
                      <label class="col-form-label">Estado del siniestro</label>
                      <select class="form-control" id="estadoT" name="estadoT" autocomplete='off'>
                        <option value="Abierto" @if ($legajo->estado == 1)  selected   @endif  >Abierto</option>
                        <option value="Pagado" @if ($legajo->estado == 2)  selected   @endif  >Pagado</option>
                        <option value="Rechazado" @if ($legajo->estado == 3)  selected   @endif  >Rechazado</option>
                      </select>
                    </div>
                </div>
            </div>


            <div class="col-lg-12 mb-12">
                <label class="col-form-label">Comentarios</label>
                <textarea cols="7" placeholder=".." class="form-control" enabled
                name="sint_detalle" id="sint_detalle">{{ $legajoNew->detalle }}</textarea>
            </div>

            <div class="errors">
            </div>


            </div>
            <div class="modal-footer">
               <button class="btn btn-danger" type="button" data-dismiss="modal" id="btncancelar" tabindex="5"> Cancelar </button>
               <button class="btn btn-success" type="submit" id="btngrabar"> Grabar... </button>
               <!-- <input type="submit" value="Enviar información"> -->
            </div>
     </div>

   </form>

  </div>
</div>
