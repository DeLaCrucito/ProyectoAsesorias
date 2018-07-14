<?php

use Illuminate\Database\Seeder;

class LicenciaturaTest extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $degree = new \App\Models\Degree();
        $degree->nombre = "Ingeniería en Sistemas Computacionales";
        $degree->semestres = 8;
        $degree->facultad = 14;
        $degree->save();

        $degree = new \App\Models\Degree();
        $degree->nombre = "Ingeniería en Mecatrónica";
        $degree->semestres = 8;
        $degree->facultad = 14;
        $degree->save();

        $degree = new \App\Models\Degree();
        $degree->nombre = "Ingeniería Civil y Administración";
        $degree->semestres = 8;
        $degree->facultad = 14;
        $degree->save();

        $degree = new \App\Models\Degree();
        $degree->nombre = "Ingeniería en Energía";
        $degree->semestres = 8;
        $degree->facultad = 14;
        $degree->save();

        $degree = new \App\Models\Degree();
        $degree->nombre = "Ingeniería de Desarrollo de Software";
        $degree->semestres = 8;
        $degree->facultad = 14;
        $degree->save();

        $degree = new \App\Models\Degree();
        $degree->nombre = "Ingeniería en Mecánico-Eléctrico";
        $degree->semestres = 8;
        $degree->facultad = 14;
        $degree->save();
    }
}
