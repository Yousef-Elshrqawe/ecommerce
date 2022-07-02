<?php

namespace Database\Seeders;

use App\Models\Slide;
use Illuminate\Database\Seeder;

class SlideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Slide::create(['Inspiration' => 'Clothes lopry', 'offer' => 'Clothes offer', 'link' => 'index', 'Covers' => 'hero-banner-alt.jpg']);


    }
}
