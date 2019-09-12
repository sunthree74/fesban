<?php

use Illuminate\Database\Seeder;
use App\Anggota;
use Faker\Factory as Faker;

class FlexibleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        for ($i=0; $i < 10; $i++) { 
            Anggota::create([
                'klub_id' => 1,
                'name' => $faker->firstNameMale,
                'nohp' => $faker->e164PhoneNumber,
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => $faker->date,
            ]);
        }
    }
}
