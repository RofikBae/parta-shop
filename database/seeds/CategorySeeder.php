<?php

use App\Model\Category;
use Illuminate\Database\Seeder;
use illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name'        => 'Flagship',
            'slug'        => Str::slug('Flagship'),
            'description' => 'Flagship Phone'
        ]);
        Category::create([
            'name'        => 'Midrange',
            'slug'        => Str::slug('Midrange'),
            'description' => 'Midrange Phone'
        ]);
        Category::create([
            'name'        => 'Low End',
            'slug'        => Str::slug('Low End'),
            'description' => 'Low End Phone'
        ]);
        Category::create([
            'name'        => 'Asus',
            'slug'        => Str::slug('Asus'),
            'description' => 'Asus Phone'
        ]);
        Category::create([
            'name'        => 'Samsung',
            'slug'        => Str::slug('Samsung'),
            'description' => 'Samsung Phone'
        ]);
        Category::create([
            'name'        => 'Oppo',
            'slug'        => Str::slug('Oppo'),
            'description' => 'Oppo Phone'
        ]);
        Category::create([
            'name'        => 'Vivo',
            'slug'        => Str::slug('Vivo'),
            'description' => 'Vivo Phone'
        ]);
    }
}
