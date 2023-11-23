<?php

namespace App\Http\Controllers;

use App\Http\Resources\LocalesCollection;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function Login(Request $request){

        $response = ["msg"=>"","code"=>0];
        $user = User::find($request->input('id'));
        if ($user) {
           if (Hash::check($request->input('password'),$user->password)) {
            $token = $user->createToken("");
            $response["code"]= 1;
            $response["msg"]=$token->plainTextToken;
            return $response;
           }
           $response["code"]= 0;
           $response["msg"]="Usuario o contraseña invalidos";
        }else{
            $response["code"]= 0;
            $response["msg"]="Usuario o contraseña invalidos 2";
        }
 

    }

    public function CreateUser(Request $request){
        $exist = User::find($request->input('id'));     
        if ($exist == null) {
            try {
                $request ->validate([
                    'id'=>'required|integer',
                    'name'=>'required|string',
                    'password'=>'required|string',
                    'lastname'=>'required|string',
                    'rol' => 'required|string',
                    'phone'=>'required|integer'
                ]);
    
                $user = User::create([
                    'id'=>$request->input('id'),
                    'name'=>$request->input('name'),
                    'password'=>$request->input('password'),
                    'lastname'=>$request->input('lastname'),
                    'rol'=>$request->input('rol'),
                    'phone'=>$request->input('phone')
                ]);
    
                return ["msg"=>"Usuario creado correctamente","code"=>1];
    
            } catch (ValidationException  $e) {
                 return ['msg'=>'Error de Validacion','errors'=>$e->errors()];
              
            }
          
        }else{
            return ["msg"=>"El usuario ya existe","code"=>0];
        }
   

    }


}
