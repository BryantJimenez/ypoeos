<?php

use Illuminate\Database\Seeder;

class BannersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banner = [
    		['id' => 1, 'image' => 'banner.jpg', 'title' => 'You Deserve to Get What You Want From Your Business', 'slug' => 'banner', 'text' => NULL, 'button' => "1", 'button_text' => 'Find An Implementer', 'pre_url' => 'http://', 'url' => 'ypoeos.otterscompany.com/implementers', 'target' => '0', 'type' => '1', 'state' => '1']
    	];
    	DB::table('banners')->insert($banner);
    }
}
