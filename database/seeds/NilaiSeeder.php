<?php

use Illuminate\Database\Seeder;

class NilaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
              'nilai' => '1',
              'l' => '1',
              'm' => '1',
              'u' => '1',
              'created_at' => date('Y-m-d H:i:s'),
              'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
              'nilai' => '2',
              'l' => '1/2',
              'm' => '1',
              'u' => '3/2',
              'created_at' => date('Y-m-d H:i:s'),
              'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
              'nilai' => '3',
              'l' => '1',
              'm' => '3/2',
              'u' => '2',
              'created_at' => date('Y-m-d H:i:s'),
              'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
              'nilai' => '4',
              'l' => '3/2',
              'm' => '2',
              'u' => '5/2',
              'created_at' => date('Y-m-d H:i:s'),
              'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
              'nilai' => '5',
              'l' => '2',
              'm' => '5/2',
              'u' => '3',
              'created_at' => date('Y-m-d H:i:s'),
              'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
              'nilai' => '6',
              'l' => '5/2',
              'm' => '3',
              'u' => '7/2',
              'created_at' => date('Y-m-d H:i:s'),
              'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
              'nilai' => '7',
              'l' => '3',
              'm' => '7/2',
              'u' => '4',
              'created_at' => date('Y-m-d H:i:s'),
              'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
              'nilai' => '8',
              'l' => '7/2',
              'm' => '4',
              'u' => '9/2',
              'created_at' => date('Y-m-d H:i:s'),
              'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
              'nilai' => '9',
              'l' => '4',
              'm' => '9/2',
              'u' => '9/2',
              'created_at' => date('Y-m-d H:i:s'),
              'updated_at' => date('Y-m-d H:i:s'),
            ]
          ];
          DB::table('nilai')->insert($data);
    }
}
