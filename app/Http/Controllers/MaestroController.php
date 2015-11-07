<?php

namespace App\Http\Controllers;

use App\Escuela;
use App\Estado;
use App\Grupo;
use App\Sexo;
use App\Tipo;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\MaestroRequest;
use App\Http\Requests\MaestroEditRequest;
use Illuminate\Routing\Route;

class MaestroController extends Controller
{
    protected $escuela_id = 0;

    public function __construct()
    {
        $this->escuela_id = \Auth::user()->escuela_id;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $maestros = User::getByType('Maestro',$this->escuela_id);
        $current = 'maestro';

        return view('admin.maestro.list')->with(compact('maestros','current'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $maestro = new User();
        $generos = Sexo::all();

        $estados = Estado::orderBy('descripcion')->lists('descripcion','id');
        $escuelas = [];
        $grupos   = [];

        $title = 'Agregar mestros';
        $form_data = ['route' => 'admin.maestro.store'];

        return view('admin.maestro.form')->with(compact('maestro','title','form_data','generos','estados','escuelas','grupos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(MaestroRequest $request)
    {
        $tipo = Tipo::byName('Maestro');
        $maestro = new User();
        $maestro->fill($request->all());
        $maestro->password = \Hash::make($request->input('password'));
        $maestro->tipo_id = $tipo->id;
        $maestro->estatus_id = 0;
        $maestro->save();

        return redirect()->route('admin.maestro.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id,Route $route)
    {
        $action = $route->getName();
        $action = explode('.',$action);
        $action = array_pop($action);

        //Listas
        $generos = Sexo::all();
        $estados = Estado::orderBy('descripcion')->lists('descripcion','id');
        $escuelas = Escuela::all()->lists('nombre','id');
        $grupos   = Grupo::all()->lists('descripcion','id');
        //
        $maestro = User::findOrFail($id);
        $form_data = ['route' => ['admin.maestro.update',$maestro->id],'method' => 'PUT'];
        $title = 'Editar maestro';

        return view('admin.maestro.form')->with(compact('maestro','form_data','title','generos','estados','grupos','escuelas','action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(MaestroEditRequest $request, $id)
    {
        $maestro = User::findOrFail($id);
        $maestro->fill($request->all());
        if($request->has('password'))
            $maestro->password = $request->input('password');
        $maestro->save();

        return redirect()->route('admin.maestro.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        $maestro = User::findOrFail($id);
        $maestro->delete();
        $maestros = User::getByType('Maestro');

        if($request->ajax())
            return response()->json([
                'message' => 'Maestro: "' . $maestro->name . '" eliminado',
                'num' => $maestros->count()
            ]);

        return redirect()->route('admin.maestro.index');
    }
}
