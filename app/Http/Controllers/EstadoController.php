<?php

namespace App\Http\Controllers;

use App\Estado;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\EstadoRequest;

class EstadoController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin_access');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $estados = Estado::orderBy('descripcion')->get();
        $current = 'estado';
        return view('admin.estado.list')->with(compact('estados','current'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $estado = new Estado();
        $title = 'Agregar estado';
        $form_data = ['route' => 'admin.estado.store','class' => 'form-horizontal'];

        return view('admin.estado.form')->with(compact('estado','title','form_data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  EstadoRequest  $request
     * @return Response
     */
    public function store(EstadoRequest $request)
    {
        $estado = new Estado();
        $estado->fill($request->all());
        $estado->save();

        return redirect()->route('admin.estado.index');
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
        $estado = Estado::findOrFail($id);
        $title = 'Editar estado';
        $form_data = ['route' => ['admin.estado.update',$estado->id],'method' => 'PUT','class' => 'form-horizontal'];

        return view('admin.estado.form')->with(compact('estado','title','form_data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EstadoRequest  $request
     * @param  int  $id
     * @return Response
     */
    public function update(EstadoRequest $request, $id)
    {
        $estado = Estado::findOrFail($id);
        $estado->fill($request->all());
        $estado->save();

        return redirect()->route('admin.estado.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param Request $request
     * @return Response
     */
    public function destroy($id, Request $request)
    {
        $estado = Estado::findOrFail($id);
        $estado->delete();
        $estados = Estado::all()->count();

        if($request->ajax()){
            return response()->json([
                'message' => 'Estado "'. $estado->descripcion . '" eliminado',
                'num' => $estados
            ]);
        }

        return redirect()->route('admin.estado.index');
    }
}