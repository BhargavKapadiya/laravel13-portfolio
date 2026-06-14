<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CmsPages;

class CMSPagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = CmsPages::firstOrCreate(
            ['id' => 1],
            [
                'page_name' => 'Home Page',
                'contents' => json_encode([
                    'heading' => 'Feeling left out',
                    'banner_title_1' => 'Feeling left out? Be a part of it!',
                    'banner_image_1' => 'Img-2023120709483975.png',
                    'title_1' => 'Unlock your code… Play your lucky…',
                    'short_title_1' => 'Unlock your code',
                    'image_1' => 'Img-20231207094839100.png',
                    'content_1' => 'What is Lorem Ipsum?',
                    'image_2' => 'Img-2023120709484087.png',
                    'editor_1' => 'What is Lorem Ipsum?',
                    'video' => 'video1.mp4',
                    'link_1' => 'https://google.com',
                    'editor_2' => 'What is Lorem Ipsum? Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                Where does it come from?',
                ]),
                'slug' => 'cms.home',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        );
    }
}
