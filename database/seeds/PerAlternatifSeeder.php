<?php

use Illuminate\Database\Seeder;

class PerAlternatifSeeder extends Seeder
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
                'daerah_id' => '1',
                'nama_kriteria' => '1',
                'alternatif1_id' => '1',
                'alternatif2_id' => '1',
                'nilai' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'daerah_id' => '1',
                'nama_kriteria' => '1',
                'alternatif1_id' => '1',
                'alternatif2_id' => '2',
                'nilai' => '2',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'daerah_id' => '1',
                'nama_kriteria' => '1',
                'alternatif1_id' => '1',
                'alternatif2_id' => '3',
                'nilai' => '2',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'daerah_id' => '1',
                'nama_kriteria' => '1',
                'alternatif1_id' => '2',
                'alternatif2_id' => '2',
                'nilai' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'daerah_id' => '1',
                'nama_kriteria' => '1',
                'alternatif1_id' => '2',
                'alternatif2_id' => '3',
                'nilai' => '2',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'daerah_id' => '1',
                'nama_kriteria' => '1',
                'alternatif1_id' => '3',
                'alternatif2_id' => '3',
                'nilai' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'daerah_id' => '2',
                'nama_kriteria' => '1',
                'alternatif1_id' => '1',
                'alternatif2_id' => '1',
                'nilai' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'daerah_id' => '2',
                'nama_kriteria' => '2',
                'alternatif1_id' => '3',
                'alternatif2_id' => '3',
                'nilai' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ];
        DB::table('perbandingan_alternatif')->insert($data);
    }
}
