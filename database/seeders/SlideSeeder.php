<?php

namespace Database\Seeders;

use App\Models\Slide;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SlideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Slide::create([
            'title' => 'TBV-TripleB',
            'color_title' => '#ff0000',
            'subtitle' => 'Welkome op onze nieuwe site',
            'color_subtitle' => '#0000ff',
            'image' => 'slides/1.jpg',
            'status' => '1',
        ]);

        Slide::create([
            'title' => 'TBV-TripleB',
            'color_title' => '#00ff00',
            'subtitle' => 'Lets Play',
            'color_subtitle' => '#ff00ff',
            'image' => 'slides/2.jpg',
            'status' => '1',
        ]);
    }
}
