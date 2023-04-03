<?php

namespace Database\Seeders;

use App\Models\CatalogoHora;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class GeneralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        Role::truncate();
        CatalogoHora::truncate();

        $adminRol = Role::create(['name'=>'Supervisor','display_name'=> 'Supervisor']);
        $empleadoRol = Role::create(['name'=>'Empleado','display_name'=> 'Supervisor']);

        $admin = new User;
        $admin->name = "Josias Tacam";
        $admin->email ="admin@gmail.com";
        $admin->password ="12";
        $admin->save();
        $admin->assignRole($adminRol);

        $empleado = new User;
        $empleado->name = "Misael Tacam";
        $empleado->email ="empleado@gmail.com";
        $empleado->password ="12";
        $empleado->save();


        $empleado->assignRole($empleadoRol);

        $catalogo = new CatalogoHora;
        $catalogo->tarea ='Desarrollo de interfaz';
        $catalogo->horas_estimadas=10;
        $catalogo->descripcion ='Creación, diseño y maquetado';
        $catalogo->save();

        $catalogo = new CatalogoHora;
        $catalogo->tarea ='Desarrollo de componente';
        $catalogo->horas_estimadas=5;
        $catalogo->descripcion ='Creacion de controladores,  rutas, modelos, FormRequest';
        $catalogo->save();

        $catalogo = new CatalogoHora;
        $catalogo->tarea ='Testeo de componentes';
        $catalogo->horas_estimadas=2;
        $catalogo->descripcion ='Verificacion del funcionamiento adecuado';
        $catalogo->save();

        $catalogo = new CatalogoHora;
        $catalogo->tarea ='Tarea 1';
        $catalogo->horas_estimadas=7;
        $catalogo->descripcion ='Descripcion de tareas 1';
        $catalogo->save();

        $catalogo = new CatalogoHora;
        $catalogo->tarea ='Tarea 2';
        $catalogo->horas_estimadas=11;
        $catalogo->descripcion ='Descripcion de tareas 2';
        $catalogo->save();


    }
}
