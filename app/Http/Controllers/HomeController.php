<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Veh001;
use App\Veh007;     // Grupos de vehiculos
use App\Veh010;     // RTO
use App\Veh011;     // Multas
use App\Veh012;     // Siniestros
use App\Veh014;     // Pagos de impuestos (Patente)
use App\Veh015;     // Siniestros de terceros
use App\Veh025;     // Inicio de Baja o Vtas
use App\Veh026;     // Libre deuda de multa, Libre deuda de patente, informe de Dominio
use App\Veh027;     // Comprador

class HomeController extends Controller
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
        $legajoNew = new Veh010;

        $legajoNew->fecha = Carbon::parse(Carbon::now())->format('d/m/Y');
        $legajoNew->vencimient = Carbon::parse(new Carbon('next year'))->format('d/m/Y');
        $legajoNew->importe = 0.00;

        $siniestrosTer= null;
        $multas= null;


        if ($id == null) {
            $legajo = Veh001::first();      // find($id);     // dd($legajo);
        } else {
            $legajo = Veh001::find($id);

            if ($legajo == null)
                $legajo = Veh001::first();      // find($id);     // dd($legajo);   // $legajo = new Veh001;
          }

        // Si a pesar de todos los controles $legajo es null es porque no hay registros
        if ($legajo == null)
            $legajo = new Veh001;

        $id = $legajo->id;

        // Si la var. $direction muestra que el cursor se mueve (-1)
        if ($direction == -1) {
            $legajo = Veh001::where('id', '<', $id)
                ->orderBy('id', 'desc')
                ->first();

            if ($legajo == null)
                $legajo = Veh001::first();
        }

        // Si la var. $direction muestra que el cursor se mueve (+1)
        if ($direction == 1) {
            $legajo = Veh001::where('id', '>', $id)->first();

            if ($legajo == null)
                $legajo = Veh001::latest('id')->first();
        }

        // Si la var. $direction muestra que el cursor se mueve al final
        if ($direction == 9) {
            $legajo = Veh001::latest('id')->first();
        }

        $agregar = False;
        $edicion = False;    // True: Muestra botones Grabar - Cancelar   //  False: Muestra botones: Agregar, Editar, Borrar
        $active = 1;
        $legajo->f_alta = Carbon::parse($legajo->f_alta)->format('d/m/Y');

        // Datos de tablas anexas
        $novedades  = Veh010::orderBy('fecha')->where('dominio',$legajo->dominio)->paginate(8); // RTO
        $multas     = Veh011::orderBy('fecha')->where('dominio',$legajo->dominio)->paginate(8);
        $patentes   = Veh014::orderBy('fecha')->where('dominio',$legajo->dominio)->paginate(8);
        $siniestros = Veh012::orderBy('fecha')->where('dominio',$legajo->dominio)->paginate(8);
        $siniestrosTer = Veh015::orderBy('fecha')->where('dominio',$legajo->dominio)->paginate(8);
        $tipos      = Veh007::orderBy('codigo')->get();
        $baja       = Veh025::orderBy('dominio')->get()->where('dominio',$legajo->dominio)->first();

        if ($baja != null) {
          if ($baja->fecha != null) {
            $baja->fecha = Carbon::parse($baja->fecha)->format('d/m/Y');
          }
        }

        $comprador = Veh027::orderBy('dominio')->get()->where('dominio',$legajo->dominio)->first();
        $libreDM   = Veh026::orderBy('dominio')->get()->where('dominio',$legajo->dominio)->where('tramite',1)->first();
        if ($libreDM != null) {
            $libreDM->fecha = Carbon::parse($libreDM->fecha)->format('d/m/Y');
        }
        $libreDP   = Veh026::orderBy('dominio')->get()->where('dominio',$legajo->dominio)->where('tramite',2)->first();
        if ($libreDP != null) {
            $libreDP->fecha = Carbon::parse($libreDP->fecha)->format('d/m/Y');
        }
        $dominio   = Veh026::orderBy('dominio')->get()->where('dominio',$legajo->dominio)->where('tramite',3)->first();
        if ($dominio != null) {
            $dominio->fecha = Carbon::parse($dominio->fecha)->format('d/m/Y');
        }
        $denuncia  = Veh026::orderBy('dominio')->get()->where('dominio',$legajo->dominio)->where('tramite',4)->first();
        if ($denuncia != null) {
            $denuncia->fecha = Carbon::parse($denuncia->fecha)->format('d/m/Y');
        }
        $policial  = Veh026::orderBy('dominio')->get()->where('dominio',$legajo->dominio)->where('tramite',5)->first();
        if ($policial != null) {
            $policial->fecha = Carbon::parse($policial->fecha)->format('d/m/Y');
        }
        $ceta   = Veh026::orderBy('dominio')->get()->where('dominio',$legajo->dominio)->where('tramite',6)->first();
        if ($ceta != null) {
            $ceta->fecha = Carbon::parse($ceta->fecha)->format('d/m/Y');
        }
        $f381   = Veh026::orderBy('dominio')->get()->where('dominio',$legajo->dominio)->where('tramite',10)->first();
        if ($f381 != null) {
            $f381->fecha = Carbon::parse($f381->fecha)->format('d/m/Y');
        }
        $dnrpa   = Veh026::orderBy('dominio')->get()->where('dominio',$legajo->dominio)->where('tramite',11)->first();
        if ($dnrpa != null) {
            $dnrpa->fecha = Carbon::parse($dnrpa->fecha)->format('d/m/Y');
        }

        return view('home')->with(compact('legajo','agregar','edicion','active','novedades','patentes','siniestros',
          'multas','patentes','tipos','legajoNew','siniestrosTer','baja','comprador','libreDM','libreDP','dominio','denuncia','policial','ceta','f381','dnrpa'));
    }



    public function move(Request $request, $id = null)
    {
        if ($id == null) {
            $legajo = Veh001::first();      // find($id);     // dd($legajo);

        } elseif ($id == -1) {
            // Un registro hacia atras
            $codigo = $request->input('codigo');

            $legajo = Veh001::where('codigo', '<', $codigo)
                ->orderBy('id', 'desc')
                ->first();


            if ($legajo == null)
                $legajo = Veh001::first();

        } elseif ($id == -2) {
            // Un registro hacia adelant
            $codigo = $request->input('codigo');

            $legajo = Veh001::where('codigo', '>', $codigo)->first();

            if ($legajo == null)
                $legajo = Veh001::latest('codigo')->first();

        }

        if ($legajo->codigo > 0)
            return redirect('/home/'.$legajo->id);
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        $legajo = new Veh001;      // find($id);     // dd($legajo);
        $edicion = True;    // True: Muestra botones Grabar - Cancelar   //  False: Muestra botones: Agregar, Editar, Borrar
        $agregar = True;
        $active = 1;

        //$novedades = Veh010::orderBy('detalle')->paginate(8);
        //$siniestros = Veh010::orderBy('detalle')->where('tipo','Siniestros')->paginate(8);
        $tipos  = Veh007::orderBy('detalle')->get();

        $siniestrosTer= null;
        $multas= null;
        $baja= null;
        $siniestros = null;
        $novedades = null;

        $legajoNew = new Veh010;

        return view('home')->with(compact('legajo','agregar','edicion','active','tipos','novedades','siniestros','siniestrosTer','multas','baja','legajoNew'));
    }


    public function store(Request $request)
    {
        // Validaciones
        $messages = [
            'dominio.required'=>'El Dominio es obligatorio',
            'dominio.unique'=>'El Dominio ya existe',
            'codigo.required'=>'El Nro. de Interno es obligatorio',
            'codigo.max'=>'El Nro. de Interno es muy grande (5 max.)',
            'codigo.unique'=>'El Nro. de Interno ya existe',
            'detalle.required'=>'El detalle del vehiculo es obligatorio',
            'detalle.min'=>'El detalle debe tener más de 2 letras',
            'anio.integer'=>'El Año no es válido',
            'anio.max'=>'El Año no es válido',
            'f_alta.required'=>'La fecha de alta es obligatoria'
            ];

        $rules = [
            'dominio'=>'required|unique:veh001s',
            'codigo'=>'required|max:5|unique:veh001s',
            'detalle'=>'required|min:2',
            'anio'=>'integer|max:2040',
            'f_alta'=>'required'
            ];

        $this->validate($request, $rules, $messages);

        $legajo = new Veh001();
        //$request->all();
        //$legajo = Veh001::create($request->all()); // massives assignments : all() -> onLy() // only('name','description')

        $legajo->dominio = $request->input('dominio');
        $legajo->codigo = $request->input('codigo');
        $legajo->detalle = $request->input('detalle');
        $legajo->modelo= $request->input('modelo');
        $legajo->grupo = $request->input('grupo');
        $legajo->anio = $request->input('anio');
        $legajo->motor = $request->input('motor');
        $legajo->chasis = $request->input('chasis');
        $legajo->estado = $request->input('estado');
        $legajo->equipo = $request->input('equipo');
        $legajo->modelo_eq = $request->input('modelo_eq');

        $f_alta = str_replace('/', '-', $request->input('f_alta'));
        $legajo->f_alta = Carbon::createFromFormat("d-m-Y", $f_alta);

        $legajo->save();   // INSERT INTO - SQL

        return redirect('/home');
    }


    public function edit($id)
    {
        $legajoNew = new Veh010;

        $legajoNew->fecha = Carbon::parse(Carbon::now())->format('d/m/Y');
        $legajoNew->vencimient = Carbon::parse(new Carbon('next year'))->format('d/m/Y');
        $legajoNew->importe = 0.00;

        // return "Mostrar form de edit $id";
        $legajo = Veh001::find($id);
        $agregar = False;
        $edicion = True;    // True: Muestra botones Grabar - Cancelar   //  False: Muestra botones: Agregar, Editar, Borrar
        $active = 1;

        $legajo->f_alta = Carbon::parse($legajo->f_alta)->format('d/m/Y');

        // Datos de tablas anexas
        $novedades  = Veh010::orderBy('fecha')->where('dominio',$legajo->dominio)->paginate(8); // RTO
        $multas     = Veh011::orderBy('fecha')->where('dominio',$legajo->dominio)->paginate(8);
        $siniestros = Veh012::orderBy('fecha')->where('dominio',$legajo->dominio)->paginate(8);
        $siniestrosTer = Veh015::orderBy('fecha')->where('dominio',$legajo->dominio)->paginate(8);
        $tipos      = Veh007::orderBy('codigo')->get();
        $baja       = Veh025::orderBy('dominio')->get()->where('dominio',$legajo->dominio)->first();

        if ($baja != null) {
          if ($baja->fecha != null) {
            $baja->fecha = Carbon::parse($baja->fecha)->format('d/m/Y');
          }
        }

        $comprador = Veh027::orderBy('dominio')->get()->where('dominio',$legajo->dominio)->first();
        $libreDM   = Veh026::orderBy('dominio')->get()->where('dominio',$legajo->dominio)->where('tramite',1)->first();
        if ($libreDM != null) {
            $libreDM->fecha = Carbon::parse($libreDM->fecha)->format('d/m/Y');
        }
        $libreDP   = Veh026::orderBy('dominio')->get()->where('dominio',$legajo->dominio)->where('tramite',2)->first();
        if ($libreDP != null) {
            $libreDP->fecha = Carbon::parse($libreDP->fecha)->format('d/m/Y');
        }
        $dominio   = Veh026::orderBy('dominio')->get()->where('dominio',$legajo->dominio)->where('tramite',3)->first();
        if ($dominio != null) {
            $dominio->fecha = Carbon::parse($dominio->fecha)->format('d/m/Y');
        }
        $denuncia   = Veh026::orderBy('dominio')->get()->where('dominio',$legajo->dominio)->where('tramite',4)->first();
        if ($denuncia != null) {
            $denuncia->fecha = Carbon::parse($denuncia->fecha)->format('d/m/Y');
        }
        $policial   = Veh026::orderBy('dominio')->get()->where('dominio',$legajo->dominio)->where('tramite',5)->first();
        if ($policial != null) {
            $policial->fecha = Carbon::parse($policial->fecha)->format('d/m/Y');
        }
        $ceta   = Veh026::orderBy('dominio')->get()->where('dominio',$legajo->dominio)->where('tramite',6)->first();
        if ($ceta != null) {
            $ceta->fecha = Carbon::parse($ceta->fecha)->format('d/m/Y');
        }
        $f381   = Veh026::orderBy('dominio')->get()->where('dominio',$legajo->dominio)->where('tramite',10)->first();
        if ($f381 != null) {
            $f381->fecha = Carbon::parse($f381->fecha)->format('d/m/Y');
        }
        $dnrpa   = Veh026::orderBy('dominio')->get()->where('dominio',$legajo->dominio)->where('tramite',11)->first();
        if ($dnrpa != null) {
            $dnrpa->fecha = Carbon::parse($dnrpa->fecha)->format('d/m/Y');
        }


        return view('home')->with(compact('legajo','agregar','edicion','active','tipos','novedades','siniestros',
          'multas','tipos','legajoNew','siniestrosTer','baja','comprador','libreDM','libreDP','dominio','denuncia','policial','ceta','f381','dnrpa'));    // Abrir form de modificacion
    }


    public function update(Request $request, $id)
    {
        // Validaciones
        $messages = [
            'detalle.required'=>'El apellido es obligatorio',
            'detalle.min'=>'El apellido debe tener más de 2 letras',
            'f_alta.required'=>'La fecha de alta es obligatoria'
            ];

        $rules = [
            'detalle'=>'required|min:2',
            'f_alta'=>'required'
            ];


        // Grabar en bbdd los cambios del form de alta
        // dd($request->all());
        $legajo = Veh001::find($id);
        
        $legajo->codigo = $request->input('codigo');
        $legajo->grupo = $request->input('grupo');
        $legajo->modelo = $request->input('modelo');
        $legajo->motor = $request->input('motor');
        $legajo->chasis = $request->input('chasis');
        $legajo->empresa = $request->input('empresa');
        $legajo->estado = $request->input('estado');
        $legajo->equipo = $request->input('equipo');
        $legajo->modelo_eq = $request->input('modelo_eq');
        $legajo->inscripto = $request->input('inscripto');
        $f_alta = str_replace('/', '-', $request->input('f_alta'));

        if ($f_alta != "") {
            $legajo->f_alta = Carbon::createFromFormat("d-m-Y", $f_alta);
        } else {
            $legajo->f_alta = null;
        }

        //$request->alta = $legajo->alta;

        // Validacion de campos
        $this->validate($request, $rules, $messages);


        $legajo->update($request->only('codigo','detalle','modelo','grupo','anio','motor','chasis','equipo','modelo_eq','empresa','inscripto','numero','municipal','pin','vto_ruta','vto_tecni','f_alta','seccional','tramite','controlweb'));

        // dd($legajo->cod_centro);

        return redirect('/home/' . $id);
    }

    public function delete($id)
    {
        // return "Mostrar form de edit $id";
        $legajo = Veh001::find($id);
        $agregar = False;
        $edicion = True;    // True: Muestra botones Grabar - Cancelar   //  False: Muestra botones: Agregar, Editar, Borrar
        $active = 1;

        $legajo->delete();

        return redirect("/home");
    }

    public function search(Request $request)
    {
        $active = 1;
        //$legajos = Sue001::paginate(5);
        $legajos = Veh001::name($request->get('name'))->orderBy('codigo')->paginate(8);
        $name = $request->get('name');

        return view('search')->with(compact('legajos','active','name'));
    }


    public function search2(Request $request)
    {
        $active = 24;
        //$legajos = Sue001::orderBy('codigo')->paginate(8);
        $legajos = Veh001::name($request->get('name'))->orderBy('codigo')->paginate(8);
        $name = $request->get('name');

        return view('search2')->with(compact('legajos','active','name'));
    }


    public function search3(Request $request)
    {
        $active = 24;
        //$legajos = Sue001::orderBy('codigo')->paginate(8);
        $legajos = Veh001::name($request->get('name'))->orderBy('codigo')->paginate(8);
        $name = $request->get('name');

        return view('search3')->with(compact('legajos','active','name'));
    }


    public function test()
    {
        return view('test');
    }
}
