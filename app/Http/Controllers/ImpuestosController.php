<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Veh001;
use App\Veh007;     // Grupos de vehiculos
use App\Veh014;     // Multas

class ImpuestosController extends Controller
{
    public function add()
    {
        $legajo = new Veh014;      // find($id);     // dd($legajo);
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
            'patente_fecha.required'=>'La fecha es obligatoria'
            ];

        $rules = [
            'patente_fecha'=>'required'
            ];

        $this->validate($request, $rules, $messages);

        //$request->validate([
        //    'legajo' => ['required', 'integer', new LegajoExiste],
        //]);

        $legajo = new Veh014();

        $legajo->unidad = $request->input('patente_interno');
        $legajo->dominio = $request->input('patente_dominio');
        $legajo->importe = $request->input('patente_importe');
        $legajo->detalle = $request->input('patente_detalle');

        $legajo->periodo = $request->input('patente_periodo');
        $legajo->periodo = substr($legajo->periodo,3,4) . '/' . substr($legajo->periodo,0,2);

        $date = str_replace('/', '-', $request->input('patente_fecha'));
        $legajo->fecha = Carbon::createFromFormat("d-m-Y", $date);

        //$date2 = str_replace('/', '-', $request->input('patente_fecha_pgo'));
        //$legajo->fecha_pago = Carbon::createFromFormat("d-m-Y", $date2);

        $legajo->save();

        $exibirmodal = false;

        return redirect('/home');
    }



    public function edit($id, $page = 1)
    {
        // id a NovedadesController:edit2() ver de unificar
        $legajo = Veh014::find($id);

        $legajo->fecha = Carbon::parse($legajo->fecha)->format('d/m/Y');

        return $legajo;
    }


    public function update(Request $request, $id)
    {
        // Validaciones
        /*if ($request->input('btngrabarM') == 'grabar') {
            $messages = [
                'cantidadEdit.required'=>'La cantidad es obligatoria'
                ];

            $rules = [
                'cantidadEdit'=>'required'
                ];

            $this->validate($request, $rules, $messages);
        }
        */

        $legajo = Veh014::find($id);

        $fecha = str_replace('/', '-', $request->input('patente_fecha_edit'));
        $legajo->fecha = Carbon::createFromFormat("d-m-Y", $fecha);

        //$fecha = str_replace('/', '-', $request->input('patente_ed_fecha_pgo'));
        //$legajo->fecha_pago = Carbon::createFromFormat("d-m-Y", $fecha);
        $legajo->importe = $request->input('patente_ed_importe');
        $legajo->detalle = $request->input('patente_ed_comenta');
        $legajo->encarga = $request->input('patente_edit_encarga');
        //$legajo->nro_siniestro = $request->input('nro_siniestro_edit');


        if ($request->input('btngrabarM') == 'grabar') {
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
        $legajo = Veh014::find($id);
        $agregar = False;
        $edicion = True;    // True: Muestra botones Grabar - Cancelar   //  False: Muestra botones: Agregar, Editar, Borrar
        $active = 1;

        return "false";
    }


    public function delete_drop($id)
    {
        // return "Mostrar form de edit $id";
        $legajo = Veh014::find($id);
        $agregar = False;
        $edicion = True;    // True: Muestra botones Grabar - Cancelar   //  False: Muestra botones: Agregar, Editar, Borrar
        $active = 1;

        $legajo->delete();

        //return "false";
        return "{\"result\":\"ok\",\"id\":\"$legajo->id\"}";
    }
}
