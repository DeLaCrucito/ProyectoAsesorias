<?php

use App\Models\Subject;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class InstallationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        //Crear Admin
        $administrator = new \App\Models\Administrator();
        $administrator -> usuario = 'Admin';
        $administrator -> correo = 'admin@uacam.mx';
        $administrator -> password = bcrypt('password');
        $administrator -> save();

        //Crear niveles de aprovechamiento
        $exploitation = new \App\Models\Exploitation();
        $exploitation -> nivel = 'Insuficiente';
        $exploitation -> min = '0';
        $exploitation -> max = '69';
        $exploitation -> save();

        $exploitation = new \App\Models\Exploitation();
        $exploitation -> nivel = 'Satisfactorio';
        $exploitation -> min = '70';
        $exploitation -> max = '79';
        $exploitation -> save();

        $exploitation = new \App\Models\Exploitation();
        $exploitation -> nivel = 'Muy Bueno';
        $exploitation -> min = '80';
        $exploitation -> max = '89';
        $exploitation -> save();

        $exploitation = new \App\Models\Exploitation();
        $exploitation -> nivel = 'Excelente';
        $exploitation -> min = '90';
        $exploitation -> max = '100';
        $exploitation -> save();

        //Crear estados
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

        //Crear Facultad de Ingeniería
        $faculty = new \App\Models\Faculty();
        $faculty-> nombre = "Facultad de Ingeniería";
        $faculty->tipo = 'Licenciatura';
        $faculty->save();

        //Crear Licenciaturas de Facultad de Ingeniería
        $degree = new \App\Models\Degree();
        $degree->nombre = "Ingeniería en Sistemas Computacionales";
        $degree->semestres = 8;
        $degree->facultad = 1;
        $degree->save();

        $degree = new \App\Models\Degree();
        $degree->nombre = "Ingeniería en Mecatrónica";
        $degree->semestres = 8;
        $degree->facultad = 1;
        $degree->save();

        $degree = new \App\Models\Degree();
        $degree->nombre = "Ingeniería Civil y Administración";
        $degree->semestres = 8;
        $degree->facultad = 1;
        $degree->save();

        $degree = new \App\Models\Degree();
        $degree->nombre = "Ingeniería en Energía";
        $degree->semestres = 8;
        $degree->facultad = 1;
        $degree->save();

        $degree = new \App\Models\Degree();
        $degree->nombre = "Ingeniería de Desarrollo de Software";
        $degree->semestres = 8;
        $degree->facultad = 1;
        $degree->save();

        $degree = new \App\Models\Degree();
        $degree->nombre = "Ingeniería en Mecánico-Eléctrico";
        $degree->semestres = 8;
        $degree->facultad = 1;
        $degree->save();

        //Se crear las unidades de aprendizaje
        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Álgebra superior';
        $Subject-> fase = 1;
        $Subject-> semestre = 1;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Obligatoria';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Cálculo diferencial';
        $Subject-> fase = 1;
        $Subject-> semestre = 1;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Obligatoria';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Geometría Analítica';
        $Subject-> fase = 1;
        $Subject-> semestre = 1;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Obligatoria';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Elaboración y presentación de textos';
        $Subject-> fase = 1;
        $Subject-> semestre = 1;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Obligatoria';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Lógica de la programación';
        $Subject-> fase = 1;
        $Subject-> semestre = 1;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Obligatoria';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Expresión gráfica';
        $Subject-> fase = 1;
        $Subject-> semestre = 1;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Obligatoria';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Introducción a la ingeniería';
        $Subject-> fase = 1;
        $Subject-> semestre = 1;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Obligatoria';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Inglés 1';
        $Subject-> fase = 1;
        $Subject-> semestre = 1;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Obligatoria';
        $Subject-> save();

        //Segundo semestre
        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Administración general';
        $Subject-> fase = 2;
        $Subject-> semestre = 2;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Obligatoria';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Álgebra lineal';
        $Subject-> fase = 2;
        $Subject-> semestre = 2;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Obligatoria';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Cálculo integral';
        $Subject-> fase = 2;
        $Subject-> semestre = 2;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Obligatoria';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Física';
        $Subject-> fase = 2;
        $Subject-> semestre = 2;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Obligatoria';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Herramientas de la computación';
        $Subject-> fase = 2;
        $Subject-> semestre = 2;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Obligatoria';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Lenguaje de Programación 1';
        $Subject-> fase = 2;
        $Subject-> semestre = 2;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Obligatoria';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Organización Computacional';
        $Subject-> fase = 2;
        $Subject-> semestre = 2;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Obligatoria';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Inglés 2';
        $Subject-> fase = 2;
        $Subject-> semestre = 2;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Obligatoria';
        $Subject-> save();

        //Tercer semestre
        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Análisis de Circuitos de CD';
        $Subject-> fase = 1;
        $Subject-> semestre = 3;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Obligatoria';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Cálculo vectorial';
        $Subject-> fase = 1;
        $Subject-> semestre = 3;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Obligatoria';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Contabilidad';
        $Subject-> fase = 1;
        $Subject-> semestre = 3;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Obligatoria';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Fundamentos de probailidad y estadística';
        $Subject-> fase = 1;
        $Subject-> semestre = 3;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Obligatoria';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Lenguaje de programción 2';
        $Subject-> fase = 1;
        $Subject-> semestre = 3;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Obligatoria';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Matemáticas para la computación';
        $Subject-> fase = 1;
        $Subject-> semestre = 3;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Obligatoria';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Química';
        $Subject-> fase = 1;
        $Subject-> semestre = 3;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Obligatoria';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Inglés 3';
        $Subject-> fase = 1;
        $Subject-> semestre = 3;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Obligatoria';
        $Subject-> save();

        //Cuarto semestre
        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Economía para ingenieros';
        $Subject-> fase = 2;
        $Subject-> semestre = 4;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Obligatoria';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Ecuaciones diferenciales';
        $Subject-> fase = 2;
        $Subject-> semestre = 4;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Obligatoria';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Electrónica';
        $Subject-> fase = 2;
        $Subject-> semestre = 4;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Obligatoria';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Estadísitca aplicada';
        $Subject-> fase = 2;
        $Subject-> semestre = 1;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Obligatoria';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Estructura de datos 1';
        $Subject-> fase = 2;
        $Subject-> semestre = 4;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Obligatoria';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Métodos numéricos';
        $Subject-> fase = 2;
        $Subject-> semestre = 4;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Obligatoria';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Programación de interfaces gráficas de usuario';
        $Subject-> fase = 2;
        $Subject-> semestre = 4;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Obligatoria';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Inglés 1';
        $Subject-> fase = 2;
        $Subject-> semestre = 4;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Obligatoria';
        $Subject-> save();

        //Quinto semestre
        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Administración de archivos';
        $Subject-> fase = 1;
        $Subject-> semestre = 5;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Obligatoria';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Arquitectura computacional';
        $Subject-> fase = 1;
        $Subject-> semestre = 5;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Obligatoria';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Bases de datos I';
        $Subject-> fase = 1;
        $Subject-> semestre = 5;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Obligatoria';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Estructura de datos II';
        $Subject-> fase = 1;
        $Subject-> semestre = 5;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Obligatoria';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Graficación';
        $Subject-> fase = 1;
        $Subject-> semestre = 5;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Obligatoria';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Investigación de operaciones I';
        $Subject-> fase = 1;
        $Subject-> semestre = 5;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Obligatoria';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Telecomunicaciones';
        $Subject-> fase = 1;
        $Subject-> semestre = 5;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Obligatoria';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Inglés 5';
        $Subject-> fase = 1;
        $Subject-> semestre = 5;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Obligatoria';
        $Subject-> save();

        //Sexto semestre
        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Fundamentos de redes';
        $Subject-> fase = 2;
        $Subject-> semestre = 6;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Obligatoria';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Inteligencia artifical';
        $Subject-> fase = 2;
        $Subject-> semestre = 6;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Obligatoria';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Investigación de operaciones II';
        $Subject-> fase = 2;
        $Subject-> semestre = 6;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Obligatoria';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Simulación';
        $Subject-> fase = 2;
        $Subject-> semestre = 6;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Obligatoria';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Sistemas I';
        $Subject-> fase = 2;
        $Subject-> semestre = 6;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Obligatoria';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Sistemas Operativos';
        $Subject-> fase = 2;
        $Subject-> semestre = 6;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Obligatoria';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Taller de Base de Datos';
        $Subject-> fase = 2;
        $Subject-> semestre = 6;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Obligatoria';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Inglés 6';
        $Subject-> fase = 2;
        $Subject-> semestre = 6;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Obligatoria';
        $Subject-> save();

        //Septimo semestre
        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Base de datos II';
        $Subject-> fase = 1;
        $Subject-> semestre = 7;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Obligatoria';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Compiladores';
        $Subject-> fase = 1;
        $Subject-> semestre = 7;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Obligatoria';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Ingeniería de software';
        $Subject-> fase = 1;
        $Subject-> semestre = 7;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Optativa';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Programación de aplicaciones web';
        $Subject-> fase = 1;
        $Subject-> semestre = 7;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Obligatoria';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Redes I';
        $Subject-> fase = 1;
        $Subject-> semestre = 7;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Optativa';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Sistemas II';
        $Subject-> fase = 1;
        $Subject-> semestre = 7;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Obligatoria';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Sistemas inteligentes I';
        $Subject-> fase = 1;
        $Subject-> semestre = 7;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Optativa';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Taller de emprendedores';
        $Subject-> fase = 1;
        $Subject-> semestre = 7;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Obligatoria';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Métodología de la investigación';
        $Subject-> fase = 1;
        $Subject-> semestre = 7;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Obligatoria';
        $Subject-> save();

        //Octavo semestre
        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Administrador de servidores';
        $Subject-> fase = 2;
        $Subject-> semestre = 8;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Optativa';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Administración de Tecnologías de la Información';
        $Subject-> fase = 2;
        $Subject-> semestre = 8;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Obligatoria';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Desarrollo de aplicaciones móviles';
        $Subject-> fase = 2;
        $Subject-> semestre = 8;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Optativa';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Gestión de proyectos de software';
        $Subject-> fase = 2;
        $Subject-> semestre = 8;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Obligatoria';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Legislación y ética profesional';
        $Subject-> fase = 2;
        $Subject-> semestre = 8;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Obligatoria';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Recursos y necesidades de México';
        $Subject-> fase = 2;
        $Subject-> semestre = 8;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Obligatoria';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Redes II';
        $Subject-> fase = 2;
        $Subject-> semestre = 8;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Optativa';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Sistemas distribuidos';
        $Subject-> fase = 2;
        $Subject-> semestre = 8;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Obligatoria';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Sistemas inteligentes II';
        $Subject-> fase = 2;
        $Subject-> semestre = 8;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Optativa';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Temas Selectos de Programación';
        $Subject-> fase = 2;
        $Subject-> semestre = 8;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Optativa';
        $Subject-> save();

        $Subject = new Subject();
        $Subject-> licenciatura = 1;
        $Subject-> nombre = 'Temas selectos de sistemas inteligentes';
        $Subject-> fase = 2;
        $Subject-> semestre = 8;
        $Subject-> clave = $faker->randomNumber;
        $Subject -> tipo = 'Optativa';
        $Subject-> save();

        //Cuentas de prueba
            //Coordinador
            $coordinador = new \App\Models\Coordinator();
            $coordinador->nombre = 'Coordinador';
            $coordinador->apellido = 'De Prueba';
            $coordinador->licenciatura = 1;
            $coordinador->correo = 'coordinador@uacam.mx';
            $coordinador->password = bcrypt('password');
            $coordinador->save();

            //Asesor
            $asesor = new \App\Models\Consultant();
            $asesor -> nombre = 'Asesor';
            $asesor -> apellido = 'De Prueba';
            $asesor -> correo = 'asesor@uacam.mx';
            $asesor -> password = bcrypt('password');
            $asesor -> nivel_estudio = 'Maestría';
            $asesor -> especialidad = 'Redes';
            $asesor -> lugar = 'Lugar de prueba';
            $asesor -> save();
    }
}
