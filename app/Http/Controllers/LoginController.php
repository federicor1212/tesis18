<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuthExceptions\JWTException;

class LoginController extends Controller
{
    public function __construct()
   {
       // Apply the jwt.auth middleware to all methods in this controller
       // except for the authenticate method. We don't want to prevent
       // the user from retrieving their token if they don't already have it
       $this->middleware('jwt.auth', ['except' => ['authenticate']]);
   }
   
   public function index()
   {
        
   }    
  
   public function authenticate(Request $request)
   {
        $credentials = $request->only('email', 'password');
        $isDocente = $request->only('is_docente');

        if($request->input('email') == null || $request->input('password') == null) {
          return response()->json(['error' => 'credentials_are_missing'], 401);
        }

        try {
            // verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        $user = JWTAuth::toUser($token);

        if ($user->estado == 1 && ($user->id_permiso == 1 || $isDocente == 1)) {
          // if no errors are encountered we can return a JWT
          return response()->json(compact('token'));
        } else {
             return response()->json(['error' => 'invalid_credentials'], 401);
        }
   }
    
}
