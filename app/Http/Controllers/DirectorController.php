<?php

namespace App\Http\Controllers;

use App\Escuela;
use App\Estado;
use App\Role;
use App\Sexo;
use App\Tipo;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\DirectorRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\EditPasswordRequest;
use Illuminate\Routing\Route;
use Monolog\Handler\RotatingFileHandler;

class DirectorController extends Controller
{
    protected $director;

    /**
     * The constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->beforeFilter('@getDirector',['only' => ['edit','update','show','destroy']]);
        $this->middleware('admin_access');
    }

    public function getDirector(Route $route)
    {
        $this->director = User::findOrFail($route->getParameter('director'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $directores = User::getUserType('Director');
        $current = 'director';

        return view('admin.director.list')->with(compact('directores', 'current'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $director = new User();
        $sexos = Sexo::all()->lists('descripcion', 'id');
        $estados = Estado::all()->lists('descripcion', 'id');
        $escuelas = Escuela::all()->lists('nombre', 'id');
        $title = 'Agregar director';
        $accion = 'store';
        $form_data = ['route' => 'admin.director.store'];

        return view('admin.director.form')->with(compact('director', 'title', 'form_data', 'sexos', 'estados', 'escuelas', 'accion'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  DirectorRequest $request
     * @return Response
     */
    public function store(DirectorRequest $request)
    {
        $role = Role::getByName('administrador');
        $director = new User();
        $director->fill($request->all());
        $tipo = Tipo::getByName('Director');
        $director->tipo_id = $tipo->id;
        $director->password = Hash::make($request->input('password'));
        $director->save();
        $director->attachRole($role->id);

        return redirect()->route('admin.director.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $director = $this->director;
        $estados = Estado::all()->lists('descripcion', 'id');
        $sexos = Sexo::all()->lists('descripcion', 'id');
        $escuelas = Escuela::all()->lists('nombre', 'id');
        $title = 'Editar director';
        $form_data = ['route' => ['admin.director.update', $director->id], 'method' => 'PATCH'];
        return view('admin.director.form')->with(compact('form_data', 'title', 'director', 'estados', 'sexos', 'escuelas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  DirectorRequest $request
     * @param  int $id
     * @return Response
     */
    public function update($id, DirectorRequest $request)
    {
        $this->director->fill($request->all());
        $this->director->password = Hash::make($request->input('password'));
        $this->director->save();

        return redirect()->route('admin.director.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     * @param  int $id
     * @return Response
     */
    public function destroy($id, Request $request)
    {
        $this->director->delete();
        $directores = User::getByType('Director');

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Director "' . $this->director->name . '" eliminado.',
                'num' => $directores->count()
            ]);
        }

        return redirect()->route('admin.director.index');
    }

    /**
     * Form for edit password
     *
     * @param $id
     * @return Response
     */
    public function getEditPassword($id)
    {
        $resource = 'director';
        $user = User::findOrFail($id);

        return view('partials.edit_password')->with(compact('id','resource','user'));
    }

    /**
     * Action for edit password
     *
     * @param EditPasswordRequest $request
     * @param $id
     * @return Response
     */
    public function postEditPassword($id,EditPasswordRequest $request)
    {
        $director = User::findOrFail($id);
        $director->password = \Hash::make($request->input('password'));
        $director->save();

        return redirect()->route('admin.director.index');
    }
}
