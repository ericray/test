<?php

namespace App\Http\Controllers;

use App\Escuela;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\EscuelaRequest;
use Illuminate\Support\Facades\Response;

class EscuelaController extends Controller
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
        $escuelas = Escuela::all();
        $current = 'escuela';
        return view('admin.escuela.list')->with(compact('current','escuelas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $escuela = new Escuela();
        $title = 'Agregar escuela';
        $form_data = ['route' => 'admin.escuela.store'];

        return view('admin.escuela.form')->with(compact('title','form_data','escuela'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  EscuelaRequest  $request
     * @return Response
     */
    public function store(EscuelaRequest $request)
    {
        $escuela = new Escuela();
        $escuela->fill($request->all());
        $escuela->save();

        return redirect()->route('admin.escuela.index');
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
        $escuela = Escuela::findOrFail($id);
        $title = 'Editar escuela';
        $form_data = ['route' =>['admin.escuela.update',$escuela->id],'method' => 'PUT'];

        return view('admin.escuela.form')->with(compact('escuela','title','form_data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EscuelaRequest  $request
     * @param  int  $id
     * @return Response
     */
    public function update(EscuelaRequest $request, $id)
    {
        $escuela = Escuela::findOrFail($id);
        $escuela->fill($request->all());
        $escuela->save();

        return redirect()->route('admin.escuela.index');
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
        $escuela = Escuela::findOrFail($id);
        $escuela->delete();
        $escuelas = Escuela::all()->count();

        if($request->ajax()){
            return response()->json([
                'message' => 'Escuela eliminada',
                'num' => $escuelas
            ]);
        }

        return redirect()->route('admin.escuela.index');
    }
}
