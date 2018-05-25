<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use App\Permiso;
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
        $sessionToken = \Session::get('token');
        if ($sessionToken == null){
            \Session::put('token', $request->get('token'));
        }

        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['error' => 'Token is Expired'], 401);

        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['error' => 'Token is Invalid'], 401);

        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['error' => 'Token is not present'], 404);
        }

        return $user;
    }

    public function index($id = null) {
      $auth = new UsuarioController;
          $userRequest = new \Illuminate\Http\Request();
          $token = $auth->getAuthenticatedUser($userRequest);
          if (!isset($token['id'])) {
            $userData = json_decode($token->getContent());
            if(isset($userData->error)){
                return response()->json($userData, $token->status());
            }
          }

      if ($id == null){
        $usuario = Usuario::join('permisos','usuarios.id_permiso','=','permisos.id')            
                 ->select('usuarios.id','usuarios.nombre','usuarios.apellido','usuarios.estado','usuarios.email','permisos.descripcion AS permiso')
                 ->get();

        foreach ($usuario as $u) {
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
        $auth = new UsuarioController;
          $userRequest = new \Illuminate\Http\Request();
          $token = $auth->getAuthenticatedUser($userRequest);
          if (!isset($token['id'])) {
            $userData = json_decode($token->getContent());
            if(isset($userData->error)){
                return response()->json($userData, $token->status());
            }
          }

        return Usuario::find($id);
    }

    public function store(Request $request) {
        $auth = new UsuarioController;
          $userRequest = new \Illuminate\Http\Request();
          $token = $auth->getAuthenticatedUser($userRequest);
          if (!isset($token['id'])) {
            $userData = json_decode($token->getContent());
            if(isset($userData->error)){
                return response()->json($userData, $token->status());
            }
          }

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
      $auth = new UsuarioController;
          $userRequest = new \Illuminate\Http\Request();
          $token = $auth->getAuthenticatedUser($userRequest);
          if (!isset($token['id'])) {
            $userData = json_decode($token->getContent());
            if(isset($userData->error)){
                return response()->json($userData, $token->status());
            }
          }
          
        $userToDelete = $request->input('0');

        if ($userToDelete != null) {
            $usuario = Usuario::find($userToDelete)->delete();
            return 'Usuario record successfully deleted';
        } else {
            return 'Hubo un problema eliminando el usuario';
        }
    }
}
