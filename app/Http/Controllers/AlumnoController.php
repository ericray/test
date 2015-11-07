<?php

namespace App\Http\Controllers;

use App\Escuela;
use App\Estado;
use App\Sexo;
use App\Tarea;
use App\Tipo;
use App\Grupo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Requests\AlumnoRequest;
use App\Http\Requests\AlumnoEditRequest;
use App\Http\Requests\EditPasswordRequest;

class AlumnoController extends Controller
{
    public function index()
    {
        $escuelas = Escuela::all()->lists('nombre','id');
        $estados = Estado::all()->lists('descripcion','id');
        $alumnos = User::getUserType('Alumno');
        $num_alumnos = $alumnos->count();
        $sexos    = Sexo::all();
        return view('admin.alumno.list')->with(compact('alumnos','num_alumnos','estados','escuelas','sexos'));
    }

    public function store(AlumnoRequest $request)
    {
        $tipo = Tipo::getByName('Alumno');
        $alumno = new User();
        $alumno->fill($request->all());
        $alumno->tipo_id = $tipo->id;
        $alumno->estatus_id = 1;
        $alumno->password = \Hash::make($request->input('password'));
        $alumno->save();

        return redirect()->route('admin.alumno.index');
    }

    public function create()
    {
        $title = 'Agregar alumno';
        $form_data = ['route' => 'admin.alumno.store'];
        $alumno = new User();
        $estados = Estado::orderBy('descripcion')->lists('descripcion','id');
        $escuelas = [];
        $grupos   = [];
        $generos = Sexo::all();
        $action = 'create';

        return view('admin.alumno.form')->with(compact('title','form_data','alumno','estados','escuelas','grupos','generos','action'));
    }

    public function edit($id)
    {
        $title = 'Editar alumno';
        $alumno = User::findOrFail($id);
        $estados = Estado::orderBy('descripcion')->lists('descripcion','id');
        $escuelas = Escuela::all()->lists('nombre','id');
        $grupos   = Grupo::all()->lists('descripcion','id');
        $generos = Sexo::all();
        $form_data = ['route' => ['admin.alumno.update',$alumno->id],'method' => 'PUT'];
        $action = 'edit';

        return view('admin.alumno.form')->with(compact('title','alumno','estados','escuelas','grupos','generos','form_data','action'));
    }

    public function update($id,AlumnoEditRequest $request)
    {
        $alumno = User::findOrFail($id);
        $alumno->fill($request->all());

        $alumno->save();

        return redirect()->route('admin.alumno.index');
    }

    public function destroy($id)
    {
        return response($id);
    }

    /**
     * Form for edit password
     *
     * @param $id
     * @return Response
     */
    public function getEditPassword($id)
    {
        $resource = 'alumno';
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

        return redirect()->route('admin.alumno.index');
    }

    public function alumnoByGrupo($grupo_id)
    {
        $grupo = Grupo::findOrFail($grupo_id);
        $alumnos = User::getByType('Alumno',0,$grupo_id);
        $title = 'Grupo ' . $grupo->descripcion;

        return view('public.alumno.list_by_grupo')->with(compact('alumnos','grupo','title'));
    }

    public function postAlumnoByGrupo(Request $request)
    {
        $grupo_id = $request->input('grupo_id');
        $searchPhrase = ($request->has('searchPhrase')) ? $request->input('searchPhrase') : "";
        $sort = ($request->has('sort')) ? $request->input('sort')['name'] : 'DESC';

        $alumnos = User::getByTypeAndName('Alumno',$grupo_id,$searchPhrase,$sort);

        $data = [
            'current' => 1,
            'rowCount' => 10,
            "rows" => $alumnos,
            "total" => $alumnos->count()
        ];

        return response()->json($data);
    }

    public function getTareasAlumno($alumno_id)
    {
        $alumno = User::findOrFail($alumno_id);
        $title = 'Alumno: ' . $alumno->name;
        $tareas = Tarea::getByAlumno($alumno_id);

        return view('public.alumno.tareas_by_alumno')->with(compact('title','tareas','alumno'));
    }

    public function postTareasAlumno(Request $request)
    {
        $searchPrase = ($request->has('searchPhrase')) ? $request->input('searchPhrase') : "";
        $orderBy = 'nombre';
        $sort = 'ASC';

        if($request->has('sort')){
            foreach($request->input('sort') as $key => $val)
            {
                $orderBy = $key;
                $sort    = $val;
            }
        }

        $tareas = Tarea::getTareaByAlumno($request->input('alumno_id'),$searchPrase)->orderBy($orderBy,$sort)->get();

        return response()->json([
            'current' => 1,
            'rowCount' =>10,
            'rows' => $tareas,
            'total' => $tareas->count()
        ]);
    }
}
