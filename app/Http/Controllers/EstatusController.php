<?php

namespace App\Http\Controllers;

use App\Estado;
use App\Estatus;
use App\Tabla;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\EstatusRequest;

class EstatusController extends Controller
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
        $estatus = Estatus::all();
        $current = 'estatus';
        return view('admin.estatus.list')->with(compact('estatus','current'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $estatus = new Estatus();
        $tablas  = Tabla::all()->lists('descripcion','id');
        $title = 'Agregar estatus';
        $form_data = ['route' => 'admin.estatus.store','class' => 'form-horizontal'];

        return view('admin.estatus.form')->with(compact('estatus','title','form_data','tablas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  EstatusRequest  $request
     * @return Response
     */
    public function store(EstatusRequest $request)
    {
        $estatus = new Estatus();
        $estatus->fill($request->all());
        $estatus->save();

        return redirect()->route('admin.estatus.index');
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
        $estatus   = Estatus::findOrFail($id);
        $tablas    = Tabla::all()->lists('descripcion','id');
        $title     = 'Editar estatus';
        $form_data = ['route' => ['admin.estatus.update',$estatus->id],'method' => 'PUT','class' => 'form-horizontal'];

        return view('admin.estatus.form')->with(compact('estatus','tablas','title','form_data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EstatusRequest  $request
     * @param  int  $id
     * @return Response
     */
    public function update(EstatusRequest $request, $id)
    {
        $estatus = Estatus::findOrFail($id);
        $estatus->fill($request->all());
        $estatus->save();

        return redirect()->route('admin.estatus.index');
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
        $estatus = Estatus::findOrFail($id);
        $estatus->delete();
        $num_estatus = Estatus::all()->count();

        if($request->ajax()){
            return response()->json([
                'message' => 'Estatus : "'.$estatus->descripcion.'" eliminado',
                'num' => $num_estatus
            ]);
        }

        return redirect()->route('admin.estatus.index');
    }
}
