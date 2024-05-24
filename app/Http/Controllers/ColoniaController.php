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

    }

    //Obtiene los municipios pertenecientes a un estado
    public function obtener_mun($id)
    {
        $municipios = Municipio::where('estado_id','=', $id)
            ->get();        
        return $municipios;
    }

    //Obtiene los cp pertenecientes a un estado
    public function obtener_cp0($id)
    {
        $cp = Estado::query()
        ->join('municipios', 'municipios.estado_id', '=', 'estados.id')
        ->join('colonias', 'colonias.municipio_id', '=', 'municipios.id')
        ->join('colonia_postals', 'colonias.id','=', 'colonia_postals.colonia_id')
        ->join('codigo_postals', 'colonia_postals.codigo_postal_id','=', 'codigo_postals.id')
        ->select('codigo_postals.codigo as c', 'codigo_postals.id')
        ->where('estados.id','=', $id)
        ->get();

        return $cp;
    }

    //Obtiene los cp de los municipios pertenecientes a un estado
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
                     'colonias.no_col as no','codigo_postals.codigo as c', 'colonias.ubicacion as u',
                     'colonias.id') 
            ->where('codigo_postals.id', '=', $id)
            ->get();
        return response()->json($colonias);
    }

    //Funcion para filtrar todas las colonias  pertencientes a un estado y municpio especifico -> recibe como entrada el id del estado y del municipio
    public function filtro_cp_all($id, $est_id)
    { 
        
        if($id>0){
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

        else{
            $colonias = Colonia::query()
            ->join('municipios', 'colonias.municipio_id', '=', 'municipios.id')
            ->join('estados', 'municipios.estado_id', '=', 'estados.id')
            ->join('colonia_postals', 'colonias.id','=', 'colonia_postals.colonia_id')
            ->join('codigo_postals', 'colonia_postals.codigo_postal_id','=', 'codigo_postals.id')
            ->select('estados.nombre as n_e', 'municipios.nombre as n_m', 'colonias.nombre as n',
                     'colonias.no_col as no','codigo_postals.codigo as c', 'colonias.ubicacion as u') 
            ->where('estados.id', '=', $est_id)
            ->get();
            return response()->json($colonias);   
        }

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
        return view('colonias.crear');
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
            'nombre_col' => 'required',
            'ubicacion' => 'required'
        ]);

        //Obtenemos el estado y municipio
        $estado = $request->estado_col;
        $municipio = $request->municipio_col;

        //Obtenemos el id de municipio y estado
        $mun = Municipio::query()
            ->join('estados', 'municipios.estado_id', '=', 'estados.id')
            ->select('estados.id as i_e', 'municipios.id as i_m')
            ->where('estados.nombre', '=', $estado)
            ->where('municipios.nombre', '=', $municipio)
            ->first();

        //Obtenemos el numero de colonia nuevo 
        $no_col = Colonia::where('municipio_id', $mun->i_m)->count();
        $no_col++;

        // Crear una nueva colonia en la base de datos
        $colonia = Colonia::create([
            'nombre' => $request['nombre_col'],
            'municipio_id' => $mun->i_m,
            'no_col' => $no_col,
            'ubicacion' =>  $request['ubicacion']
        ]);


        //Agregamos la colonia y su cp a la tabla intermedia
        //Obtenemos el id del codigo postal
        $cp = $request->codigo_postal_col;
        $codigoPostal = CodigoPostal::where('codigo', $cp)->first();
        $id_cp = $codigoPostal->id;

        //Obtenemos el id de la colonia
        $col_id = Colonia::latest()->first()->id;

        // Crear una nuevo registro en la tabla intermedia
        $c_cp = ColoniaPostal::create([
            'colonia_id' => $col_id,
            'codigo_postal_id' => $id_cp
        ]);

        return redirect()->route('colonias.index');
    }


    /**
     * Muestra el formulario para editar una colonia específica y pasa el ID de la colonia.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $colonia = Colonia::query()
        ->join('municipios', 'colonias.municipio_id', '=', 'municipios.id')
        ->join('estados', 'municipios.estado_id', '=', 'estados.id')
        ->join('colonia_postals', 'colonias.id','=', 'colonia_postals.colonia_id')
        ->join('codigo_postals', 'colonia_postals.codigo_postal_id','=', 'codigo_postals.id')
        ->select('estados.nombre as n_e', 'municipios.nombre as n_m',
                 'colonias.nombre as n', 'colonias.id','codigo_postals.codigo as c', 
                 'colonias.ubicacion as u', 'colonias.no_col as no')
        ->where('colonias.id','=', $id)
        ->first();

        return view('colonias.editar', compact('colonia'));
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
        $data = $request->validate([
            'nombre' => 'required',
            'ubicacion' => 'required',
        ]);

        /// Buscar la colonia por su ID
        $colonia = Colonia::findOrFail($id);

        // Actualizar la colonia con los datos validados
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
        
        //Eliminamos su registro en la tabla intermedia entre cp y colonia
        $c_cp = ColoniaPostal::where('colonia_id', $id)->firstOrFail();
        $c_cp -> delete();

        // Obtener la colonia por su ID y eliminarla
        $colonia = Colonia::findOrFail($id);
        $colonia->delete();

        return redirect()->route('colonias.index');
    }
}