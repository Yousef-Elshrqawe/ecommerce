<?php

namespace Database\Seeders;

use App\Models\Social_media;
use Illuminate\Database\Seeder;

class SocialMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Social_media::create(['name' => 'Instagram', 'url' => 'Chttps://www.instagram.com/yo0011480/']);
        Social_media::create(['name' => 'Whatsapp', 'url' => 'https://wa.me/0201016736771']);
        Social_media::create(['name' => 'FaceBook', 'url' => 'https://www.facebook.com/profile.php?id=100022212197609']);

    }
}
