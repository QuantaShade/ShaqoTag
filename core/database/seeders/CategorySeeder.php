<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Web Development' => 'Websites, web applications, and backend services.',
            'Design' => 'Product, interface, and visual design work.',
            'Writing' => 'Articles, copywriting, and technical documentation.',
            'Marketing' => 'Digital marketing, growth, and social media work.',
            'Data & Analytics' => 'Data engineering, reporting, and analysis.',
            'Mobile Development' => 'Native and cross-platform mobile applications.',
        ];

        foreach ($categories as $name => $description) {
            Category::firstOrCreate(
                ['slug' => str($name)->slug()],
                ['name' => $name, 'description' => $description],
            );
        }
    }
}
