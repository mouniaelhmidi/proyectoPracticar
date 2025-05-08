<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category; //importar el modelo
class CategorySeed extends Seeder{
    //Run the database seeds.
    public function run(): void
    {
        \App\Models\Category::factory(5)->create(); // Crea 5 categorías


        $categories = [
            'Informàtica',
            'Logistica',
            'Administració',
            'Estiu',
        ];
        foreach ($categories as $name) {
            Category::updateOrCreate(
                ['name' => $name], // Fields to search
                ['name' => $name]  // Fields to create/update
            );
        }
    }
}
