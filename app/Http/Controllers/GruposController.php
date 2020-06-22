<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Veh001;
use App\Veh007;
use App\Veh010;

class GruposController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = null, $direction = null)
    {
        if ($id == null) {
              $legajo = Veh007::first();      // find($id);     // dd($legajo);

          } else {
              $legajo = Veh007::find($id);

              if ($legajo == null)
                  $legajo = Veh007::first();      // find($id);     // dd($legajo);   // $legajo = new Veh007;
          }

        // Si a pesar de todos los controles $legajo es null es porque no hay registros
        if ($legajo == null)
            $legajo = new Veh007;

        $id = $legajo->id;

        // Si la var. $direction muestra que el cursor se mueve (-1)
        if ($direction == -1) {
            $legajo = Veh007::where('id', '<', $id)
                ->orderBy('id', 'desc')
                ->first();

            if ($legajo == null)
                $legajo = Veh007::first();
        }

        // Si la var. $direction muestra que el cursor se mueve (+1)
        if ($direction == 1) {
            $legajo = Veh007::where('id', '>', $id)->first();

            if ($legajo == null)
                $legajo = Veh007::latest('id')->first();
        }


        // Si la var. $direction muestra que el cursor se mueve al final
        if ($direction == 9) {
            $legajo = Veh007::latest('id')->first();
        }


        $agregar = False;
        $edicion = False;    // True: Muestra botones Grabar - Cancelar   //  False: Muestra botones: Agregar, Editar, Borrar
        $active = 7;
        $legajo->fecha_naci = Carbon::parse($legajo->fecha_naci)->format('d/m/Y');
        $legajo->alta = Carbon::parse($legajo->alta)->format('d/m/Y');
        $legajo->fecha_vto = Carbon::parse($legajo->fecha_vto)->format('d/m/Y');

        return view('tipos.index')->with(compact('legajo','agregar','edicion','active'));
    }


    public function move(Request $request, $id = null)
    {
        if ($id == null) {
            $legajo = Veh007::first();      // find($id);     // dd($legajo);

        } elseif ($id == -1) {
            // Un registro hacia atras
            $codigo = $request->input('codigo');

            $legajo = Veh007::where('codigo', '<', $codigo)
                ->orderBy('id', 'desc')
                ->first();


            if ($legajo == null)
                $legajo = Veh007::first();

        } elseif ($id == -2) {
            // Un registro hacia adelant
            $codigo = $request->input('codigo');

            dd($codigo);

            $legajo = Veh007::where('codigo', '>', $codigo)->first();

            if ($legajo == null)
                $legajo = Veh007::latest('codigo')->first();

        }

        if ($legajo->codigo > 0)
            return redirect('/tipos/'.$legajo->id);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        $legajo = new Veh007;      // find($id);     // dd($legajo);
        $edicion = True;    // True: Muestra botones Grabar - Cancelar   //  False: Muestra botones: Agregar, Editar, Borrar
        $agregar = True;
        $active = 7;

        return view('tipos.index')->with(compact('legajo','agregar','edicion','active'));
    }


    public function store(Request $request)
    {
        // Validaciones
        $messages = [
            'codigo.required'=>'El Nro. del tipo de vehiculo es obligatorio',
            'codigo.unique'=>'El Nro. del tipo de vehiculo ya existe',
            'detalle.required'=>'La descripcion es obligatorio',
            'detalle.min'=>'La descripcion debe tener más de 2 letras'
            ];

        $rules = [
            'codigo'=>'required|unique:veh007s',
            'detalle'=>'required|min:2'
            ];

        $this->validate($request, $rules, $messages);

        $legajo = new Veh007();
        //$request->all();
        //$legajo = Sue001::create($request->all()); // massives assignments : all() -> onLy() // only('name','description')

        $legajo->codigo = $request->input('codigo');
        $legajo->detalle = $request->input('detalle');

        $legajo->save();   // INSERT INTO - SQL

        if ($legajo->codigo > 0)
            return redirect('/tipos');
    }


    public function edit($id)
    {
        // return "Mostrar form de edit $id";
        $legajo = Veh007::find($id);
        $agregar = False;
        $edicion = True;    // True: Muestra botones Grabar - Cancelar   //  False: Muestra botones: Agregar, Editar, Borrar
        $active = 7;

        $legajo->fecha_naci = Carbon::parse($legajo->fecha_naci)->format('d/m/Y');
        $legajo->alta = Carbon::parse($legajo->alta)->format('d/m/Y');
        $legajo->fecha_vto = Carbon::parse($legajo->fecha_vto)->format('d/m/Y');

        return view('tipos.index')->with(compact('legajo','agregar','edicion','active'));
    }


    public function update(Request $request, $id)
    {
        // Validaciones
        $messages = [
            'detalle.required'=>'El apellido es obligatorio',
            'detalle.min'=>'El apellido debe tener más de 2 letras',
            ];

        $rules = [
            'detalle'=>'required|min:2'
            ];


        // Grabar en bbdd los cambios del form de alta
        // dd($request->all());
        $legajo = Veh007::find($id);

        $legajo->codigo = $request->input('codigo');
        $legajo->detalle = $request->input('detalle');

        // Validacion de campos
        $this->validate($request, $rules, $messages);


        $legajo->update($request->only('detalle','nombres','cuil','domici','nro','piso','dpto','locali','provin','cod_pos','telef','condicion','convenio','situacion','forma_pago','est_civil','salud','incap','nacionali','fecha','cod_centro','cod_jerarq','cod_categ','codsector','funcion'));

        // dd($legajo->cod_centro);

        return redirect('/tipos');
    }


    public function delete($id)
    {
        // return "Mostrar form de edit $id";
        $legajo = Veh007::find($id);
        $agregar = False;
        $edicion = True;    // True: Muestra botones Grabar - Cancelar   //  False: Muestra botones: Agregar, Editar, Borrar
        $active = 7;

        $legajo->delete();

        return redirect("/tipos/");
    }



    public function search(Request $request)
    {
        $active = 7;
        //$legajos = Sue001::paginate(5);
        $legajos = Veh007::name($request->get('name'))->orderBy('codigo')->paginate(8);
        $name = $request->get('name');

        return view('tipos.search')->with(compact('legajos','active','name'));
    }
}
