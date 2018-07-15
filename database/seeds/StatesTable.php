<?php

use Illuminate\Database\Seeder;

class StatesTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $State = new \App\Models\State();
        $State->nombre = 'Pendiente';
        $State->icon = 'access_alarm';
        $State->mensaje = 'Pendiente';
        $State->color = 'purple';
        $State->save();

        $State = new \App\Models\State();
        $State->nombre = 'Completada';
        $State->icon = 'check';
        $State->mensaje = 'Completada';
        $State->color = 'green';
        $State->save();

        $State = new \App\Models\State();
        $State->nombre = 'No realizada';
        $State->icon = 'close';
        $State->mensaje = 'No se realizó';
        $State->color = 'red';
        $State->save();

        $State = new \App\Models\State();
        $State->nombre = 'En proceso';
        $State->icon = 'event_available';
        $State->mensaje = 'Se encuetra en proceso';
        $State->color = 'blue';
        $State->save();
    }
}
