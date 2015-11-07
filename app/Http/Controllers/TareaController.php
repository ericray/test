<?php

namespace App\Http\Controllers;

use App\CalificacionTarea;
use App\Tarea;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CalificarTareaRequest;

class TareaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function getCalificarTarea($alumno_id,$tarea_id)
    {
        $alumno = User::findOrFail($alumno_id);
        $tarea = Tarea::findOrFail($tarea_id);
        $title = 'Calificar tarea "' . $tarea->nombre . '"';

        return view('public.tarea.calificar_tarea')->with(compact('title','tarea','alumno'));
    }

    public function postCalificarTarea(CalificarTareaRequest $request)
    {
        $calif_tarea = new CalificacionTarea();
        $calif_tarea->fill($request->all());
        $calif_tarea->periodo_id = 0;
        $calif_tarea->alumno_id = $request->input('alumno_id');
        $calif_tarea->tarea_id = $request->input('tarea_id');
        $calif_tarea->save();

        return response('bien');
    }
}
