<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Veh001;
use App\Veh002;
use App\Veh007;   // Tipos de vehiculos
use App\Veh010;   // RTO
use App\Veh011;   // Multas
use App\Veh012;   // Siniestros
use App\Veh015;   // Siniestros de terceros
use App\Veh025;   // Inicio venta
use App\Veh026;   // Libre deuda de multa, Libre deuda de patente, informe de Dominio
use App\Veh027;   // Comprador

class BajasController extends Controller
{
    // Indice inicial de CRUD de Legajos de Baja
    public function index($id = null, $direction = null)
    {
        $legajoNew = new Veh010;

        //$legajoNew->fecha = Carbon::parse(Carbon::now())->format('d/m/Y');
        //$legajoNew->vencimient = Carbon::parse(new Carbon('next year'))->format('d/m/Y');
        //$legajoNew->importe = 0.00;

        if ($id == null) {
              $legajo = Veh002::first();

        } else
        {
              $legajo = Veh002::find($id);

              if ($legajo == null)
                  $legajo = Veh002::first();
          }

        // Si a pesar de todos los controles $legajo es null es porque no hay registros
        if ($legajo == null)
            $legajo = new Veh002;

        $id = $legajo->id;

        // Si la var. $direction muestra que el cursor se mueve (-1)
        if ($direction == -1) {
            $legajo = Veh002::where('id', '<', $id)
                ->orderBy('id', 'desc')
                ->first();

            if ($legajo == null)
                $legajo = Veh002::first();
        }

        // Si la var. $direction muestra que el cursor se mueve (+1)
        if ($direction == 1) {
            $legajo = Veh002::where('id', '>', $id)->first();

            if ($legajo == null)
                $legajo = Veh002::latest('id')->first();
        }


        // Si la var. $direction muestra que el cursor se mueve al final
        if ($direction == 9) {
            $legajo = Veh002::latest('id')->first();
        }

        $agregar = False;
        $edicion = False;    // True: Muestra botones Grabar - Cancelar   //  False: Muestra botones: Agregar, Editar, Borrar
        $active = 2;
        $legajo->f_alta = Carbon::parse($legajo->f_alta)->format('d/m/Y');

        // Combos de tablas anexas
        $novedades   = Veh010::orderBy('detalle')->where('dominio',$legajo->dominio)->paginate(8);
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

        return view('bajas.index')->with(compact('legajo','agregar','edicion','active','novedades','siniestros',
            'multas','tipos','legajoNew','siniestrosTer','baja','comprador','libreDM','libreDP','dominio','denuncia','policial','ceta','f381','dnrpa'));;
    }



    public function add()
    {
        $legajo = new Veh002;      // find($id);     // dd($legajo);
        $edicion = True;    // True: Muestra botones Grabar - Cancelar   //  False: Muestra botones: Agregar, Editar, Borrar
        $agregar = True;
        $active = 1;

        $novedades = Veh010::orderBy('detalle')->paginate(8);
        $siniestros = Veh010::orderBy('detalle')->where('tipo','Siniestros')->paginate(8);
        $tipos  = Veh007::orderBy('detalle')->get();

        return view('bajas.index')->with(compact('legajo','agregar','edicion','active','tipos','novedades','siniestros'));
    }


    public function store(Request $request)
    {
        // Validaciones
        $messages = [
            'dominio.required'=>'El Dominio es obligatorio',
            'dominio.unique'=>'El Dominio ya existe',
            'codigo.required'=>'El Nro. de legajo es obligatorio',
            'codigo.unique'=>'El Nro. de legajo ya existe',
            'detalle.required'=>'El detalle del vehiculo es obligatorio',
            'detalle.min'=>'El detalle debe tener más de 2 letras',
            'f_alta.required'=>'La fecha de alta es obligatoria'
            ];

        $rules = [
            'dominio'=>'required|unique:veh001s',
            'codigo'=>'required|unique:veh001s',
            'detalle'=>'required|min:2',
            'f_alta'=>'required'
            ];

        $this->validate($request, $rules, $messages);

        $legajo = new Veh002();
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

        if ($legajo->codigo > 0)
            return redirect('/bajas');
    }


    public function edit($id)
    {
        // return "Mostrar form de edit $id";
        $legajo = Veh002::find($id);
        $agregar = False;
        $edicion = True;    // True: Muestra botones Grabar - Cancelar   //  False: Muestra botones: Agregar, Editar, Borrar
        $active = 1;

        $legajo->f_alta = Carbon::parse($legajo->f_alta)->format('d/m/Y');

        $novedades = Veh010::orderBy('detalle')->paginate(8);
        $siniestros = Veh010::orderBy('detalle')->where('tipo','Siniestros')->paginate(8);
        $tipos  = Veh007::orderBy('detalle')->get();

        return view('bajas.index')->with(compact('legajo','agregar','edicion','active','tipos','novedades','siniestros'));    // Abrir form de modificacion
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
        $legajo = Veh002::find($id);

        $legajo->modelo = $request->input('modelo');
        $legajo->grupo = $request->input('grupo');
        $legajo->modelo = $request->input('modelo');
        $legajo->motor = $request->input('motor');
        $legajo->chasis = $request->input('chasis');
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


        $legajo->update($request->only('detalle','nombres','cuil','domici','nro','piso','dpto','locali','provin','cod_pos','telef','condicion','convenio','situacion','forma_pago','est_civil','salud','incap','nacionali','fecha','cod_centro','cod_jerarq','cod_categ','codsector','funcion'));

        // dd($legajo->cod_centro);

        return redirect('/bajas');
    }

    public function search(Request $request)
    {
        $active = 2;
        //$legajos = Sue001::paginate(5);
        $legajos = Veh002::name($request->get('name'))->orderBy('codigo')->paginate(8);
        $name = $request->get('name');

        return view('bajas.search')->with(compact('legajos','active','name'));
    }

    public function vender($id)
    {
        // return "Mostrar form de edit $id";
        $dominio = Veh001::find($id)->dominio;

        if ($dominio != null) {
            $venta = Veh025::where('dominio', '=', $dominio)->first();

            if ($venta == null) {
                return "{\"result\":\"ok\",\"id\":\"$id\"}";
            } else {
                if ($venta->tipo_baja != 'Venta') {
                    return "{\"result\":\"ok\",\"id\":\"$id\"}";
                }
            }

            $legajo = Veh026::where('dominio', '=', $dominio)->where('tramite',5)->first();

            //$legajo->fecha = Carbon::parse($legajo->fecha)->format('d/m/Y');
        } else {
            $legajo = null;
        }

        return "false";
    }


    public function vender_confirma($id)
    {
        // return "Mostrar form de edit $id";
        $dominio = Veh001::find($id);

        if ($dominio != null) {
            $baja = new Veh002();
            //$request->all();
            //$baja = Veh001::create($request->all()); // massives assignments : all() -> onLy() // only('name','description')

            $baja->dominio= $dominio->dominio;
            $baja->codigo = $dominio->codigo;
            $baja->detalle= $dominio->detalle;
            $baja->domic  = $dominio->domic;
            $baja->encargado = $dominio->encargado;
            $baja->depos  = $dominio->depos;
            $baja->modelo = $dominio->modelo;
            $baja->anio   = $dominio->anio;
            $baja->motor = $dominio->motor;
            $baja->chasis = $dominio->chasis;
            $baja->titulo_ori = $dominio->titulo_ori;
            $baja->modelo2 = $dominio->modelo2;
            $baja->estado = $dominio->estado;
            $baja->inscripto = $dominio->inscripto;
            $baja->numero = $dominio->numero;
            $baja->municipal = $dominio->municipal;
            $baja->pin = $dominio->pin;
            $baja->vto_ruta = $dominio->vto_ruta;
            $baja->equipo = $dominio->equipo;
            $baja->modelo_eq = $dominio->modelo_eq;
            $baja->f_alta = $dominio->f_alta;
            $baja->f_baja = Carbon::today();

            $baja->save();   // INSERT INTO - SQL

            $dominio->delete();
        } else {
            $legajo = null;

            return "false";
        }

        return "{\"result\":\"ok\",\"id\":\"$id\"}";
    }


    public function baja_otros($id)
    {
        // return "Mostrar form de edit $id";
        $dominio = Veh001::find($id)->dominio;

        if ($dominio != null) {
            $venta = Veh025::where('dominio', '=', $dominio)->first();

            if ($venta == null) {
                return "{\"result\":\"ok\",\"id\":\"$id\"}";
            } else {
                if ($venta->tipo_baja == 'Venta') {
                    return "{\"result\":\"ok\",\"id\":\"$id\"}";
                }
            }

            $legajo = Veh026::where('dominio', '=', $dominio)->where('tramite',10)->first();

            //$legajo->fecha = Carbon::parse($legajo->fecha)->format('d/m/Y');
        } else {
            $legajo = null;
        }

        return "false";
    }


    public function baja_otros_confirma($id)
    {
        // return "Mostrar form de edit $id";
        $dominio = Veh001::find($id);

        if ($dominio != null) {
            $baja = new Veh002();
            //$request->all();
            //$baja = Veh001::create($request->all()); // massives assignments : all() -> onLy() // only('name','description')

            $baja->dominio= $dominio->dominio;
            $baja->codigo = $dominio->codigo;
            $baja->detalle= $dominio->detalle;
            $baja->domic  = $dominio->domic;
            $baja->encargado = $dominio->encargado;
            $baja->depos  = $dominio->depos;
            $baja->modelo = $dominio->modelo;
            $baja->anio   = $dominio->anio;
            $baja->motor = $dominio->motor;
            $baja->chasis = $dominio->chasis;
            $baja->titulo_ori = $dominio->titulo_ori;
            $baja->modelo2 = $dominio->modelo2;
            $baja->estado = $dominio->estado;
            $baja->inscripto = $dominio->inscripto;
            $baja->numero = $dominio->numero;
            $baja->municipal = $dominio->municipal;
            $baja->pin = $dominio->pin;
            $baja->vto_ruta = $dominio->vto_ruta;
            $baja->equipo = $dominio->equipo;
            $baja->modelo_eq = $dominio->modelo_eq;
            $baja->f_alta = $dominio->f_alta;
            $baja->f_baja = Carbon::today();

            $baja->save();   // INSERT INTO - SQL

            $dominio->delete();
        } else {
            $legajo = null;

            return "false";
        }

        return "{\"result\":\"ok\",\"id\":\"$id\"}";
    }
}
