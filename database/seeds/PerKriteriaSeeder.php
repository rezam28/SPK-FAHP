<?php

use Illuminate\Database\Seeder;

class PerKriteriaSeeder extends Seeder
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
              'kriteria1_id' => '1',
              'kriteria2_id' => '1',
              'daerah_id' => '1',
              'nilai' => '1',
              'created_at' => date('Y-m-d H:i:s'),
              'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
              'kriteria1_id' => '1',
              'kriteria2_id' => '2',
              'daerah_id' => '1',
              'nilai' => '2',
              'created_at' => date('Y-m-d H:i:s'),
              'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
              'kriteria1_id' => '1',
              'kriteria2_id' => '3',
              'daerah_id' => '1',
              'nilai' => '3',
              'created_at' => date('Y-m-d H:i:s'),
              'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
              'kriteria1_id' => '1',
              'kriteria2_id' => '4',
              'daerah_id' => '1',
              'nilai' => '2',
              'created_at' => date('Y-m-d H:i:s'),
              'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
              'kriteria1_id' => '2',
              'kriteria2_id' => '2',
              'daerah_id' => '1',
              'nilai' => '1',
              'created_at' => date('Y-m-d H:i:s'),
              'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
              'kriteria1_id' => '2',
              'kriteria2_id' => '3',
              'daerah_id' => '1',
              'nilai' => '2',
              'created_at' => date('Y-m-d H:i:s'),
              'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
              'kriteria1_id' => '2',
              'kriteria2_id' => '4',
              'daerah_id' => '1',
              'nilai' => '2',
              'created_at' => date('Y-m-d H:i:s'),
              'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
              'kriteria1_id' => '3',
              'kriteria2_id' => '3',
              'daerah_id' => '1',
              'nilai' => '1',
              'created_at' => date('Y-m-d H:i:s'),
              'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
              'kriteria1_id' => '3',
              'kriteria2_id' => '4',
              'daerah_id' => '1',
              'nilai' => '2',
              'created_at' => date('Y-m-d H:i:s'),
              'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
              'kriteria1_id' => '4',
              'kriteria2_id' => '4',
              'daerah_id' => '1',
              'nilai' => '1',
              'created_at' => date('Y-m-d H:i:s'),
              'updated_at' => date('Y-m-d H:i:s'),
            ]
          ];
          DB::table('perbandingan_kriteria')->insert($data);
    }
}
