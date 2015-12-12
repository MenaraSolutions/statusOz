<?php

use Illuminate\Database\Seeder;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subjects')->insert([
            'title' => 'Telstra Perth',
            'group' => 'Telstra',
            'settings' => json_encode([
                'workers' => ['Singapore'],
                'tester_parameter' => 2627
            ])
        ]);

        DB::table('subjects')->insert([
            'title' => 'Telstra Sydney',
            'group' => 'Telstra',
            'settings' => json_encode([
                'workers' => ['California'],
                'tester_parameter' => 2629
            ])
        ]);

        DB::table('subjects')->insert([
            'title' => 'Optus Perth',
            'group' => 'Optus',
            'settings' => json_encode([
                'workers' => ['Singapore'],
                'tester_parameter' => 3414
            ])
        ]);

        DB::table('subjects')->insert([
            'title' => 'Optus Sydney',
            'group' => 'Telstra',
            'settings' => json_encode([
                'workers' => ['California'],
                'tester_parameter' => 1267
            ])
        ]);

        DB::table('subjects')->insert([
            'title' => 'Internode Perth',
            'group' => 'Internode',
            'settings' => json_encode([
                'workers' => ['Singapore'],
                'tester_parameter' => 2171
            ])
        ]);

        DB::table('subjects')->insert([
            'title' => 'Internode Sydney',
            'group' => 'Internode',
            'settings' => json_encode([
                'workers' => ['California'],
                'tester_parameter' => 2173
            ])
        ]);

        DB::table('subjects')->insert([
            'title' => 'AARNet Perth',
            'group' => 'AARNet',
            'settings' => json_encode([
                'workers' => ['Singapore'],
                'tester_parameter' => 6153
            ])
        ]);

        DB::table('subjects')->insert([
            'title' => 'AARNet Sydney',
            'group' => 'AARNet',
            'settings' => json_encode([
                'workers' => ['California'],
                'tester_parameter' => 6355
            ])
        ]);

        DB::table('subjects')->insert([
            'title' => 'Vodafone Perth',
            'group' => 'Vodafone',
            'settings' => json_encode([
                'workers' => ['Singapore'],
                'tester_parameter' => 3254
            ])
        ]);

        DB::table('subjects')->insert([
            'title' => 'Vodafone Sydney',
            'group' => 'Vodafone',
            'settings' => json_encode([
                'workers' => ['California'],
                'tester_parameter' => 3505
            ])
        ]);
    }
}
