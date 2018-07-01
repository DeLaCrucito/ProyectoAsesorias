<?php

use Illuminate\Database\Seeder;

class Asesor extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $asesor = new \App\Models\Consultant();
        $asesor -> nombre = 'Asesor';
        $asesor -> apellido = 'De Prueba';
        $asesor -> correo = 'asesor@uacam.mx';
        $asesor -> password = bcrypt('password');
        $asesor -> nivel_estudio = 'Maestría';
        $asesor -> especialidad = 'Redes';
        $asesor -> save();
    }
}
