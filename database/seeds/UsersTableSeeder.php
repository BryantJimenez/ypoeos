<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
        	'name' => 'Super',
            'lastname' => 'Admin',
            'phone' => '12345678',
        	'photo' => 'usuario.png',
        	'slug' => 'super-admin',
        	'email' => 'admin@gmail.com',
        	'password' => bcrypt('12345678'),
        	'state' => "1",
            'type' => 1
        ]);

        factory(App\User::class, 100)->create();

        factory(App\Implementer::class, 100)->create();

        factory(App\Testimonial::class, 500)->create();

        $users = [
            ['id' => 102, 'name' => 'Mike', 'lastname' => 'Abercrombie', 'phone' => '12345678', 'photo' => 'mike-abercrombie.jpg', 'slug' => 'mike-abercrombie', 'email' => 'mike.abercrombie@gmail.com', 'password' => NULL, 'state' => "1", 'type' => "2"],
            ['id' => 103, 'name' => 'Michael', 'lastname' => 'Bloch', 'phone' => '12345678', 'photo' => 'michael-bloch.jpg', 'slug' => 'michael-bloch', 'email' => 'michael.bloch@gmail.com', 'password' => NULL, 'state' => "1", 'type' => "2"]
        ];
        DB::table('users')->insert($users);

        $implementers = [
            ['id' => 101, 'title' => 'YPO Gold - Angeleno', 'address' => '60283 Hudson Highway West Lorainehaven, NC 46521', 'lat' => '37.163787', 'lng' => '-83.215554', 'experience' => "<p>Mike joined the Young President’s Organization (YPO) in 2001.</p><p>In 2015, Mike sold his training business to a global IT training organization and exited the business to focus on helping business leaders implement EOS. As a Certified EOS Implementer, Mike combines his business experience and love of teaching and group facilitation to fulfill his dream of helping other entrepreneurs after he was finished with his own business.</p><p>Mike is a respected YPO resource for forums, a YPO Certified Forum Facilitator and has serviced on the YPO International Forum Committee and is the co-author of the YPO Gold Forum Jumpstart program.</p><p>His business background provides context for the power and application of the EOS® tools in an entrepreneurial company. Couple that with his 10 years of teaching and facilitating business executives, Mike is able to help his clients navigate the tough but powerful conversations needed to move their business forward. The result is an aligned vision, better execution, a healthier leadership team, and organizational results.</p><p>In 2017 Mike was invited on to the EOS Worldwide Coaching team where he helps mentor new EOS Implementers on their journey to mastery in helping leadership teams get what they want from their businesses.</p>", 'ypo_link' => 'https://google.com', 'facebook' => NULL, 'twitter' => NULL, 'linkedin' => NULL, 'user_id' => 102],
            ['id' => 102, 'title' => 'YPO Gold - Angeleno', 'address' => '1782 Lakin Summit East Marcellamouth, MN 66076', 'lat' => '47.972759', 'lng' => '-94.747648', 'experience' => "<p>Michael Bloch (YPO Patriot Gold / YPO Gold New England) is a Professional EOS® Implementer and  sought after resource to YPO chapters, forums, regions and networks.  Michael has been both the 4th generation CEO of his family business and the founder of two successful start-ups, so he has a unique insider’s perspective on the pressures and challenges faced by CEOs and senior leaders in both family and entrepreneurial businesses.</p><p>Since successfully exiting his businesses, Michael has trained, facilitated and coached over 3,000 CEOs and business leaders around the world.</p><p>Combining his practical experience as a CEO and company founder with the authenticity, vulnerability and emotional intelligence he brings as a top-rated YPO Certified Forum Facilitator, Michael helps entrepreneurs, business owners and leadership teams create the vision, accountability and trust necessary to get everything they want from their business.</p><p>In addition to his work as a EOS® implementer and forum facilitator, Michael is an active YPO member having held leadership roles at the chapter, regional and international levels. Michael is the recipient of four prestigious YPO International Best of the Best Awards and recently received a Legacy Award for his long-term positive impact on the organization.  In 2019, Michael served as Chair of the YPO Global Leadership Conference held in Cape Town South Africa, receiving the highest scores ever for a non-U.S. based GLC.</p><p>Outside of work, Michael enjoys documentary filmmaking and is an avid cyclist. As a cancer survivor, he is also an active fundraiser for cancer research. Michael and his spouse Sondra have three young adult sons and reside just outside Boston.</p>", 'ypo_link' => 'https://google.com', 'facebook' => NULL, 'twitter' => NULL, 'linkedin' => NULL, 'user_id' => 103]
        ];
        DB::table('implementers')->insert($implementers);

        $testimonials = [
            ['id' => 501, 'slug' => 'testimonial-chris-lombardi', 'name' => 'Chris Lombardi', 'title' => NULL, 'testimonial' => 'Running a second generation family business has its challenges.  EOS provided me the framework to transition out of the “lifestyle family business” model and into collaborative business model with clearly defined goals, transparent communication, and documented processes to align everyone on the team.', 'implementer_id' => 101],
            ['id' => 502, 'slug' => 'testimonial-hawthorne-castro', 'name' => 'Jessica Hawthorne-Castro', 'title' => NULL, 'testimonial' => 'EOS has been a game changing operational platform. EOS brings various best-in-class operational elements together in one comprehensive system and makes everyone on your executive team and all employees accountable. Using an EOS implementer on a quarterly basis to keep the cadence up with your teams and the 90 day reset is key as well.', 'implementer_id' => 101],
            ['id' => 503, 'slug' => 'testimonial-todd-dipaola', 'name' => 'Todd Dipaola', 'title' => NULL, 'testimonial' => "Running on EOS transformed our ability to diagnose challenges and gave a simple powerful framework to quadrupling in 2 years. Its like a chiropractic adjustment-- you didn't know your spine was tweaked until you suddenly had the weight lifted off your shoulders.", 'implementer_id' => 101],
            ['id' => 504, 'slug' => 'testimonial-alex-amin', 'name' => 'Alex Amin', 'title' => NULL, 'testimonial' => 'We are in the third year of owning and operating a 200-person global software business.  The EOS framework has been essential in helping my partner and I run the day-to-day operations; keep all employees aligned on mission, vision and goals; and drive real growth.', 'implementer_id' => 101],
            ['id' => 505, 'slug' => 'testimonial-aaron-pick', 'name' => 'Aaron Pick', 'title' => NULL, 'testimonial' => 'EOS has been a game changer for us as a company.  More than anything, it keeps us aligned across the organization and helps our lead.', 'implementer_id' => 101],
            ['id' => 506, 'slug' => 'testimonial-christopher-j-floyd-ypo-new-england', 'name' => 'Christopher J. Floyd (YPO New England)', 'title' => 'President / CEO of C.E. Floyd Company', 'testimonial' => 'I took over the business from my father in 2015 and realized the business was underperforming its potential. I like to think big picture and focus on continuous improvement, while my employees have an engineering mindset that crave clarity and predictability. Three years after implementing EOS, my organizational structure, new leadership, clear accountabilities and long-term strategy are in place and clearly stated. We live our core values every day.', 'implementer_id' => 102],
            ['id' => 507, 'slug' => 'testimonial-daniel-koffler-ypo-metro-new-york', 'name' => 'Daniel Koffler (YPO Metro New York)', 'title' => 'Founder/President New Frontiers', 'testimonial' => 'The key difference between everything else I’ve ever been exposed to and EOS is the depth the system goes into in explaining HOW to run a business (from how to run a meeting, to how to hold people accountable, to how to differentiate between a goal and a strategy and a tactic and an action in the pursuit of achieving that goal—spoiler alert, it all starts with CORE VALUES (which made no sense to me prior and sounded pretty touchy-feely…until it clicked, and clarified in large part why previous attempts/approaches weren’t working.', 'implementer_id' => 102],
            ['id' => 508, 'slug' => 'testimonial-derek-mohamed-ypo-new-england', 'name' => 'Derek Mohamed (YPO New England)', 'title' => 'Managing Director Mohamed-Merola Wealth Management', 'testimonial' => 'I can’t say enough positive things about the EOS the impact that it has had on my business. For many years we tried to implement strategy around our culture, values, our long-term goals and our short-term goals, as well as finding the right people, managing people in the organization etc. When I first read Traction, it was an “ah-ha” moment. This was the first time I had ever seen all of these issues addressed in one place with a system that ties it all together. We started implementing the EOS system in our business in 2016. It’s no coincidence that our business has doubled in the four years since then, which is extremely unusual in our space with a business that has been running for over 20 years.   Anyone running a small or midsized businesses that wants to take it to the next level or just wants to see if there’s a way to run things more efficiently should explore EOS.', 'implementer_id' => 102]
        ];
        DB::table('testimonials')->insert($testimonials);
    }
}
