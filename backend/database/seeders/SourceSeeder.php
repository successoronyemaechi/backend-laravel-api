<?php

namespace Database\Seeders;

use App\Models\Source;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $sources = [
            [
                'name' => 'NewsApi'
            ],
            [
                'name' => 'GuardianApi'
            ],
            [
                'name' => 'BBC'
            ],
        ];

        foreach ($sources as $key => $value) {
            Source::query()->create($value);
        }
    }
}
