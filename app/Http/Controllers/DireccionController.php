<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Direccion;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class DireccionController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Obtén el usuario logueado
        // Obtener todos los municipios y pasarlos a la vista
        $id_user = $user->id;
        $direcciones = User::query()
            ->join('direccions', 'users.direccion_id', '=', 'direccions.id')
            ->join('colonias', 'direccions.colonia_id', '=', 'colonias.id')
            ->join('colonia_postals', 'colonias.id', '=', 'colonia_postals.colonia_id')
            ->join('codigo_postals', 'colonia_postals.codigo_postal_id', '=', 'codigo_postals.id')
            ->join('municipios', 'colonias.municipio_id', '=', 'municipios.id')
            ->join('estados', 'municipios.estado_id', '=', 'estados.id')
            ->select('users.nombre as name','direccions.calle as c','direccions.numero_ex as no_e', 'direccions.numero_int as no_i', 
                    'estados.nombre as n_e', 'municipios.nombre as n_m', 'colonias.nombre as n_c', 'colonias.ubicacion as u',
                    'codigo_postals.codigo as c', 'direccions.calle as ca', 'direccions.id as id')
            ->where('users.id', '=', $id_user)
            ->get();
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
            'colonia_id' => 'required',
            'calle' => 'required',
            'numero_ex' => 'required',
        ]);

        $colonia = Direccion::create([
            'colonia_id' => $request['colonia_id'],
            'calle' => $request['calle'],
            'numero_ex' =>  $request['numero_ex'],
            'numero_int' =>  $request['numero_int']
        ]);

        //Obtenemos el id de la colonia
        $dir_id = Direccion::latest()->first()->id;

        $user_id = $request->user_id;
        $user = User::findOrFail($user_id);

        //Le registramos al usuario  la direccion creada
        $user->direccion_id = $dir_id;
        //Guardamos los cambios en el usuario
        $user->save();
        return redirect()->route('direcciones.index');
    }

 

    public function edit($id)
    {
        return view('direcciones.editar');
    }

    public function update(Request $request, Direccion $direccion)
    {
        request()->validate([
            'coloni_id' => 'required',
            'calle' => 'required',
            'num_ext' => 'required',
        ]);

        $direccion->update($request->all());

        return redirect()->route('direcciones.index');
    }

    public function destroy($id)
    {
        //Eliminamos su registro en la tabla de usuario y en direcciones
        $user = User::where('direccion_id', $id)->firstOrFail();
        //Le retiramos la direccion asignada
        $user->direccion_id = null;
        //Guardamos los cambios en el usuario
        $user->save();

        // Obtener la direccion por su ID y eliminarla
        $direccion = Direccion::findOrFail($id);
        $direccion->delete();

        return redirect()->route('direcciones.index');
    }


}
