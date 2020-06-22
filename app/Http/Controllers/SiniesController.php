<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Veh001;
use App\Veh007;
use App\Veh012;

class SiniesController extends Controller
{
    public function add()
    {
        $legajo = new Veh012;      // find($id);     // dd($legajo);
        $edicion = True;    // True: Muestra botones Grabar - Cancelar   //  False: Muestra botones: Agregar, Editar, Borrar
        $agregar = True;
        $active = 26;
        $sectores   = Veh007::orderBy('detalle')->get();

        return view('novedadeslist.index')->with(compact('legajo','agregar','edicion','active','sectores'));
    }

    public function store(Request $request)
    {
        $exibirmodal = true;

        // Validaciones
        $messages = [
            'sin_fecha.required'=>'La fecha es obligatoria',
            'nro_siniestro.required'=>'El número de siniestro es obligatorio',
            'nro_siniestro.unique'=>'El número de siniestro ya existe'
            ];

        $rules = [
            'sin_fecha'=>'required',
            'nro_siniestro'=>'required|unique:veh012s'
            ];

        $this->validate($request, $rules, $messages);

        //$request->validate([
        //    'legajo' => ['required', 'integer', new LegajoExiste],
        //]);

        $legajo = new Veh012();

        $legajo->unidad = $request->input('sin_interno');
        $legajo->dominio = $request->input('sin_dominio');
        $legajo->encarga = $request->input('sin_encarga');
        $legajo->nro_siniestro = $request->input('nro_siniestro');
        $legajo->detalle = $request->input('sin_detalle');

        $date = str_replace('/', '-', $request->input('sin_fecha'));
        $legajo->fecha = Carbon::createFromFormat("d-m-Y", $date);

        $legajo->save();

        $exibirmodal = false;

        return redirect('/home');
    }



    public function edit($id, $page = 1)
    {
        // id a NovedadesController:edit2() ver de unificar
        $legajo = Veh012::find($id);

        $legajo->fecha = Carbon::parse($legajo->fecha)->format('d/m/Y');

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

        $legajo = Veh012::find($id);

        $fecha = str_replace('/', '-', $request->input('sin_fecha_edit'));
        dd($fecha);
        $legajo->fecha = Carbon::createFromFormat("d-m-Y", $fecha);
        $legajo->detalle = $request->input('sin_ed_comenta');
        $legajo->encarga = $request->input('sin_edit_encarga');
        //$legajo->nro_siniestro = $request->input('nro_siniestro_edit');


        if ($request->input('btngrabarS') == 'grabar') {
            $legajo->update($request->only('encarga','fecha','detalle'));
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
        $legajo = Veh012::find($id);
        $agregar = False;
        $edicion = True;    // True: Muestra botones Grabar - Cancelar   //  False: Muestra botones: Agregar, Editar, Borrar
        $active = 1;

        return "false";
    }


    public function delete_drop($id)
    {
        // return "Mostrar form de edit $id";
        $legajo = Veh012::find($id);
        $agregar = False;
        $edicion = True;    // True: Muestra botones Grabar - Cancelar   //  False: Muestra botones: Agregar, Editar, Borrar
        $active = 1;

        $legajo->delete();

        //return "false";
        return "{\"result\":\"ok\",\"id\":\"$legajo->id\"}";
    }
}
