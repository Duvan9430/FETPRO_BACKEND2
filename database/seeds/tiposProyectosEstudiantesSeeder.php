<?php

use Illuminate\Database\Seeder;
use App\Elementos_listas;

class tiposProyectosEstudiantesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipos = [
            [
                "id" => 1,
                "nombre" => "Proyecto de aula",
                "descripcion" => "El estudiante podrá inscribir su proyecto de aula, así poderlo presentar en las ferias de emprendimiento. Este proyecto es el trabajado en el aula de clase",
                "tipo_lista_id" => 1
            ],
            [
                "id" => 2,
                "nombre" => "Proyecto de semillero",
                "descripcion" => "El estudiante podrá inscribir su proyecto de semillero, este proyecto tendrá como objetivo generar un producto que puntúe en Colciencias",
                "tipo_lista_id" => 1
            ],
            [
                "id" => 3,
                "nombre" => "Proyecto de grado",
                "descripcion" => "El estudiante podrá inscribir su proyecto de grado, este proyecto debe tener todos los lineamientos que se requiere según el ciclo propedéutico",
                "tipo_lista_id" => 1
            ],
            [
                "id" => 4,
                "nombre" => "Proyecto de emprendimiento",
                "descripcion" => "El estudiante podrá inscribir su proyecto para emprender (generar empresa), este proyecto será evaluado por la FET y tendrá como resultado un proyecto de vida",
                "tipo_lista_id" => 1
            ],
    ];



        foreach($tipos as $elementos){
            $elementos_listas = new Elementos_listas;
            $elementos_listas->id  = $elementos["id"];
            $elementos_listas->nombre  = $elementos["nombre"];
            $elementos_listas->descripcion  = $elementos["descripcion"];
            $elementos_listas->tipo_lista_id  = $elementos["tipo_lista_id"];
            $elementos_listas->save();
        }
    }
}
