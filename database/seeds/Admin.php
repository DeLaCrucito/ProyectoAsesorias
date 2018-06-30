<?php

use Illuminate\Database\Seeder;

class Admin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $administrator = new \App\Models\Administrator();
        $administrator -> usuario = 'Admin';
        $administrator -> correo = 'admin@uacam.mx';
        $administrator -> password = bcrypt('password');
        $administrator -> save();
    }
}
