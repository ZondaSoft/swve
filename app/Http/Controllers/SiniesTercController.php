<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use App\Veh001;
use App\Veh007;     // Grupos de vehiculos
use App\Veh015;     // Siniestros de terceros

class SiniesTercController extends Controller
{
    public function add()
    {
        $legajo = new Veh015;      // find($id);     // dd($legajo);
        $edicion = True;    // True: Muestra botones Grabar - Cancelar   //  False: Muestra botones: Agregar, Editar, Borrar
        $agregar = True;
        $active = 26;
        $sectores   = Veh007::orderBy('detalle')->get();

        return view('novedadeslist.index')->with(compact('legajo','agregar','edicion','active','sectores'));
    }

    public function store(Request $request)
    {
        // Validaciones
        $messages = [
            'sint_fecha.required'=>'La fecha es obligatoria',
            'nro_siniestroT.required'=>'El número de siniestro es obligatorio'
            ];

        $rules = [
            'sint_fecha'=>'required',
            'nro_siniestroT'=>'required'
            ];

        $this->validate($request, $rules, $messages);

        //$request->validate([
        //    'legajo' => ['required', 'integer', new LegajoExiste],
        //]);

        $legajo = new Veh015();

        $legajo->unidad = $request->input('sint_interno');
        $legajo->dominio = $request->input('sint_dominio');
        $legajo->nro_siniestro = $request->input('nro_siniestroT');
        $legajo->encarga = $request->input('encargaT');
        $legajo->cia = $request->input('aseguradora');
        $legajo->detalle = $request->input('sint_detalle');
        $legajo->estado = $request->input('estadoT');

        $date = str_replace('/', '-', $request->input('sint_fecha'));
        $legajo->fecha = Carbon::createFromFormat("d-m-Y", $date);

        $legajo->save();

        return redirect('/home');
    }



    public function edit($id, $page = 1)
    {
        // id a NovedadesController:edit2() ver de unificar
        $legajo = Veh015::find($id);

        $legajo->fecha = Carbon::parse($legajo->fecha)->format('d/m/Y');

        return $legajo;
    }


    public function update(Request $request, $id)
    {
        $messages = [
            'sinT_fecha_edit.required'=>'La fecha del siniestro es obligatoria'
            ];

        $rules = [
            'sinT_fecha_edit'=>'required'
            ];

        //$request->alta = $legajo->alta;
        // Validacion de campos
        $this->validate($request, $rules, $messages);

        $legajo = Veh015::find($id);

        $fecha = str_replace('/', '-', $request->input('sinT_fecha_edit'));
        $legajo->fecha = Carbon::createFromFormat("d-m-Y", $fecha);
        $legajo->encarga = $request->input('sint_edit_encarga');
        $legajo->cia = $request->input('aseguradora_edit');
        $legajo->estado = $request->input('estadoT_edit');
        $legajo->detalle = $request->input('sinT_ed_comenta');

        //dd($id);

        if ($request->input('btngrabarT') == 'grabar') {
            $legajo->update($request->only('fecha','encarga','cia','estado','detalle'));
        } else {
            // Pido confirmar el Borrado
            $showDialog = true;

            return redirect()->back()->with('alert', 'Deleted!')
                                     ->with('id', $id);
        }

        // dd($legajo->cod_centro);

        return back();
    }


    public function delete($id)
    {
        // return "Mostrar form de edit $id";
        $legajo = Veh015::find($id);
        $agregar = False;
        $edicion = True;    // True: Muestra botones Grabar - Cancelar   //  False: Muestra botones: Agregar, Editar, Borrar
        $active = 1;

        return "false";
    }


    public function delete_drop($id)
    {
        // return "Mostrar form de edit $id";
        $legajo = Veh015::find($id);
        $agregar = False;
        $edicion = True;    // True: Muestra botones Grabar - Cancelar   //  False: Muestra botones: Agregar, Editar, Borrar
        $active = 1;

        $legajo->delete();

        //return "false";
        return "{\"result\":\"ok\",\"id\":\"$legajo->id\"}";
    }
}
