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
    public function run()
    {
        $categories = [
            [
                'name' => 'Business',
            ],
            [
                'name' => 'Entertainment'
            ],
            [
                'name' => 'General'
            ],
            [
                'name' => 'Health'
            ],
            [
                'name' => 'Science'
            ],
            [
                'name' => 'Sports'
            ],
            [
                'name' => 'Technology'
            ],
        ];

        foreach ($categories as $key => $value) {
            Category::query()->create($value);
        }
    }
}
