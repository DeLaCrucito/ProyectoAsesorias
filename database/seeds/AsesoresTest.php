<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class AsesoresTest extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i=0; $i < 20; $i++) {
            $asesor = new \App\Models\Consultant();
            $asesor -> nombre = $faker->firstName;
            $asesor -> apellido = $faker->lastName;
            $asesor -> correo = $faker->userName.'@uacam.mx';
            $asesor -> password = bcrypt('password');
            $asesor -> nivel_estudio = 'Maestría';
            $asesor -> especialidad = $faker->randomElement(['Sistemas Inteligentes','Comunicación','Estadística','Planeación']);
            $asesor -> save();
        }
    }
}
