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

}