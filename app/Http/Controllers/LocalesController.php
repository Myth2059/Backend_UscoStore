<?php

namespace App\Http\Controllers;

use App\Models\Locales;
use App\Http\Requests\StoreLocalesRequest;
use App\Http\Requests\UpdateLocalesRequest;
use App\Http\Resources\LocalesCollection;
use App\Models\User;
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
                    'imgUrl' => 'required|string',
                    'detalles' => 'required|string'
                ]);

                $local = Locales::create([
                    'user_id' => $request->input('user_id'),
                    'nombre' => $request->input('nombre'),
                    'ubicacion' => $request->input('ubicacion'),
                    'estado' => $request->input('estado'),
                    'categoria' => $request->input('categoria'),
                    'subcategoria' => $request->input('subcategoria'),
                    'imgUrl' => $request->input('imgUrl'),
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
