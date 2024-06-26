<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

//agregamos el modelo de permisos de spatie
use Spatie\Permission\Models\Permission;

class SeederTablaPermisos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permisos = [
            //Operaciones sobre el sistema
            'registrar-direccion',
            'ver-estados',
            'ver-municipios',
            'ver-colonias',
            'crear-colonia',
            'ver-rol',
            'crear-rol',
            'editar-rol',
            'borrar-rol'
        ];

        foreach($permisos as $permiso) {
            Permission::create(['name'=>$permiso]);
        }
    }
}
