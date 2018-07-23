<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AlumnosTest extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('es-MX');
        for ($i=0; $i < 1000; $i++) {
            $asesor = new \App\Models\Student();
            $asesor -> nombre = $faker->firstName;
            $asesor -> apellido = $faker->lastName;
            $asesor -> correo = $faker->userName.'@uacam.mx';
            $asesor -> password = bcrypt('password');
            $asesor -> licenciatura = 1;
            $asesor -> semestre = $faker->numberBetween($min = 1, $max = 8);
            $asesor -> matricula = $faker->numberBetween($min = 10000, $max= 99999);

            $asesor -> save();
        }
    }
}
