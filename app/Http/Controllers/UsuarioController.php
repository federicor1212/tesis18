<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use Hash;
use App\Enums\Status;
use App\Enums\UserRoles;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuthExceptions\JWTException;
use Carbon\Carbon;

class UsuarioController extends Controller
{

    public function getAuthenticatedUser(Request $request)
    {
        $user = JWTAuth::toUser($request->get('token'));
        
        return $user;
    }

    public function index($id = null) {
      
      if ($id == null){
        $usuario = Usuario::all();

        foreach ($usuario as $u) {
            if ($u['id_permiso'] == UserRoles::ADMIN) {
                $u['id_permiso'] = 'Administrador';
            } else {
                $u['id_permiso'] = 'Docente';
            }

            if ($u['estado'] == Status::ACTIVO) {
                $u['estado'] = 'Activo';
            } else {
                $u['estado'] = 'Inactivo';
            }
        }
        return $usuario;
      } else {
        return Usuario::find($id);
      }
    }

    public function show($id) {
        return Usuario::find($id);
    }

    public function store(Request $request) {

        if ($request->input('id') != null) {
            $usuario = Usuario::find($request->input('id'));
        } else {
            $usuario = new Usuario;
        }

        $usuario->nombre = $request->input('nombre');
        $usuario->apellido = $request->input('apellido');
        $usuario->email = $request->input('email');
        $usuario->password = Hash::make($request->input('password'));
        if ($request->input('id_permiso') === 'Administrador') {
            $usuario->id_permiso = UserRoles::ADMIN;
        } else {
            $usuario->id_permiso = UserRoles::DOCENTE;
        }

        if ($request->input('estado') === 'Activo') {
            $usuario->estado = Status::ACTIVO;
        } else {
            $usuario->estado = Status::INACTIVO;
        }
        $usuario->save();

        return 'Usuario record successfully saved with id' . $usuario->id;
    }
    
    public function destroy(Request $request) {
        $userToDelete = $request->input('0');

        if ($userToDelete != null) {
            $usuario = Usuario::find($userToDelete)->delete();
            return 'Usuario record successfully deleted';
        } else {
            return 'Hubo un problema eliminando el usuario';
        }
    }
}
