<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" id="bscss">
<!-- Modals must be declare at body level so the content overlaps the background-->
<!-- Modal Large-->
<div class="modal fade" id="myModalDenunciaEdit" name="myModalDenunciaEdit" tabindex="-2" role="dialog" aria-labelledby="myModalLabelLarge" aria-hidden="true">
  <div class="modal-dialog modal-lg">

    @if ($novedades != null)
        @if ($novedades->count() > 0)
            <form method="post" action="{{ url('/denuncia/edit/'.$novedad->id) }}" enctype="multipart/form-data" name="denuncia_ed_form" id="denuncia_ed_form">
        @else
            <form method="post" action="{{ url('/denuncia/edit/') }}" enctype="multipart/form-data" name="denuncia_ed_form" id="denuncia_ed_form">
        @endif
    @endif


    {{ csrf_field() }}

     <div class="modal-content">
        <div class="modal-header">
           <h4 class="modal-title" id="myModalLabelLargeS">Editar Denuncia de Venta  # </h4>


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

                      <input class="form-control" type="text" value="{{ $legajo->dominio }}" name="denuncia_ed_dominio" id="denuncia_ed_dominio"
                      required autocomplete="off" maxlength="7" style="width: 80px" disabled>
                    </div>
               </div>

               <div class="col-lg-3 mb-3">
                  <label class="col-form-label">Nro. Interno</label>
                  <input class="form-control" type="text" name="denuncia_ed_interno" id="denuncia_ed_interno"
                  disabled
                  value="{{ old('codigo',$legajo->codigo) }}" autocomplete='off'>
               </div>

               <div class="col-lg-6 mb-6">
                  <label class="col-form-label">Detalle</label>
                  <input class="form-control" type="text" name="denuncia_ed_deta" id="denuncia_ed_deta"
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
                              <input class="form-control" type="text" value="{{ old('fecha',$legajoNew->fecha) }}" name="denuncia_ed_fecha" id="denuncia_ed_fecha"
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
                name="denuncia_ed_detalle" id="denuncia_ed_detalle">{{ $legajoNew->detalle }}</textarea>
           </div>

           <div class="errors">
           </div>
        </div>
        <div class="modal-footer">
           <div class="col-lg-9 mb-9">
              <button class="btn btn-warning" type="submit" name="btngrabarDenuncia" id="btngrabarDenuncia" style="height: 35.533px" value='borrar'>
                <span class="btn-label"><i class="fa fa-trash"></i>
                </span>Borrar !</button>
           </div>

           <button class="btn btn-danger" type="button" data-dismiss="modal" name="btncancelarDe" id="btncancelarDe"> Cancelar </button>
           <button class="btn btn-success" type="submit" name="btngrabarDenuncia" id="btngrabarDenuncia" value="grabar" value='grabar'> Grabar... </button>
           <!-- <input type="submit" value="Enviar información"> -->
        </div>
     </div>

   </form>

  </div>
</div>
