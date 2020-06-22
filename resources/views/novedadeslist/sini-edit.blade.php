<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" id="bscss">
<!-- Modals must be declare at body level so the content overlaps the background-->
<!-- Modal Large-->
<div class="modal fade" id="myModalEditS" name="myModalEditS" tabindex="-2" role="dialog" aria-labelledby="myModalLabelLarge" aria-hidden="true">
  <div class="modal-dialog modal-lg">

    @if ($novedades != null)
      @if ($novedades->count() > 0)
          <form method="post" action="{{ url('/siniestros/edit/'.$novedad->id) }}" enctype="multipart/form-data" name="sin-edit" id="sin-edit">
      @else
          <form method="post" action="{{ url('/siniestros/edit/') }}" enctype="multipart/form-data" name="sin-edit" id="sin-edit">
      @endif
    @endif


    {{ csrf_field() }}

     <div class="modal-content">
        <div class="modal-header">
           <h4 class="modal-title" id="myModalLabelLargeS">Editar siniestro propio     # </h4>


           <button class="close" type="button" data-dismiss="modal" aria-label="Close" autofocus tabindex="-1">
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

                      <input class="form-control" type="text" value="{{ $legajo->dominio }}" name="rto_dominio" id="rto_dominio"
                      required autocomplete="off" maxlength="7" style="width: 80px" disabled>
                    </div>
               </div>

               <div class="col-lg-3 mb-3">
                  <label class="col-form-label">Nro. Interno</label>
                  <input class="form-control" type="text" name="rto_interno" id="rto_interno"
                  disabled
                  value="{{ old('codigo',$legajo->codigo) }}" autocomplete='off'>
               </div>

               <div class="col-lg-6 mb-6">
                  <label class="col-form-label">Detalle</label>
                  <input class="form-control" type="text" name="detalle" id="detalle"
                  disabled value="{{ old('codigo',$legajo->detalle) }}" autocomplete='off'>
               </div>

            </div>
          </div>

          <div class="col-md-12">
              <div class="form-row">
                 <div class="col-lg-3 mb-3">
                      <label class="col-form-label">Operario</label>
                      @if(isset($novedad))
                         @if ($novedad != null)
                            <input class="form-control" type="text" name="sin_edit_encarga" id="sin_edit_encarga"
                              value="{{ $novedad->encarga }}" autocomplete='off'>
                         @endif
                      @endif
                 </div>

                 <!-- <div class="col-lg-1 mb-1" style="padding-top: 35px; max-width: 50px">
                    <span class="input-group-append input-group-addon">
                    <a href="/preocupacional/add_new" class="input-group-text fa fa-address-book-o" {{ $edicion?'':'disabled' }} ></a>
                    </span>
                 </div> -->

             </div>
         </div>

         <div class="col-lg-12 mb-12">
           <div class="form-row">
              <div class="col-lg-3 mb-3">
                  <label class="col-form-label" id="lblnro_siniestro" >Nro. Siniestro * </label>
                  <input class="form-control" type="number" value="{{ old('importe',$legajoNew->importe) }}"
                     name="nro_siniestro_edit" id="nro_siniestro_edit" max="9999999999" min="0" disabled
                     required autocomplete="off">
                </div>
                <div class="col-lg-3 mb-3">
                    <label class="col-form-label">Fecha siniestro * </label>
                        <div class="input-group date" id="datetimepicker1" data-provide="datepicker" data-date-format="dd/mm/yyyy"
                            keyboardNavigation="true" title="Seleccione fecha" autoclose="true">

                            @if(isset($novedades))
                               @if ($novedades != null)
                                  @if ($novedades->count() > 0)
                                      <input class="form-control" type="text" value="{{ old('vencimient',$legajoNew->vencimient) }}" name="sin_fecha_edit" id="sin_fecha_edit"
                                          required autocomplete="off" onchange="calcularDias()">
                                  @endif
                               @endif
                            @endif

                            <span class="input-group-append input-group-addon">
                              <span class="input-group-text fa fa-calendar"></span>
                            </span>
                        </div>
                </div>


                <div class="col-lg-1 mb-1">
                    <label class="col-form-label">&nbsp;</label>
                </div>


            </div>
         </div>

         <div class="col-lg-12 mb-12">
              <label class="col-form-label">Comentarios</label>
              @if(isset($novedad))
                 @if ($novedad != null)
                    <textarea cols="7" placeholder=".." class="form-control" enabled
                        name="sin_ed_comenta" id="sin_ed_comenta">{{ $novedad->detalle }}</textarea>
                 @endif
              @endif
         </div>

         <div class="errors">
         </div>
        </div>
        <div class="modal-footer">
           <div class="col-lg-9 mb-9">
              <button class="btn btn-warning" type="submit" name="btngrabarS" id="btngrabarS" style="height: 35.533px" value='borrar'>
                <span class="btn-label"><i class="fa fa-trash"></i>
                </span>Borrar !</button>
           </div>

           <button class="btn btn-danger" type="button" data-dismiss="modal" name="btncancelar" id="btncancelar"> Cancelar </button>
           <button class="btn btn-success" type="submit" name="btngrabarS" id="btngrabarS" value="grabar" value='grabar'> Grabar... </button>
           <!-- <input type="submit" value="Enviar información"> -->
        </div>
     </div>

   </form>

  </div>
</div>
