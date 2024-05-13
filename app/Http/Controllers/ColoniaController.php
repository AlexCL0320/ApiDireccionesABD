<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Colonia;
use App\Models\Municipio;

class ColoniaController extends Controller
{
    /**
     * Muestra una lista de todos los estados.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        // Obtener todos los estados y pasarlos a la vista
        $colonias = Colonia::query()
        ->join('municipios', 'colonias.municipio_id', '=', 'municipios.id')
        ->join('estados', 'colonias.estado_id','=','estados.id')
        ->select('estados.nombre_estado as n_e','municipios.nombre as n_m', 'colonias.nombre as n', 'colonias.id')
        ->where('colonias.estado_id',"=", "estados.id")
        ->orderByDesc('estados.id')
        ->get();
        return view('colonias.index', compact('colonias'));
    }

    /**
     * Muestra el formulario para crear un nuevo estado.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Mostrar el formulario de creación de estado
        $municipios = Municipio::pluck('nombre', 'nombre');
        return view('colonias.crear', compact('municipios'));

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

        $data = $request->validate([
            'nombre' => 'required',
            'municipio' => 'required',
        ]);
        
        // Crear un nuevo estado en la base de datos
        $municipio = Municipio::firstOrCreate(['nombre' => $data['municipio']]);
        $colonia = Colonia::create([
            'nombre' => $data['nombre'],
            'municipio_id' => $municipio->id,
        ]);
        
        return redirect()->route('colonias.index');
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
    public function edit(Colonia $colonia)
    {
        // Obtener el estado por su ID y pasarlo al formulario de edición
        $municipios = Municipio::pluck('nombre', 'nombre');
        
        return view('colonias.editar', compact('colonia','municipios'));
    }

    /**
     * Actualiza un estado específico en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Colonia $colonia)
    {
        $data = $request->validate([
            'nombre' => 'required',
            'municipio' => 'required',
        ]);

        // Actualizar el cliente
        $colonia->update($data);
        // Redireccionar a la lista de estados
        return redirect()->route('colonias.index');
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
        $colonia = Colonia::findOrFail($id);
        $colonia->delete();

        // Redireccionar a la lista de estados
        return redirect()->route('colonias.index')->with('eliminar','ok');
        //return redirect()->route('colonias.index');
    }
}