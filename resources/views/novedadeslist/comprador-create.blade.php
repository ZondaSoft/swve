<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" id="bscss">
<!-- Modals must be declare at body level so the content overlaps the background-->
<!-- Modal Large-->
<div class="modal fade" id="myModalcomprador" name="myModalcomprador" tabindex="-2" role="dialog" aria-labelledby="multa-create" aria-hidden="true">
  <div class="modal-dialog modal-lg">

    <form method="post" action="{{ url('/comprador/add') }}" enctype="multipart/form-data">

     {{ csrf_field() }}

     <div class="modal-content">
        <div class="modal-header">
           <h4 class="modal-title" id="multa-create">Agregar comprador</h4>
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

                       <input class="form-control" type="text" value="{{ $legajo->dominio }}" name="comprador_dominio" id="comprador_dominio"
                       autocomplete="off" maxlength="7" style="width: 80px" readonly>
                     </div>
                </div>

                <div class="col-lg-3 mb-3">
                   <label class="col-form-label">Nro. Interno</label>
                   <input class="form-control" type="number" name="comprador_interno" id="comprador_interno"
                   readonly
                   value="{{ old('codigo',$legajo->codigo) }}" autocomplete='off'>
                </div>

                <div class="col-lg-6 mb-6">
                   <label class="col-form-label">Detalle</label>
                   <input class="form-control" type="text" name="comprador_detalle" id="comprador_detalle"
                   disabled
                   value="{{ old('codigo',$legajo->detalle) }}" autocomplete='off'>
                </div>

             </div>
          </div>

          <div class="col-md-12">
               <div class="form-row">
                 <div class="col-lg-6 mb-6">
                   <label class="col-form-label">Apellido y Nombre/Razón Social *</label>
                   <input class="form-control" type="text" name="comprador" id="comprador"
                       value="{{ old('comprador',$legajo->comprador) }}" required autocomplete="off">
                 </div>
                 <div class="col-lg-6 mb-6">
                   <label class="col-form-label">Domicilio</label>
                   <input class="form-control" type="text" name="domic" id="domic"
                       value="{{ old('domic',$legajo->domic) }}" autocomplete="off">
                 </div>
              </div>
           </div>

           <div class="col-md-12">
                <div class="form-row">
                  <div class="col-lg-6 mb-6">
                    <label class="col-form-label">Email</label>
                    <input class="form-control" type="text" name="email" id="email"
                        value="{{ old('email',$legajo->email) }}" autocomplete="off">
                  </div>
               </div>
            </div>

            <div class="col-md-12">
                 <div class="form-row">
                   <div class="col-lg-5 mb-5">
                     <label class="col-form-label">Telefono 1</label>
                     <input class="form-control" type="text" name="telefono1" id="telefono1"
                         value="{{ old('telefono1',$legajo->telefono1) }}" autocomplete="off">
                   </div>
                   <div class="col-lg-5 mb-5">
                     <label class="col-form-label">Telefono 2</label>
                     <input class="form-control" type="text" name="telefono2" id="telefono2"
                         value="{{ old('telefono2',$legajo->telefono2) }}" autocomplete="off">
                   </div>
                </div>
             </div>

          </div>
          <div class="modal-footer">
             <button class="btn btn-danger" type="button" data-dismiss="modal" id="btncancelarCpa"> Cancelar </button>
             <button class="btn btn-success" type="submit" id="btngrabarS"> Grabar... </button>
             <!-- <input type="submit" value="Enviar información"> -->
          </div>
     </div>

   </form>

  </div>
</div>
