<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdministradorRequest;
use Illuminate\Support\Facades\Hash;
use App\Tipo;
use App\Http\Requests\EditPasswordRequest;
use Illuminate\Routing\Route;
use App\Http\Requests\AdministradorEditRequest;

class AdministradorController extends Controller
{
    protected $administador;

    public function __construct()
    {
        $this->beforeFilter('@getAdmin',['only' => ['update','edit','destroy','show']]);
        $this->middleware('admin_access');
    }

    public function getAdmin(Route $route)
    {
        $this->administador = User::findOrNew($route->getParameter('administrador'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $admins = User::getUserType('Administrador');
        $current = 'administrador';

        return view('admin.administrador.list')->with(compact('admins','current'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $admin = new User();
        $title = 'Agregar administrador';
        $form_data = ['route' => 'admin.administrador.store'];
        $accion = 'store';

        return view('admin.administrador.form')->with(compact('admin','title','form_data','accion'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AdministradorRequest  $request
     * @return Response
     */
    public function store(AdministradorRequest $request)
    {
        $tipo = Tipo::getByName('Administrador');
        $role = Role::getByName('administrador');

        $admin = new User();
        $admin->fill($request->all());
        $admin->password = Hash::make($request->input('password'));
        $admin->tipo_id = $tipo->id;
        $admin->save();
        $admin->attachRole($role->id);

        return redirect()->route('admin.administrador.index');
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
    public function edit($id)
    {
        $admin = $this->administador;
        $title = 'Editar administrador';
        $form_data = ['route' => ['admin.administrador.update',$this->administador->id],'method' => 'PUT'];
        return view('admin.administrador.form')->with(compact('admin','form_data','title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AdministradorRequest  $request
     * @param  int  $id
     * @return Response
     */
    public function update(AdministradorEditRequest $request, $id)
    {
        $this->administador->fill($request->all());
        $this->administador->password = Hash::make($request->input('password'));
        $this->administador->save();

        return redirect()->route('admin.administrador.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function destroy($id,Request $request)
    {
        $this->administador->delete();
        $administradores = User::getByType('Administrador');
        if($request->ajax()){
            return response()->json([
                'message' => 'Administrador: "'.$this->administador->name.'" eliminado.',
                'num' => $administradores->count()
            ]);
        }

        return redirect()->route('admin.administrador.index');
    }

    public function getEditPassword($id)
    {
        $resource = 'administrador';
        $user = User::findOrFail($id);
        return view('partials.edit_password')->with(compact('id','resource','user'));
    }

    public function postEditPassword($id,EditPasswordRequest $request)
    {
        $admin = User::findOrFail($id);
        $admin->password = Hash::make($request->input('password'));
        $admin->save();

        return redirect()->route('admin.administrador.index');
    }
}