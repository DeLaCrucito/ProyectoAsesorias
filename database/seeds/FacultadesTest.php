<?php

use Illuminate\Database\Seeder;

class FacultadesTest extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faculty = new \App\Models\Faculty();
        $faculty-> nombre = "Facultad de Ingeniería";
        $faculty->tipo = 'Licenciatura';
        $faculty->save();
    }
}
