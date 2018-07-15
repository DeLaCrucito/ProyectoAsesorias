<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CoordinadorTest extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('es-ES');
        for ($i=0; $i < 20; $i++) {
            $coordinador = new \App\Models\Coordinator();
            $coordinador->nombre = $faker->firstName;
            $coordinador->apellido = $faker->lastName;
            $coordinador->licenciatura = $faker->numberBetween($min = 1, $max = 6);
            $coordinador->correo = $faker->userName.'@uacam.mx';
            $coordinador->password = bcrypt('password');
            $coordinador->save();
        }
    }
}
