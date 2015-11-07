<?php

namespace App\Http\Controllers;

use App\Tabla;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\TablaRequest;

class TablaController extends Controller
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
        $tablas = Tabla::all();
        $current = 'tabla';

        return view('admin.tabla.list')->with(compact('tablas','current'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $tabla = new Tabla();
        $title = 'Agregar tabla';
        $form_data = ['route' => 'admin.tabla.store','class' => 'form-horizontal'];

        return view('admin.tabla.form')->with(compact('tabla','title','form_data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TablaRequest  $request
     * @return Response
     */
    public function store(TablaRequest $request)
    {
        $tabla = new Tabla();
        $tabla->fill($request->all());
        $tabla->save();

        return redirect()->route('admin.tabla.index');
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
        $tabla = Tabla::findOrFail($id);
        $title = 'Editar tabla';
        $form_data = ['route' => ['admin.tabla.update',$tabla->id],'method' => 'PUT','class' => 'form-horizontal'];

        return view('admin.tabla.form')->with(compact('tabla','title','form_data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TablaRequest  $request
     * @param  int  $id
     * @return Response
     */
    public function update(TablaRequest $request, $id)
    {
        $tabla = Tabla::findOrFail($id);
        $tabla->fill($request->all());
        $tabla->save();

        return redirect()->route('admin.tabla.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param Request $request
     * @return Response
     */
    public function destroy($id,Request $request)
    {
        $tabla = Tabla::findOrFail($id);
        $tabla->delete();
        $tablas = Tabla::all()->count();

        if($request->ajax()){
            return response()->json([
                'message' => 'Tabla: "' .$tabla->descripcion. '" eliminada',
                'num' => $tablas
            ]);
        }

        return redirect()->route('admin.tabla.index');
    }
}
