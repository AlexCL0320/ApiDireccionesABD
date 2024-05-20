<?php

namespace App\Http\Controllers;

use App\Models\CodigoPostal;
use App\Models\ColoniaPostal;
use Illuminate\Http\Request;
use App\Models\Colonia;
use App\Models\Municipio;
use App\Models\Estado;
class ColoniaController extends Controller
{
    /**
     * Muestra una lista de todas las colonias.
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
        ->join('colonia_postals', 'colonias.id','=', 'colonia_postals.colonia_id')
        ->join('codigo_postals', 'colonia_postals.codigo_postal_id','=', 'codigo_postals.id')
        ->select('estados.nombre as n_e', 'municipios.nombre as n_m',
                 'colonias.nombre as n', 'colonias.id','codigo_postals.codigo as c', 
                 'colonias.ubicacion as u', 'colonias.no_col as no')
        ->get();
        return view('colonias.index', compact('colonias', 'estados'));

        /**Version 2 de consulta
         // Obtener todos los estados y pasarlos a la vista
        $estados = Estado::all();
        $colonias = Colonia::query()
        ->join('municipios', 'colonias.municipio_id', '=', 'municipios.id')
        ->join('estados', 'municipios.estado_id', '=', 'estados.id')
        ->join('colonia_postals', 'colonias.id','=', 'colonia_postals.colonia_id')
        ->join('codigo_postals', 'colonia_postals.codigo_postal_id','=', 'codigo_postals.id')
        ->select('estados.nombre as n_e', 'municipios.nombre as n_m',
                 'colonias.nombre as n', 'colonias.id',
                 'codigo_postals.codigo as c')
        ->whereColumn('municipios.estado_id', '=', 'estados.id')
        ->whereColumn('colonias.estado_id', '=', 'estados.id')
        ->get();
        return view('colonias.index', compact('colonias', 'estados'));
         */
    }

    //Obtiene los municipios pertenecientes a un estado
    public function obtener_mun($id)
    {
        $municipios = Municipio::where('estado_id','=', $id)
            ->get();        
        return $municipios;
    }
    
    //Obtiene los municipios pertenecientes a un estado
    public function obtener_cp($id)
    {
        $cp = Colonia::query()
        ->join('municipios', 'colonias.municipio_id', '=', 'municipios.id')
        ->join('colonia_postals', 'colonias.id','=', 'colonia_postals.colonia_id')
        ->join('codigo_postals', 'colonia_postals.codigo_postal_id','=', 'codigo_postals.id')
        ->select('codigo_postals.codigo as c', 'codigo_postals.id')
        ->where('municipios.id','=', $id)
        ->get();

        return $cp;
    }

    //Funcion para filtrar las colonias pertenecientes a un estado especifico
    public function filtro_estado($id)
    {
        $colonias = Colonia::query()
            ->join('municipios', 'colonias.municipio_id', '=', 'municipios.id')
            ->join('estados', 'municipios.estado_id', '=', 'estados.id')
            ->join('colonia_postals', 'colonias.id','=', 'colonia_postals.colonia_id')
            ->join('codigo_postals', 'colonia_postals.codigo_postal_id','=', 'codigo_postals.id')
            ->select('estados.nombre as n_e', 'municipios.nombre as n_m', 'colonias.nombre as n', 
                    'colonias.no_col as no','codigo_postals.codigo as c', 'colonias.ubicacion as u') 
            ->where('estados.id','=',$id)
            ->get();
        return response()->json($colonias);
    }

    //Funcion para filtrar todas las colonias
    public function filtro_estado_all()
    {
        $colonias = Colonia::query()
            ->join('municipios', 'colonias.municipio_id', '=', 'municipios.id')
            ->join('estados', 'municipios.estado_id', '=', 'estados.id')
            ->join('colonia_postals', 'colonias.id','=', 'colonia_postals.colonia_id')
            ->join('codigo_postals', 'colonia_postals.codigo_postal_id','=', 'codigo_postals.id')
            ->select('estados.nombre as n_e', 'municipios.nombre as n_m', 'colonias.nombre as n', 
                    'colonias.no_col as no','codigo_postals.codigo as c', 'colonias.ubicacion as u') 
            ->get();
        return response()->json($colonias);
    }

    //Funcion para filtrar las colonias  pertencientes a un estado y municpio especifico -> recibe como entrada el id del estado y del municipio
    public function filtro_municipio($id, $id_e)
    { 
       $colonias = Colonia::query()
            ->join('municipios', 'colonias.municipio_id', '=', 'municipios.id')
            ->join('estados', 'municipios.estado_id', '=', 'estados.id')
            ->join('colonia_postals', 'colonias.id','=', 'colonia_postals.colonia_id')
            ->join('codigo_postals', 'colonia_postals.codigo_postal_id','=', 'codigo_postals.id')
            ->select('estados.nombre as n_e', 'municipios.nombre as n_m', 'colonias.nombre as n',
                     'colonias.no_col as no','codigo_postals.codigo as c', 'colonias.ubicacion as u') 
            ->where('estados.id', '=', $id_e)
            ->where('municipios.id', '=', $id)
            ->get();
        return response()->json($colonias);
    }

    //Funcion para filtrar todas las colonias  pertencientes a un estado y municpio especifico -> recibe como entrada el id del estado y del municipio
    public function filtro_municipio_all($id)
    { 
        $colonias = Colonia::query()
            ->join('municipios', 'colonias.municipio_id', '=', 'municipios.id')
            ->join('estados', 'municipios.estado_id', '=', 'estados.id')
            ->join('colonia_postals', 'colonias.id','=', 'colonia_postals.colonia_id')
            ->join('codigo_postals', 'colonia_postals.codigo_postal_id','=', 'codigo_postals.id')
            ->select('estados.nombre as n_e', 'municipios.nombre as n_m', 'colonias.nombre as n',
                        'colonias.no_col as no','codigo_postals.codigo as c', 'colonias.ubicacion as u') 
            ->where('estados.id', '=', $id)
            ->get();
        return response()->json($colonias);
    }

    //Funcion para filtrar las colonias  pertencientes a un estado y municpio especifico -> recibe como entrada el id del estado y del municipio
    public function filtro_cp($id)
    { 
       $colonias = Colonia::query()
            ->join('municipios', 'colonias.municipio_id', '=', 'municipios.id')
            ->join('estados', 'municipios.estado_id', '=', 'estados.id')
            ->join('colonia_postals', 'colonias.id','=', 'colonia_postals.colonia_id')
            ->join('codigo_postals', 'colonia_postals.codigo_postal_id','=', 'codigo_postals.id')
            ->select('estados.nombre as n_e', 'municipios.nombre as n_m', 'colonias.nombre as n',
                     'colonias.no_col as no','codigo_postals.codigo as c', 'colonias.ubicacion as u') 
            ->where('codigo_postals.id', '=', $id)
            ->get();
        return response()->json($colonias);
    }

    //Funcion para filtrar todas las colonias  pertencientes a un estado y municpio especifico -> recibe como entrada el id del estado y del municipio
    public function filtro_cp_all($id)
    { 
       $colonias = Colonia::query()
            ->join('municipios', 'colonias.municipio_id', '=', 'municipios.id')
            ->join('estados', 'municipios.estado_id', '=', 'estados.id')
            ->join('colonia_postals', 'colonias.id','=', 'colonia_postals.colonia_id')
            ->join('codigo_postals', 'colonia_postals.codigo_postal_id','=', 'codigo_postals.id')
            ->select('estados.nombre as n_e', 'municipios.nombre as n_m', 'colonias.nombre as n',
                     'colonias.no_col as no','codigo_postals.codigo as c', 'colonias.ubicacion as u') 
            ->where('municipios.id', '=', $id)
            ->get();
        return response()->json($colonias);
    }

    //Obtiene los datos correspondientes a un codigo postal (estado, municipio y colonias)
    public function buscar_datos(Request $request) {
        $cp = $request->codigo_postal;
        $codigoPostal = CodigoPostal::where('codigo', $cp)->first();
        if (!$codigoPostal) {
            return response()->json(['error' => 'Código postal no encontrado'], 404);
        }
        //Obtenemos el id del codigo postal
        $id_cp = $codigoPostal->id;

        $id_col =  ColoniaPostal::query()
            ->select('colonia_postals.colonia_id as id')
            ->where('colonia_postals.codigo_postal_id','=', $id_cp)
            ->get();
        
        $datos = collect();

        foreach ($id_col as $colonia) {
            $id = $colonia->id;

        $colonia_datos = Colonia::query()
            ->join('municipios', 'colonias.municipio_id', '=', 'municipios.id')
            ->join('estados', 'municipios.estado_id', '=', 'estados.id')
            ->select(
                'estados.nombre as n_e', 'estados.id as i_e',
                'municipios.nombre as n_m', 'municipios.id as i_m',
                'colonias.nombre as n_c', 'colonias.id as i_c'
            )
            ->where('colonias.id', '=', $id)
            ->get();

        if ($colonia_datos) {
                $datos->push($colonia_datos);
            }
        }

        return response()->json($datos);
    }
    
    /**
     * Muestra el formulario para crear una nueva colonia
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('colonias.crear', compact('municipios', 'estados'));
    }

    /**
     * Almacena una nueva colonia en la base de datos.
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
     * Muestra el formulario para editar una colonia específica y pasa el ID de la colonia.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Colonia $colonia)
    {
        return view('colonias.editar', compact('colonia'));
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
     * Elimina una colonia específica de la base de datos.
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
        //return redirect()->route('colonias.index')->with('eliminar','ok');
        return redirect()->route('colonias.index');
    }
}