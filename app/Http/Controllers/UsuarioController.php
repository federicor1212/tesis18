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

    public function getUsuariosDocentes() {
      $auth = new UsuarioController;
          $userRequest = new \Illuminate\Http\Request();
          $token = $auth->getAuthenticatedUser($userRequest);
          if ($token instanceof \Illuminate\Http\JsonResponse) {
            $userData = json_decode($token->getContent());
            if(isset($userData->error)){
                return response()->json($userData, $token->status());
            }
          }

      $docentes = Usuario::where('id_permiso',2)->get();
      $docentesAsignados = Usuario::join('docentes','usuarios.id','docentes.id_usuario')->where('usuarios.id_permiso',2)->get();
      $docenteReg = [];
      foreach ($docentes as $docente) {
        $found = 0;
        foreach ($docentesAsignados as $doc) {
          if ($doc->id_usuario == $docente->id) {
            $found = 1;
          }
          if ($found == 1) {
            break;
          }
        }
        if ($found == 0) {
          $docenteReg[] = $docente; 
        } 
      }
      return $docenteReg;
    }

    public function index($id = null) {
      $auth = new UsuarioController;
          $userRequest = new \Illuminate\Http\Request();
          $token = $auth->getAuthenticatedUser($userRequest);
          if ($token instanceof \Illuminate\Http\JsonResponse) {
            $userData = json_decode($token->getContent());
            if(isset($userData->error)){
                return response()->json($userData, $token->status());
            }
          }

      if ($id == null){
        $usuario = Usuario::join('permisos','usuarios.id_permiso','=','permisos.id')            
                 ->select('usuarios.id','usuarios.nombre','usuarios.apellido','usuarios.estado','usuarios.email','permisos.descripcion AS permiso')
                 ->orderby('usuarios.id')
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
          if ($token instanceof \Illuminate\Http\JsonResponse) {
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
          if ($token instanceof \Illuminate\Http\JsonResponse) {
            $userData = json_decode($token->getContent());
            if(isset($userData->error)){
                return response()->json($userData, $token->status());
            }
          }

        if ($request->input('id') != null) {
            $usuario = Usuario::find($request->input('id'));
            $usuario->password = Hash::make($request->input('contrasenia'));
        } else {
            $usuario = new Usuario;
            $usuario->password = Hash::make('temporal');
        }

        $usuario->nombre = $request->input('nombre');
        $usuario->apellido = $request->input('apellido');
        $usuario->email = $request->input('email');
        
        $checkIfAsignado = Docente::where('id_usuario',$usuario->id_permiso)->first();
        if (empty($checkIfAsignado)) {
          if ($request->input('permiso') === 'Administrador' || $request->input('id_permiso') == 1) {
              $usuario->id_permiso = UserRoles::ADMIN;
          } else {
              $usuario->id_permiso = UserRoles::DOCENTE;
          }
        } else {
          throw new Exception("El usuario ya se encuentra asociado a un docente", 500);
        }

        if ($request->input('estado') === 'Activo' || $request->input('estado') == 1) {
            $usuario->estado = Status::ACTIVO;
        } else {
            $usuario->estado = Status::INACTIVO;
        }  
        
        $usuario->save();

        return 'Usuario record successfully saved with id' . $usuario->id;
    }
    
    public function destroy(Request $request, $id) {
      $auth = new UsuarioController;
          $userRequest = new \Illuminate\Http\Request();
          $token = $auth->getAuthenticatedUser($userRequest);
          if ($token instanceof \Illuminate\Http\JsonResponse) {
            $userData = json_decode($token->getContent());
            if(isset($userData->error)){
                return response()->json($userData, $token->status());
            }
          }

        if ($id != null) {
            $usuario = Usuario::find($id)->delete();
            return 'Usuario record successfully deleted';
        } else {
            return 'Hubo un problema eliminando el usuario';
        }
    }
}
