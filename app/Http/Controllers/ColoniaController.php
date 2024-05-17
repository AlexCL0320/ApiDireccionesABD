<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Colonia;
use App\Models\Municipio;
use App\Models\Estado;
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
        $estados = Estado::all();
        $colonias = Colonia::query()
        ->join('municipios', 'colonias.municipio_id', '=', 'municipios.id')
        ->join('estados', 'municipios.estado_id', '=', 'estados.id')
        ->select('estados.nombre_estado as n_e', 'municipios.nombre as n_m', 'colonias.nombre as n', 'colonias.id')
        ->whereColumn('municipios.estado_id', '=', 'estados.id')
        ->whereColumn('colonias.estado_id', '=', 'estados.id')
        ->get();
        return view('colonias.index', compact('colonias', 'estados'));
    }

    public function obtener_mun($id)
    {
        $municipios = Municipio::where('estado_id','=', $id)
            ->get();        
        return $municipios;
    }
    public function filtro_estado($id)
    {
        $colonias = Colonia::query()
            ->join('municipios', 'colonias.municipio_id', '=', 'municipios.id')
            ->join('estados', 'municipios.estado_id', '=', 'estados.id')
            ->select('estados.nombre_estado as n_e', 'municipios.nombre as n_m', 'colonias.nombre as n', 'colonias.id', 'colonias.estado_id') // Agrega colonias.estado_id a la selección
            ->where('municipios.estado_id', '=', $id)
            ->where('colonias.estado_id', '=', $id)
            ->get();
        return response()->json($colonias);
    }
    
    public function filtro_municipio($id, $id_e)
    { 
       $colonias = Colonia::query()
            ->join('municipios', 'colonias.municipio_id', '=', 'municipios.id')
            ->join('estados', 'municipios.estado_id', '=', 'estados.id')
            ->select('estados.nombre_estado as n_e', 'municipios.nombre as n_m', 'colonias.nombre as n', 'colonias.id', 'colonias.estado_id') // Agrega colonias.estado_id a la selección
            ->where('municipios.estado_id', '=', $id_e)
            ->where('colonias.estado_id', '=', $id_e)
            ->where('municipios.id', '=', $id)
            ->where('colonias.municipio_id', '=', $id)
            ->get();
        return response()->json($colonias);
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