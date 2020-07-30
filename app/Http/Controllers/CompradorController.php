<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Veh001;
use App\Veh002;
use App\Veh015;     // Siniestros de terceros
use App\Veh025;     // Inicio venta
use App\Veh027;     // Comprador

class CompradorController extends Controller
{
    public function store(Request $request)
    {
        // Validaciones
        $messages = [
            'comprador.required'=>'El nombre o Razón Social es obligatorio'
            ];

        $rules = [
            'comprador'=>'required'
            ];

        $this->validate($request, $rules, $messages);

        $legajo = new Veh027();
        //$request->all();
        //$legajo = Veh001::create($request->all()); // massives assignments : all() -> onLy() // only('name','description')

        $legajo->dominio = $request->input('comprador_dominio');
        $legajo->codigo = $request->input('comprador_interno');
        $legajo->comprador = $request->input('comprador');
        $legajo->domic = $request->input('domic');
        $legajo->email = $request->input('email');
        $legajo->telefono1 = $request->input('telefono1');
        $legajo->telefono2 = $request->input('telefono2');

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
            $legajo = Veh027::where('dominio', '=', $dominio)->first();

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

        $legajo = Veh027::find($id);

        $legajo->comprador = $request->input('comprador_ed');
        $legajo->domic = $request->input('domic_ed');
        $legajo->email = $request->input('email_ed');
        $legajo->telefono1 = $request->input('telefono_ed1');
        $legajo->telefono2 = $request->input('telefono_ed2');
        //$legajo->nro_siniestro = $request->input('nro_siniestro_edit');


        if ($request->input('btngrabarEdCp') == 'grabar') {
            $legajo->update($request->only('comprador','domic','email','telefono1','telefono2'));
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
