<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Escuela;

class AdminPagesController extends Controller
{
    public function home()
    {
        $escuela_id = \Auth::user()->escuela_id;
        $num_director = User::getUserType('Director')->count();
        $num_admins = User::getByType('Administrador')->count();
        $num_maestros = User::getByType('Maestro',$escuela_id)->count();
        $num_escuelas = Escuela::all()->count();
        $current = 'admin';

        return view('admin.home')->with(compact('num_director','num_admins','num_maestros','num_escuelas','current'));
    }

    public function sendMail()
    {
        \Mail::send('email.welcome', ['text' => 'Bienvenido'], function ($message) {
            $message->from('eric.lpez103@gmail.com', 'Eric');
            $message->to('eric.lopez.alonzo@gmail.com')->subject('Bienvenida');
        });

        return response('Correo enviado');
    }
}
