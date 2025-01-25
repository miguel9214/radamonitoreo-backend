<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class UpdateSuppliersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $suppliers = DB::table('suppliers')->take(150)->get(); // Obtén los primeros 150 registros

        $rutStart = 100000; // Ajusta el rango inicial del RUT si es necesario

        foreach ($suppliers as $index => $supplier) {
            $rut = $rutStart + $index; // Genera un valor único para el RUT
            $formattedRut = $rut . '-' . rand(0, 9); // Añade un dígito verificador al RUT

            DB::table('suppliers')
                ->where('id', $supplier->id)
                ->update([
                    'rut' => $formattedRut, // Actualiza el campo `rut`
                    'company_name' => $faker->company, // Genera un nombre de empresa aleatorio
                ]);
        }
    }
}
