<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" id="bscss">
<!-- Modals must be declare at body level so the content overlaps the background-->
<!-- Modal Large-->
<div class="modal fade" id="myModalCompradoredit" name="myModalCompradoredit" tabindex="-2" role="dialog" aria-labelledby="myModalLabelLarge" aria-hidden="true">
  <div class="modal-dialog modal-lg">

    @if ($novedades != null)
        @if ($novedades->count() > 0)
            <form method="post" action="{{ url('/comprador/edit/'.$legajo->id) }}" enctype="multipart/form-data" name="comprad_ed_form" id="comprad_ed_form">
        @else
            <form method="post" action="{{ url('/comprador/edit/') }}" enctype="multipart/form-data" name="comprad_ed_form" id="comprad_ed_form">
        @endif
    @endif


    {{ csrf_field() }}

     <div class="modal-content">
        <div class="modal-header">
           <h4 class="modal-title" id="myModalLabelLargeS">Editar comprador</h4>


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
                  <div class="input-group " name="dominio_ed_baja" id="dominio_ed_baja" data-provide="" keyboardNavigation="false">

                      <input class="form-control" type="text" value="{{ $legajo->dominio }}" name="comprador_ed_dominio" id="comprador_ed_dominio"
                      autocomplete="off" maxlength="7" style="width: 80px" disabled>
                    </div>
               </div>

               <div class="col-lg-3 mb-3">
                  <label class="col-form-label">Nro. Interno</label>
                  <input class="form-control" type="text" name="ventas_ed_interno" id="ventas_ed_interno"
                  disabled
                  value="{{ old('codigo',$legajo->codigo) }}" autocomplete='off'>
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
                 <div class="col-lg-6 mb-6">
                   <label class="col-form-label">Apellido y Nombre/Razón Social *</label>
                   <input class="form-control" type="text" name="comprador_ed" id="comprador_ed"
                       value="{{ old('comprador',$legajo->comprador) }}" required autocomplete="off">
                 </div>
                 <div class="col-lg-6 mb-6">
                   <label class="col-form-label">Domicilio</label>
                   <input class="form-control" type="text" name="domic_ed" id="domic_ed"
                       value="{{ old('domic',$legajo->domic) }}" autocomplete="off">
                 </div>
              </div>
           </div>

           <div class="col-md-12">
                <div class="form-row">
                  <div class="col-lg-6 mb-6">
                    <label class="col-form-label">Email</label>
                    <input class="form-control" type="text" name="email_ed" id="email_ed"
                        value="{{ old('email',$legajo->email) }}" autocomplete="off">
                  </div>
               </div>
            </div>

            <div class="col-md-12">
                 <div class="form-row">
                   <div class="col-lg-5 mb-5">
                     <label class="col-form-label">Telefono 1</label>
                     <input class="form-control" type="text" name="telefono_ed1" id="telefono_ed1"
                         value="{{ old('telefono1',$legajo->telefono1) }}" autocomplete="off">
                   </div>
                   <div class="col-lg-5 mb-5">
                     <label class="col-form-label">Telefono 2</label>
                     <input class="form-control" type="text" name="telefono_ed2" id="telefono_ed2"
                         value="{{ old('telefono2',$legajo->telefono2) }}" autocomplete="off">
                   </div>
                </div>
             </div>

        </div>
        <div class="modal-footer">
           <div class="col-lg-9 mb-9">
              <button class="btn btn-warning" type="submit" name="btngrabarEdCp" id="btngrabarEdCp" style="height: 35.533px" value='borrar'>
                <span class="btn-label"><i class="fa fa-trash"></i>
                </span>Borrar !</button>
           </div>

           <button class="btn btn-danger" type="button" data-dismiss="modal" name="btncancelarCpe" id="btncancelarCpe"> Cancelar </button>
           <button class="btn btn-success" type="submit" name="btngrabarEdCp" id="btngrabarEdCp" value="grabar" value='grabar'> Grabar... </button>
           <!-- <input type="submit" value="Enviar información"> -->
        </div>
     </div>

   </form>

  </div>
</div>
