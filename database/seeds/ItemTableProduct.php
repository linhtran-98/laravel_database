<?php

use Illuminate\Database\Seeder;

class ItemTableProduct extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fake  = Faker\Factory::create();
        $limit = 10;

        for ($i = 0; $i < $limit; $i++){
            DB::table('products')->insert([
                'name' => $fake->name,
                'title' => $fake->name,
                'price' => $fake->numerify($string = '######'),
                'image' => $fake->imageUrl($width = 200, $height = 200),
                'description' => $fake->sentence,
                'created_at' => $fake->date("Y-m-d H:i:s"),
                'updated_at' => $fake->date("Y-m-d H:i:s")
            ]);
        }
    }
}
