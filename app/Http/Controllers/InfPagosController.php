<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Veh001;
use App\Veh002;
use App\Veh010;
use DB;

class InfPagosController extends Controller
{
    public function __construct()
   {
      $this->middleware('auth');
   }

   /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Http\Response
    */
   public function index($id = null, $nrolegajo = null, $cod_nov = null)
   {
      $legajoNew = new Veh001;
      $agregar = False;
      $edicion = False;    // True: Muestra botones Grabar - Cancelar   //  False: Muestra botones: Agregar, Editar, Borrar
      $active = 140;

      if ($nrolegajo != null) {
         $legajoNew->legajo = $id;

         // Busco el legajo seleccionado
         $legajoNew->detalle = $legajoNew->Apynom;
      }
      //$legajo->fecha_naci = Carbon::parse($legajo->fecha_naci)->format('d/m/Y');
      //$legajo->alta = Carbon::parse($legajo->alta)->format('d/m/Y');

      if ($id == null) {
           $periodo = Veh001::first();
      } else  {
           $periodo = Veh001::where('id',$id)->first();

           if ($periodo == null) {
               $periodo = Veh001::first();
           }
      }

      if ($periodo != null) {
           $novedades = Veh001::orderBy('dominio')->where('id','>',0)->paginate(9);

      } else  {
           $novedades = Veh001::orderBy('dominio')->where('id','>',0)->paginate(9);

      }

      // Combos de tablas anexas
      $legajos   = Veh001::orderBy('codigo')->get();
      $legajosb   = Veh002::orderBy('codigo')->get();

      return view('informes.pagos')->with(compact('legajoNew','agregar','edicion','active','novedades','legajos','legajosb'));
   }



   public function novedades($id = null, $nrolegajo = null, $cod_nov = null)
   {
      $legajoNew = new Veh001;
      $agregar = False;
      $edicion = False;    // True: Muestra botones Grabar - Cancelar   //  False: Muestra botones: Agregar, Editar, Borrar
      $active = 140;

      if ($nrolegajo != null) {
         $legajoNew->legajo = $id;

         // Busco el legajo seleccionado
         $legajoNew->detalle = $legajoNew->Apynom;
      }
      //$legajo->fecha_naci = Carbon::parse($legajo->fecha_naci)->format('d/m/Y');
      //$legajo->alta = Carbon::parse($legajo->alta)->format('d/m/Y');

      if ($id == null) {
           $periodo = Veh001::where('id','>',0)->first();
      } else  {
           $periodo = Veh001::where('id',$id)->first();

           if ($periodo == null) {
               $periodo = Veh001::where('id','Si')->first();
           }
      }

      $novedades = Veh010::orderBy('dominio')->where('id','>',0)->paginate(9);

      $ddesde = Carbon::now();
      $dhasta = Carbon::now();

      // Combos de tablas anexas
      $legajos   = Veh001::orderBy('dominio')->get();
      $novedades  = Veh010::orderBy('dominio')->get();

      return view('informes.novedades')->with(compact('legajoNew','agregar','edicion','active','novedades','legajos','ddesde','dhasta'));
   }


   public function fichadas($id = null, $nrolegajo = null, $cod_nov = null)
   {
      $legajoNew = new Veh001;
      $agregar = False;
      $edicion = False;    // True: Muestra botones Grabar - Cancelar   //  False: Muestra botones: Agregar, Editar, Borrar
      $active = 140;

      if ($nrolegajo != null) {
         $legajoNew->legajo = $id;

         // Busco el legajo seleccionado
         $legajoNew->detalle = $legajoNew->Apynom;
      }
      //$legajo->fecha_naci = Carbon::parse($legajo->fecha_naci)->format('d/m/Y');
      //$legajo->alta = Carbon::parse($legajo->alta)->format('d/m/Y');

      if ($id == null) {
           $periodo = Veh010::where('id','>',0)->first();
      } else  {
           $periodo = Veh010::where('id',$id)->first();

           if ($periodo == null) {
               $periodo = Veh010::first();
           }
      }

      $novedades = Veh010::orderBy('fecha')->where('id',0)->paginate(9);

      $ddesde = Carbon::now();
      $dhasta = Carbon::now();

      // Combos de tablas anexas
      $legajos   = Sue001::orderBy('codigo')->get();
      $sectores  = Sue011::orderBy('codigo')->get();
      $novedades  = Sue031::orderBy('codigo')->get();

      return view('informes.fichadas')->with(compact('legajo','legajoNew','agregar','edicion','active','sectores','novedades','legajos','ddesde','dhasta'));
   }


   //Route::get('/infvehiculo/print'   // Vehiculos Activos
   public function printpdf(Request $request)
   {
      $pdf = \App::make('dompdf.wrapper');

      $id = 1;

      $ddesdeOrig = $request->input('vehiculo');
      $dhastaOrig = $request->input('vehiculo2');

      //$pedidos  = Mdl060::orderBy('id')->get();
      $pedidos = DB::table('veh001s')
            ->select(DB::raw('codigo,dominio,detalle,modelo,anio,motor,equipo,f_alta'))
            ->whereBetween('codigo', [$ddesdeOrig, $dhastaOrig])
            ->orderBy('codigo')
            ->get();

      // Tamano hoja
      $pdf->setPaper('A4', 'portrait');

      // Cargar view
      $pdf->loadview('informes.pdfnomina', compact('legajo','pedidos', 'ddesdeOrig', 'dhastaOrig'));

      // Generar el PDF al navegador

      return $pdf->stream();
   }



   //Route::get('/infvehiculo/print2'   // Vehiculos Baja
   public function printpdf2(Request $request)
   {
      $pdf = \App::make('dompdf.wrapper');

      $id = 1;

      $ddesdeOrig = $request->input('vehiculob');
      $dhastaOrig = $request->input('vehiculob2');

      //$pedidos  = Mdl060::orderBy('id')->get();
      $pedidosb = DB::table('veh002s')
            ->select(DB::raw('codigo,dominio,detalle,modelo,anio,motor,equipo,f_alta,f_baja'))
            ->whereBetween('codigo', [$ddesdeOrig, $dhastaOrig])
            ->orderBy('codigo')
            ->get();

      // Tamano hoja
      $pdf->setPaper('A4', 'portrait');

      // Cargar view
      $pdf->loadview('informes.pdfnominab', compact('legajo','pedidosb', 'ddesdeOrig', 'dhastaOrig'));

      // Generar el PDF al navegador

      return $pdf->stream();
   }
}
