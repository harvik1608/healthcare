<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecialitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specialities = [
            'Cardiologist', 'Dermatologist', 'Neurologist', 'Orthopedic Surgeon',
            'Pediatrician', 'Gynecologist', 'ENT Specialist', 'Ophthalmologist',
            'Oncologist', 'Urologist'];

        foreach ($specialities as $speciality) {
            DB::table('specialities')->insert([
                'name' => $speciality,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
