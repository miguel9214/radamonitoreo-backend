<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UpdateCustomersWithDniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = DB::table('customers')->take(204)->get();
        $dniStart = 1000000000; // Puedes ajustar el rango inicial del DNI.

        foreach ($customers as $index => $customer) {
            $dni = $dniStart + $index; // Genera valores únicos consecutivos.
            DB::table('customers')->where('id', $customer->id)->update(['dni' => $dni]);
        }
    }
}
