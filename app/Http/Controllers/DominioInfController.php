<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Veh001;
use App\Veh002;
use App\Veh015;     // Siniestros de terceros
use App\Veh025;     // Inicio venta
use App\Veh026;     // Libre deuda de multa, Libre deuda de patente, informe de Dominio
use App\Veh027;     // Comprador

class DominioInfController extends Controller
{
    public function store(Request $request)
    {
        // Validaciones
        $messages = [
            'libredp_fecha.required'=>'La fecha de emisión es obligatoria'
            ];

        $rules = [
            'libredp_fecha'=>'required'
            ];

        $this->validate($request, $rules, $messages);


        $legajo = new Veh026();
        //$request->all();
        //$legajo = Veh001::create($request->all()); // massives assignments : all() -> onLy() // only('name','description')

        $legajo->dominio = $request->input('libredp_dominio');
        $legajo->codigo = $request->input('libredp_interno');
        $legajo->tramite = 3;   // 1-Libre deuda de multas  2-Libre deuda patentes   3-Informe de dominio  4-Denuncia de venta   5-Verificación policial    6-Formulario CETA

        $fecha = str_replace('/', '-', $request->input('libredp_fecha'));
        $legajo->fecha = Carbon::createFromFormat("d-m-Y", $fecha);
        $legajo->detalle = $request->input('libredp_detalle');


        $legajo->save();   // INSERT INTO - SQL

        return back();
    }


    public function edit($id, $page = 1)
    {
        // Busco el dominio en vehiculos activos
        $vehiculo = Veh001::find($id);

        if ($vehiculo != null) {
            $dominio = $vehiculo->dominio;
        } else {
            // Si no encuentra el dominio lo busco en vehiculos de Baja
            $vehiculo = Veh002::find($id);

            if ($vehiculo != null) {
                $dominio = $vehiculo->dominio;
            } else {
                $dominio = null;
            }
        }

        if ($dominio != null) {
            $legajo = Veh026::where('dominio', '=', $dominio)->where('tramite',3)->first();

            $legajo->fecha = Carbon::parse($legajo->fecha)->format('d/m/Y');
        } else {
            $legajo = null;
        }

        return $legajo;
    }


    public function update(Request $request, $id)
    {
        // Validaciones
        if ($request->input('btngrabarDominio') == 'grabar') {
            $messages = [
                'dominio_ed_fecha.required'=>'La fecha es obligatoria'
                ];

            $rules = [
                'dominio_ed_fecha'=>'required'
                ];

            $this->validate($request, $rules, $messages);
        }

        $legajo = Veh026::find($id);

        $fecha = str_replace('/', '-', $request->input('dominio_ed_fecha'));
        $legajo->fecha = Carbon::createFromFormat("d-m-Y", $fecha);
        $legajo->detalle = $request->input('dominio_ed_detalle');


        if ($request->input('btngrabarDominio') == 'grabar') {
            $legajo->update($request->only('fecha','detalle'));
        } else {
            // Pido confirmar el Borrado
            $showDialog = true;

            return redirect()->back()->with('alert', 'Deleted!')
                                     ->with('id', $id);
        }

        // dd($legajo->cod_centro);

        return back();
    }
}
