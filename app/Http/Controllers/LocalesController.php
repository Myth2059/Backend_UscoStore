<?php

namespace App\Http\Controllers;

use App\Models\Locales;
use App\Http\Requests\StoreLocalesRequest;
use App\Http\Requests\UpdateLocalesRequest;
use App\Http\Resources\LocalesCollection;
use App\Models\DeleteLog;
use App\Models\User;
use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

class LocalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return LocalesCollection
     */
    public function index()
    {
        $locales = Locales::all();
        return new LocalesCollection($locales);
    }

    /**
     * Display the specified resource by ID.
     *
     * @param  int  $id
     * @return LocalesCollection
     */
    public function findLocal($id)
    {
        $resultado = Locales::join('users', 'locales.user_id', '=', 'users.id')
            ->where('locales.id', $id)
            ->select('users.id', 'users.name', 'users.lastname', 'users.phone', 'users.rol', 'locales.id', 'locales.nombre', 'locales.ubicacion', 'locales.estado', 'locales.categoria', 'locales.subcategoria', 'locales.imgurl', 'locales.user_id', 'locales.detalles')
            ->first();

        return $resultado;
    }

    /**
     * Display user information for generating reports.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function informes()
    {
        return User::select('users.name', 'users.phone')->get();
    }

    /**
     * Create a new resource.
     *
     * @param  Request  $request
     * @return array
     */
    public function createLocal(Request $request)
    {
        $exist = User::find($request->input('user_id'));

        if ($exist != null) {
            try {
                $request->validate([
                    'user_id' => 'required|integer',
                    'nombre' => 'required|string',
                    'ubicacion' => 'required|integer',
                    'estado' => 'required|string',
                    'categoria' => 'required|string',
                    'subcategoria' => 'required|string',
                    'imgurl' => 'required|string',
                    'detalles' => 'required|string'
                ]);

                $local = Locales::create([
                    'user_id' => $request->input('user_id'),
                    'nombre' => $request->input('nombre'),
                    'ubicacion' => $request->input('ubicacion'),
                    'estado' => $request->input('estado'),
                    'categoria' => $request->input('categoria'),
                    'subcategoria' => $request->input('subcategoria'),
                    'imgurl' => $request->input('imgurl'),
                    'detalles' => $request->input('detalles')
                ]);

                return ["msg" => "Local creado correctamente", "code" => 1];
            } catch (ValidationException $e) {
                return ["msg" => $e->errors(), "code" => 0];
            }
        } else {
            return ["msg" => "No existe el propietario", "code" => 0];
        }
    }
    
    public function singleUpdate(Request $request)
    {
       try {     
        
        $request->validate([
            'user_id' => 'integer',
            'nombre' => 'string',
            'ubicacion' => 'integer',
            'estado' => 'string',
            'categoria' => 'string',
            'subcategoria' => 'string',
            'imgUrl' => 'string',
            'detalles' => 'string'
        ]);

        $local = Locales::find($request->input('id'));
       
        // Verificar si el registro existe
        if (!$local) {
            return ['msg' => 'Local no encontrado', 'code' => 0];
        }
        $datosActualizados = [];

        $key = "";

        // Iterar sobre los datos recibidos en la solicitud
        foreach ($request->all() as $campo => $valor) {
            // Asegurarse de que el campo exista en el modelo
            if (in_array($campo, $local->getFillable())) {
                $datosActualizados[$campo] = $valor;
                $key = ucfirst($campo);
            }
        }

        // Actualizar los campos con los datos recibidos
        $local->update($datosActualizados);

        return ['msg' => $key . ' actualizado correctamente', 'code' => 1];
           //code...
       } catch (Exception $e) {
        return ['msg' => $e , 'code' => 0];
       }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreLocalesRequest  $request
     * @return void
     */
    public function store(StoreLocalesRequest $request)
    {
        // Implementar lógica para almacenar recursos
    }

    public function deleteLocal(Request $request){
       
        try {
            $request->validate([
                'id' => 'required|integer',
                'admin_id' => 'required|integer',
            ]);
            
        $local = Locales::find($request->input('id'));
        
        if ($local) {
          $result= $local->delete();
          
            if ($result > 0) {
              $resultCreate =  DeleteLog::create([
                    "admin_id" => $request->input('admin_id'),
                    'local_id'=> $local->id,
                   'propietario_id'=>$local->user_id,
                   'nombre_local'=>$local->nombre
                ]);
                return ["msg" => "Se elimino el local ".$local->nombre, "code" => 1];
            }else{
                
                return ["msg" => "No se pudo eliminar ".$local->nombre, "code" => 0];
            }
            
        
        }else{
            return ["msg" => "No existe el local", "code" => 0];
        }
            //code...
        } catch (Exception $e) {
            return ["msg" => $e->getMessage(), "code" => 0];
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  Locales  $locales
     * @return void
     */
    public function show(Locales $locales)
    {
        // Implementar lógica para mostrar un recurso específico
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Locales  $locales
     * @return void
     */
    public function edit(Locales $locales)
    {
        // Implementar lógica para mostrar el formulario de edición
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateLocalesRequest  $request
     * @param  Locales  $locales
     * @return void
     */
    public function update(UpdateLocalesRequest $request, Locales $locales)
    {
        // Implementar lógica para actualizar un recurso específico
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Locales  $locales
     * @return void
     */
    public function destroy(Locales $locales)
    {
        // Implementar lógica para eliminar un recurso específico
    }
}
