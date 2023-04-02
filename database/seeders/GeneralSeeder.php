<?php

namespace Database\Seeders;

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

        $adminRol = Role::create(['name'=>'Supervisor']);
        $empleadoRol = Role::create(['name'=>'Empleado']);

        $admin = new User;
        $admin->name = "Josias Tacam";
        $admin->email ="admin@gmail.com";
        $admin->password =bcrypt("12");
        $admin->save();
        $admin->assignRole($adminRol);

        $empleado = new User;
        $empleado->name = "Misael Tacam";
        $empleado->email ="empleado@gmail.com";
        $empleado->password =bcrypt("12");
        $empleado->save();


        $empleado->assignRole($empleadoRol);

    }
}
