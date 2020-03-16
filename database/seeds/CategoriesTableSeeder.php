<?php

use Illuminate\Database\Seeder;
use App\Categories;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = new Categories();
        $categories->name = 'Thể thao';
        $categories->user_id = 1;
        $categories->save();

        $categories = new Categories();
        $categories->name = 'Đời sống';
        $categories->user_id = 1;
        $categories->save();

        $categories = new Categories();
        $categories->name = 'Kinh tế';
        $categories->user_id = 1;
        $categories->save();

        $categories = new Categories();
        $categories->name = 'Sức khỏe';
        $categories->user_id = 1;
        $categories->save();

        $categories = new Categories();
        $categories->name = 'Khoa học';
        $categories->user_id = 1;
        $categories->save();
    }
}