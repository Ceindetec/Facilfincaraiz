<?php

use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'nombres' => "luis carlos",
            'apellidos' => "pineda",
            'email' => "luis.pineda@ceindetec.org.co",
            'password' => bcrypt('123'),
            'rol' => "superAdmin",
            'telefono' => "3138585565",
        ]);

        DB::table('tipos')->insert([
            ['tipo'=>"Apartaestudio" , 'categoria'=>'I'],
            ['tipo'=>"Apartamento" , 'categoria'=>'I'],
            ['tipo'=>"Bodega" , 'categoria'=>'I'],
            ['tipo'=>"Casa" , 'categoria'=>'I'],
            ['tipo'=>"Casa quinta" , 'categoria'=>'I'],
            ['tipo'=>"Edificio" , 'categoria'=>'I'],
            ['tipo'=>"Finca" , 'categoria'=>'I'],
            ['tipo'=>"Local comercial" , 'categoria'=>'I'],
            ['tipo'=>"Otros inmuebles" , 'categoria'=>'I'],

            ['tipo'=>"Automovil" , 'categoria'=>'V'],
            ['tipo'=>"Camioneta" , 'categoria'=>'V'],
            ['tipo'=>"Bus-Buseta" , 'categoria'=>'V'],
            ['tipo'=>"Camion" , 'categoria'=>'V'],
            ['tipo'=>"Campero" , 'categoria'=>'V'],
            ['tipo'=>"Moto" , 'categoria'=>'V'],
            ['tipo'=>"Moto-Carro" , 'categoria'=>'V'],
            ['tipo'=>"Cuatrimoto" , 'categoria'=>'V'],
            ['tipo'=>"Otros" , 'categoria'=>'V'],

            ['tipo'=>"Lotes" , 'categoria'=>'T'],
            ['tipo'=>"Grandes terrenos" , 'categoria'=>'T'],
            ['tipo'=>"Parcelas cementerios" , 'categoria'=>'T']
        ]);









    }
}
