<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estado;

class EstadoController extends Controller
{
    /**
     * Muestra una lista de todos los estados.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        // Obtener todos los estados y pasarlos a la vista
        $estados = Estado::all();
        return view('estados.index', compact('estados'));
    }

    /**
     * Muestra el formulario para crear un nuevo estado.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Mostrar el formulario de creación de estado
        return view('estados.create');
    }

    /**
     * Almacena un nuevo estado en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre_estado' => 'required|unique:estados|max:255',
        ]);

        // Crear un nuevo estado en la base de datos
        Estado::create($request->all());

        // Redireccionar a la lista de estados
        return redirect()->route('estados.index');
    }

    /**
     * Muestra un estado específico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Obtener el estado por su ID y pasarlo a la vista
        $estado = Estado::findOrFail($id);
        return view('estados.show', compact('estado'));
    }

    /**
     * Muestra el formulario para editar un estado específico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Obtener el estado por su ID y pasarlo al formulario de edición
        $estado = Estado::findOrFail($id);
        return view('estados.edit', compact('estado'));
    }

    /**
     * Actualiza un estado específico en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre_estado' => 'required|max:255',
        ]);

        // Obtener el estado por su ID
        $estado = Estado::findOrFail($id);

        // Actualizar los datos del estado
        $estado->update($request->all());

        // Redireccionar a la lista de estados
        return redirect()->route('estados.index');
    }

    /**
     * Elimina un estado específico de la base de datos.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Obtener el estado por su ID y eliminarlo
        $estado = Estado::findOrFail($id);
        $estado->delete();

        // Redireccionar a la lista de estados
        return redirect()->route('estados.index');
    }
}