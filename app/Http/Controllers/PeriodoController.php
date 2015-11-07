<?php

namespace App\Http\Controllers;

use App\Periodo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\PeriodoRequest;

class PeriodoController extends Controller
{
    protected $escuela_id = 0;

    public function __construct()
    {
        $this->escuela_id = (\Auth::user()) ? \Auth::user()->escuela_id : 0;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

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
    public function store(PeriodoRequest $request)
    {
        $periodo = new Periodo();
        $periodo->fill($request->all());
        $periodo->save();

        if($request->ajax())
            return response()->json([
                'redirectTo' => url('/'),
                'message' => 'Periodo creado'
            ]);

        return redirect()->route('periodo.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $periodo = Periodo::findOrFail($id);
        $title = $periodo->descripcion;

        return view('public.periodo.show')->with(compact('periodo','title'));
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
    public function update(PeriodoRequest $request, $id)
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

    public function periodosJson(Request $request)
    {
        if($request->ajax()){
            $searchPhrase = ($request->has('searchPhrase')) ? $request->input('searchPhrase') : "";
            $sort = ($request->has('sort')) ? $request->input('sort')['descripcion'] : 'ASC';
            $rowCount = ($request->has('rowCount')) ? $request->input('rowCount') : 10;
            $periodo = Periodo::where('descripcion','LIKE',"%$searchPhrase%")
                ->where('escuela_id',$this->escuela_id)
                ->orderBy('descripcion',$sort)
                ->get();

            $data = [
                'current' => 1,
                'rowCount' => $rowCount,
                'rows' => $periodo,
                'total' => $periodo->count()
            ];

            return response()->json($data);
        }

        return response('No autorizado',422);
    }
}
