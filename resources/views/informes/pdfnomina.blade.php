<div class="row mb-lg-12">
    <div class="col-lg-6 col-md-6 col-xs-6" style="border-right: 1px;solid #C00;">
      <img alt="" src="img/logo_af.bmp" height="50" width="50" border-right="1"/>
    </div>
</div>
<div class="col-lg-12 col-md-12 col-xs-12 text-center" style="font-size: 16px;font-weight: bold">
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   INFORME DE VEHICULOS ACTIVOS
</div>

<div class="col-lg-12 col-md-12 col-xs-12 text-center" style="font-size: 16px;font-weight: bold">
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

</div>

<div class="col-lg-12 col-md-12 col-xs-12 text-center" style="font-size: 14px">
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   Desde : {{ $ddesdeOrig }}   -   Hasta : {{ $dhastaOrig }}
</div>

<div class="col-lg-12 col-md-12 col-xs-12 text-center" style="font-size: 14px">
   &nbsp;
</div>

<div class="panel">
   <div class="panel-body">
      <div class="table-responsive table-bordered mb-lg">
        <table style="font-size: 13px;">
          <thead style="bord">
            <tr>
                <th style="width: 55px;border-bottom: 1px solid;border-top: 1px solid;padding-top: 10px;padding-bottom: 10px">
                    Nro. Interno</th>
                <th style="width: 55px;border-bottom: 1px solid;border-top: 1px solid;padding-top: 10px;padding-bottom: 10px">
                    Dominio</th>
                <th style="width: 145px;border-bottom: 1px solid;border-top: 1px solid;padding-top: 10px;padding-bottom: 10px;text-align: center">
                    Detalle</th>
                <th style="width: 55px;border-bottom: 1px solid;border-top: 1px solid;padding-top: 10px;padding-bottom: 10px">
                    Modelo</th>
                <th style="width: 35px;border-bottom: 1px solid;border-top: 1px solid;padding-top: 10px;padding-bottom: 10px;text-align: center">
                    Año</th>
                <th style="width: 35px;border-bottom: 1px solid;border-top: 1px solid;padding-top: 10px;padding-bottom: 10px;text-align: center">
                    Motor</th>
                <th style="width: 35px;border-bottom: 1px solid;border-top: 1px solid;padding-top: 10px;padding-bottom: 10px;text-align: center">
                    Equipo</th>
             </tr>
          </thead>
          <tbody style="font-size: 12px;">

            @foreach ($pedidos as $pedido)
                <tr>
                    <td>
                      {{ $pedido->codigo }}
                    </td>
                    <td>
                      {{ $pedido->dominio }}
                    </td>
                    <td>
                      {{ $pedido->detalle }}
                    </td>
                    <td>
                      {{ $pedido->modelo }}
                    </td>
                    <td style="text-align: center">
                      {{ $pedido->anio }}
                    </td>
                    <td>
                      {{ $pedido->motor }}
                    </td>
                    <td>
                      {{ $pedido->equipo }}
                    </td>
                </tr>
            @endforeach

          </tbody>
        </table>

        <hr>

        <div class="col-lg-12 col-md-12 col-xs-12">
           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

        </div>

      </div>


   </div>
</div>

<script>
function test(){
  obj = document.getElementById("test");
  alert("el top es: " + obj.offsetTop + "\nEl left es: "+ obj.offsetLeft )
}
<a href="javascript:test()">XY</a>
<br />
<br />
<div id="test">Content</div>
</script>
