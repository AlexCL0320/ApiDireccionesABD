<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Direccion;
use Illuminate\Support\Facades\Auth;
class DireccionController extends Controller
{
    public function index()
    {
        $direcciones = Direccion::all();
        return view('direcciones.index', compact('direcciones'));
    }

    public function create()
    {
        $user = Auth::user(); // Obtén el usuario logueado
        return view('direcciones.crear', compact('user'));
    }

    public function store(Request $request)
    {
        request()->validate([
            'nombre' => 'required',
            'clave' => 'required',
            'direccion'=>'required',
        ]);

        Direccion::create($request->all());

        return redirect()->route('direcciones.index');
    }

 

    public function edit(Direccion $direccion)
    {
        return view('direcciones.editar',compact('direcciones'));
    }

    public function update(Request $request, Direccion $direccion)
    {
        request()->validate([
            'nombre' => 'required',
            'clave' => 'required',
            'direccion'=>'required',
        ]);

        $direccion->update($request->all());

        return redirect()->route('direcciones.index');
    }

    public function destroy(Direccion $direccion)
    {
        $direccion->delete();

        return redirect()->route('direcciones.index');
    }


}
