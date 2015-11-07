<?php

namespace App\Http\Controllers;

use App\Periodo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Grupo;
use App\Escuela;

class PublicPagesController extends Controller
{
    protected $escuela_id = 0;
    protected $grupo_id = 0;

    public function __construct()
    {
        $this->escuela_id = (\Auth::user()) ? \Auth::user()->escuela_id : 0;
        $this->grupo_id   = (\Auth::user()) ? \Auth::user()->grupo_id : 0;
    }

    public function home()
    {
        $escuela_id = $this->escuela_id;
        $periodos = Periodo::all()->where('escuela_id',$this->escuela_id);
        $grupos = Grupo::all()->where('id',$this->grupo_id);
        $current = 'home';

        return view('public.home')->with(compact('current','periodos','grupos','escuela_id'));
    }

    public function gruposJson(Request $request)
    {
        $id = $request->get('id');
        $grupo = Grupo::getByEscuela($id);
        return response()->json($grupo);
    }

    public function escuelasJson(Request $request)
    {
        $id = $request->get('id');
        $escuela = Escuela::getByEstado($id);

        return response()->json($escuela);
    }
}
