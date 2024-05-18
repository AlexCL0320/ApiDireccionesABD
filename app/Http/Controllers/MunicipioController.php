<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Municipio;
use App\Models\Estado;

class MunicipioController extends Controller
{
    /**
     * Muestra una lista de todos los municipios.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        // Obtener todos los municipios y pasarlos a la vista
        $municipios = Municipio::query()
            ->join('estados', 'municipios.estado_id', '=', 'estados.id')
            ->select('estados.nombre_estado as n_e','municipios.nombre as n_m', 'municipios.id')
            ->get();
            $estados = Estado::all();
        return view('municipios.index', compact('municipios','estados'));
    }

    /**
     * Muestra el formulario para crear un nuevo municipio.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Mostrar el formulario de creación de municipio
        return view('municipios.create');
    }

    /**
     * Almacena un nuevo municipio en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre_municipio' => 'required|unique:municipios|max:255',
        ]);

        // Crear un nuevo municipio en la base de datos
        Municipio::create($request->all());

        // Redireccionar a la lista de municipios
        return redirect()->route('municipios.index');
    }

    /**
     * Muestra un municipio específico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Obtener el municipio por su ID y pasarlo a la vista
        $municipio = Municipio::findOrFail($id);
        return view('municipios.show', compact('municipio'));
    }

    /**
     * Muestra el formulario para editar un municipio específico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function filtro_municipio($id)
    {
        $municipios = Municipio::query()
            ->join('estados', 'municipios.estado_id', '=', 'estados.id')
            ->select('estados.nombre_estado as n_e', 'municipios.nombre as n_m', 'municipios.id')
            ->where('municipios.estado_id', '=', $id)
            ->get();
        
        return response()->json($municipios);
    }

    public function edit($id)
    {
        // Obtener el municipio por su ID y pasarlo al formulario de edición
        $municipio = Municipio::findOrFail($id);
        return view('municipios.edit', compact('municipio'));
    }

    /**
     * Actualiza un municipio específico en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre_municipio' => 'required|max:255',
        ]);

        // Obtener el municipio por su ID
        $municipio = Municipio::findOrFail($id);

        // Actualizar los datos del municipio
        $municipio->update($request->all());

        // Redireccionar a la lista de municipios
        return redirect()->route('municipios.index');
    }

    /**
     * Elimina un municipio específico de la base de datos.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Obtener el municipio por su ID y eliminarlo
        $municipio = Municipio::findOrFail($id);
        $municipio->delete();

        // Redireccionar a la lista de municipios
        return redirect()->route('municipios.index');
    }
}