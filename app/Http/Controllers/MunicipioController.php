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
            ->select('estados.nombre as n_e','municipios.nombre as n_m', 'municipios.no_mun as no')
            ->get();
            $estados = Estado::all();
        return view('municipios.index', compact('municipios','estados'));
    }


    /**
     * Filtra los municpios de un estado en base a un ID estado recibido
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function filtro_municipio($id)
    {
        $municipios = Municipio::query()
            ->join('estados', 'municipios.estado_id', '=', 'estados.id')
            ->select('estados.nombre as n_e', 'municipios.nombre as n_m', 'municipios.no_mun as no')
            ->where('municipios.estado_id', '=', $id)
            ->get();
        
        return response()->json($municipios);
    }

    
}