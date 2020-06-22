<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Veh001;
use App\Veh007;
use App\Veh010;


class RtoController extends Controller
{
    public function add()
    {
        $legajo = new Veh010;      // find($id);     // dd($legajo);
        $edicion = True;    // True: Muestra botones Grabar - Cancelar   //  False: Muestra botones: Agregar, Editar, Borrar
        $agregar = True;
        $active = 26;
        $sectores   = Veh010::orderBy('detalle')->get();

        //return view('home.index')->with(compact('legajo','agregar','edicion','active','sectores'));
        return redirect('/home');
    }


    public function store(Request $request, $id = 0)
    {
        if ($id == null) {
            $id = 0;
        }
        // Validaciones
        $messages = [
            'rto_fecha.required'=>'La fecha es obligatoria',
            'rto_vencimient.required'=>'La fecha de vencimiento es obligatoria'
            ];

        $rules = [
            'rto_fecha'=>'required',
            'rto_vencimient'=>'required'
            ];

        $this->validate($request, $rules, $messages);

        //$request->validate([
        //    'legajo' => ['required', 'integer', new LegajoExiste],
        //]);

        $lote = false;
        $legajo = new Veh010();

        $legajo->unidad = $request->input('rto_interno');
        $legajo->dominio = $request->input('rto_dominio');

        $legajo->tipo = 'Revisación Técnica';
        $legajo->encarga = $request->input('rto_encarga');
        $legajo->detalle = $request->input('rto_detalle');

        $date = str_replace('/', '-', $request->input('rto_fecha'));
        $legajo->fecha = Carbon::createFromFormat("d-m-Y", $date);

        $date = str_replace('/', '-', $request->input('rto_vencimient'));
        $legajo->vencimient = Carbon::createFromFormat("d-m-Y", $date);

        $legajo->save();
        
        if ($id != 0) {
            return redirect('/home/' . $id);
        }

        return redirect('/home');
    }



    public function edit($id, $page = 1)
    {
        // id a NovedadesController:edit2() ver de unificar
        $legajo = Veh010::find($id);

        $legajo->fecha = Carbon::parse($legajo->fecha)->format('d/m/Y');
        $legajo->vencimient = Carbon::parse($legajo->vencimient)->format('d/m/Y');

        return $legajo;
    }


    public function update(Request $request, $id)
    {
        // Validaciones
        if ($request->input('btngrabarR') == 'grabar') {
            $messages = [
                'rto_fechaEdit.required'=>'La fecha de revisión es obligatoria'
                ];

            $rules = [
                'rto_fechaEdit'=>'required'
                ];

            //$request->alta = $legajo->alta;
            // Validacion de campos
            $this->validate($request, $rules, $messages);
        }


        $legajo = Veh010::find($id);
        $legajo->detalle = $request->input('rto_ed_comenta');

        //dd($id);

        if ($request->input('btngrabarR') == 'grabar') {
            $legajo->update($request->only('detalle'));
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
        $legajo = Veh010::find($id);
        $agregar = False;
        $edicion = True;    // True: Muestra botones Grabar - Cancelar   //  False: Muestra botones: Agregar, Editar, Borrar
        $active = 1;

        return "false";
    }


    public function delete_drop($id)
    {
        // return "Mostrar form de edit $id";
        $legajo = Veh010::find($id);
        $agregar = False;
        $edicion = True;    // True: Muestra botones Grabar - Cancelar   //  False: Muestra botones: Agregar, Editar, Borrar
        $active = 1;

        $legajo->delete();

        //return "false";
        return "{\"result\":\"ok\",\"id\":\"$legajo->id\"}";
    }
}
