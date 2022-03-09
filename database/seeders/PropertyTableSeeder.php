<?php

namespace Database\Seeders;
use App\Models\Property;
use Illuminate\Database\Seeder;

class PropertyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 50; $i++) {
            Property::create([
                'title' => $faker->sentence,
                'description' => $faker->paragraph,
                'address' => $faker->address,
                'image' => $faker->imageUrl($width = 200, $height = 200),
                'size' => $faker->numberBetween(40,450),
                'city' => $faker->city,
                'postcode' => $faker->postcode,
                'price' => $faker->randomDigit, 
                'floor' =>$faker->numberBetween(1,20),
                'room' =>$faker->numberBetween(1,10),

            ]);
        }
    }
}

