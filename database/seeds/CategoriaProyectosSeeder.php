<?php

use Illuminate\Database\Seeder;
use App\Tipos_listas;

class CategoriaProyectosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoria_proyectos = [
            ["nombre" => "Tipo proyectos de estudiantes",
            "id"=>1,
            "descripcion"=> "Categoria de proyectos para estudiantes"],
            ["nombre" => "Tipo proyectos de empresas",
            "id"=>2,
            "descripcion"=> "Categoria de proyectos para estudiantes"],
        ];


        foreach($categoria_proyectos as $elemento){
            $tipos_listas = new Tipos_listas;
            $tipos_listas->id = $elemento["id"];

            $tipos_listas->nombre = $elemento["nombre"];
            $tipos_listas->descripcion = $elemento["descripcion"];
            $tipos_listas->save();
        }

    }
}
