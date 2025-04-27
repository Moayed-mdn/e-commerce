<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker=Faker::create();
        DB::table('staff')->insert([
            "name"=>"Admin User",
            "username"=>"admin",
            "password"=>Hash::make('123'),
            "role_id"=>Role::ADMIN,
            "birth_date"=>$faker->date('Y-m-d','-20 years'),
            "gender"=>$faker->randomElement(['male','female']),
            "created_at"=>now(),
            "updated_at"=>now(),
        ]);
    }
}
