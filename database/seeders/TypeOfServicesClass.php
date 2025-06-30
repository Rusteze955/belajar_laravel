<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TypeOfServices;

class TypeOfServicesClass extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TypeOfServices::insert([
            [
                'service_name' => 'Hanya Cuci',
                'price' => 5000,
                'description' => 'Service hanya cuci reguler'
            ],
            [
                'service_name' => 'Hanya Gosok',
                'price' => 4000,
                'description' => 'Service hanya gosok reguler'
            ],
            [
                'service_name' => 'Cuci dan Gosok',
                'price' => 8000,
                'description' => 'Service hanya cuci dan gosok reguler'
            ],
            [
                'service_name' => 'Laundry Besar',
                'price' => 10000,
                'description' => 'Service hanya cuci dan gosok besar seperti selimut, karpet, dll'
            ],
        ]);
    }
}
