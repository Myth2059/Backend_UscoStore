<?php

namespace App\Http\Controllers;

use App\Http\Resources\LocalesCollection;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function Login(Request $request){

        $response = ["msg"=>"","code"=>0];
        try {         
     
        $user = User::find($request->input('id'));

        if ($user) {
           if (Hash::check($request->input('password'),$user->password)) {
            $token = $user->createToken("");
            $response["code"]= 1;
            $response["msg"]=$token->plainTextToken;
            $response["user"]=$user->name;
            $response["id"] = $user->id;
            $response["rol"]=$user->rol;
            return $response;
           }
           $response["code"]= 0;
           $response["msg"]="Usuario o contraseña invalidos";
           return $response;
        }else{
            $response["code"]= 0;
            $response["msg"]="Usuario o contraseña invalidos";
            return $response;
        }
    } catch (\Throwable $th) {
        $response["msg"]=$th->getMessage();
        $response["code"]=0;
        return $response;
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
                 return ['msg'=>$e->errors(),'errors'=>$e->errors()];
              
            }
          
        }else{
            return ["msg"=>"El usuario ya existe","code"=>0];
        }
   

    }

    public function singleUpdate(Request $request)
    {
       try {     
        
         $user = User::find($request->input('id'));
       
        // Verificar si el registro existe
        if (!$user) {
            return ['msg' => 'Usuario no encontrado', 'code' => 0];
        }
        $datosActualizados = [];

        $key = "";

        // Iterar sobre los datos recibidos en la solicitud
        foreach ($request->all() as $campo => $valor) {
            // Asegurarse de que el campo exista en el modelo
            if (in_array($campo, $user->getFillable())) {
                $datosActualizados[$campo] = $valor;
                $key = ucfirst($campo);
            }
        }

        // Actualizar los campos con los datos recibidos
       $total = $user->update($datosActualizados);
       if ($total == 0) {
        return ['msg' => 'No se modifico nada', 'code' => 0];
       }

        return ['msg' => $key . ' actualizado correctamente', 'code' => 1];
           //code...
       } catch (Exception $e) {
        return ['msg' => $e->__toString() , 'code' => 0];
       }
    }


}
