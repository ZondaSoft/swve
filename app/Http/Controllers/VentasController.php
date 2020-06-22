<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Veh001;
use App\Veh002;
use App\Veh015;
use App\Veh025;

class VentasController extends Controller
{
    public function store(Request $request)
    {
        // Validaciones
        $messages = [
            'ventas_fecha.required'=>'La fecha de venta o baja es obligatoria'
            ];

        $rules = [
            'ventas_fecha'=>'required'
            ];

        $this->validate($request, $rules, $messages);

        $legajo = new Veh025();
        //$request->all();
        //$legajo = Veh001::create($request->all()); // massives assignments : all() -> onLy() // only('name','description')

        $legajo->dominio = $request->input('ventas_dominio');
        $legajo->codigo = $request->input('ventas_interno');
        $legajo->tipo_baja = $request->input('ventas_tipo');
        $legajo->detalle = $request->input('ventas_detalle');
        $legajo->estado = 'Pendiente';

        $fecha = str_replace('/', '-', $request->input('ventas_fecha'));
        $legajo->fecha = Carbon::createFromFormat("d-m-Y", $fecha);

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
            $legajo = Veh025::where('dominio', '=', $dominio)->first();

            $legajo->fecha = Carbon::parse($legajo->fecha)->format('d/m/Y');
        } else {
            $legajo = null;
        }

        return $legajo;
    }


    public function update(Request $request, $id)
    {
        // Validaciones
        /*if ($request->input('btngrabar') == 'grabar') {
            $messages = [
                'cantidadEdit.required'=>'La cantidad es obligatoria'
                ];

            $rules = [
                'cantidadEdit'=>'required'
                ];

            $this->validate($request, $rules, $messages);
        }
        */

        $legajo = Veh025::find($id);

        $fecha = str_replace('/', '-', $request->input('ventas_ed_fecha'));
        $legajo->fecha = Carbon::createFromFormat("d-m-Y", $fecha);
        $legajo->detalle = $request->input('ventas_ed_detalle');
        $legajo->tipo_baja = $request->input('ventas_ed_tipo');
        //$legajo->nro_siniestro = $request->input('nro_siniestro_edit');


        if ($request->input('btngrabarBaja') == 'grabar') {
            $legajo->update($request->only('tipo_baja','fecha','detalle'));
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
