<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Usuario 1
        $usuario = new User();
        $usuario->alias = "Andy";
        $usuario->email = "andy@gmail.com";
        $usuario->password = Hash::make("probando");
        $usuario->save();

        // Usuario 2
        $usuario = new User();
        $usuario->alias = "Ana";
        $usuario->email = "ana@gmail.com";
        $usuario->password = Hash::make("probando");
        $usuario->save();

        // Usuario 3
        $usuario = new User();
        $usuario->alias = "Ale";
        $usuario->email = "ale@gmail.com";
        $usuario->password = Hash::make("probando");
        $usuario->save();

        // Usuario 4
        $usuario = new User();
        $usuario->alias = "Juan";
        $usuario->email = "juan@gmail.com";
        $usuario->password = Hash::make("probando");
        $usuario->save();

        // Usuario 5
        $usuario = new User();
        $usuario->alias = "Eric";
        $usuario->email = "eric@gmail.com";
        $usuario->password = Hash::make("probando");
        $usuario->save();

        // Usuario 6
        $usuario = new User();
        $usuario->alias = "Tina";
        $usuario->email = "tina@gmail.com";
        $usuario->password = Hash::make("probando");
        $usuario->save();

        // Usuario 7
        $usuario = new User();
        $usuario->alias = "Dani";
        $usuario->email = "dani@gmail.com";
        $usuario->password = Hash::make("probando");
        $usuario->save();

        // Usuario 8
        $usuario = new User();
        $usuario->alias = "Leo";
        $usuario->email = "leo@gmail.com";
        $usuario->password = Hash::make("probando");
        $usuario->save();

        // Usuario 9
        $usuario = new User();
        $usuario->alias = "Lucas";
        $usuario->email = "lucas@gmail.com";
        $usuario->password = Hash::make("probando");
        $usuario->save();

        // Usuario 10
        $usuario = new User();
        $usuario->alias = "Julian";
        $usuario->email = "julian@gmail.com";
        $usuario->password = Hash::make("probando");
        $usuario->save();

        // Usuario 11
        $usuario = new User();
        $usuario->alias = "Julieta";
        $usuario->email = "julieta@gmail.com";
        $usuario->password = Hash::make("probando");
        $usuario->save();

        // Usuario 12
        $usuario = new User();
        $usuario->alias = "Ivan";
        $usuario->email = "ivan@gmail.com";
        $usuario->password = Hash::make("probando");
        $usuario->save();

        // Usuario 13
        $usuario = new User();
        $usuario->alias = "Pedro";
        $usuario->email = "pedro@gmail.com";
        $usuario->password = Hash::make("probando");
        $usuario->save();

        // Usuario 14
        $usuario = new User();
        $usuario->alias = "Manu";
        $usuario->email = "manu@gmail.com";
        $usuario->password = Hash::make("probando");
        $usuario->save();
        
    }
}
