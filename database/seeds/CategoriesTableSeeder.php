<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ["type"=> "tutorial"],
            ["type"=> "comunication"],
            ["type"=> "news"],
            ["type"=> "art"],
            ["type"=> "travel"]
          ];

          foreach ($categories as $category) {
            $newCat = new Category();
            $newCat->fill($category);
            $newCat->save();
          }
    }
}
