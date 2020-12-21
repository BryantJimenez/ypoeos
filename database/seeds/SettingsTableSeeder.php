<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
    		['id' => 1, 'video' => 'https://www.youtube.com/watch?v=HQ5kd6p21bU', 'feature_one' => 'Break thru the ceiling to achieve the growth you envision', 'feature_two' => 'A systemized business that is easier to run and more profitable', 'feature_three' => 'Your team solving issues and executing with personal accountability', 'feature_four' => 'Gain time and money freedom to enhance your quality of Life', 'why_works' => '<p>Thousands of entrepreneurial companies around the world are running on The Entrepreneurial Operating System®. Their owners and leaders are getting more of what they want from the business, and you can too. What is it about EOS® that makes it work so well in a small, growing business?</p><ul><li><b>Built for Busy Entrepreneurs.</b> EOS is made up of simple concepts and practical tools that can be easily applied in a fast-paced small business. There’s no theory, no management fads – just basic, useful tools that help people get more of the right stuff done every week.</li><li><b>Holistic Model and Approach.</b> EOS doesn’t treat symptoms – it helps you cure the “whole body” by strengthening the Six Key Components™ of your business – Vision, People, Data, Issues, Process, and Traction.</li><li><b>Designed to Solve Issues Once and For All.</b> By helping you and your team focus on the “root cause” of your issues – EOS takes you below the surface to produce real, permanent change.</li><li><b>Brings Focus, Discipline and Accountability.</b> EOS is a simple framework for defining what’s important, who owns it, and exactly what success looks like. With every member of your team accountable for a handful of goals and numbers, you’ll get consistently better results.</li></ul><p>EOS works in any entrepreneurial company – across all industries and business models. If you’ve got people in your business, EOS can help you clarify, simplify and achieve your vision.</p>', 'phone' => NULL]
    	];
    	DB::table('settings')->insert($settings);
    }
}
