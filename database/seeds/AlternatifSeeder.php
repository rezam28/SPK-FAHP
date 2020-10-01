<?php

use Illuminate\Database\Seeder;

class AlternatifSeeder extends Seeder
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
          'nama_alternatif' => 'padi sawah',
          'kode' => 'A01',
          'deskripsi' => 'Some seeding operations may cause you to alter or lose data. In order to protect you from running seeding commands against your production database, you will be prompted for confirmation before the seeders are executed. To force the seeders to run without a prompt, use the --force flag:',
          'created_at' => date('Y-m-d H:i:s'),
          'updated_at' => date('Y-m-d H:i:s'),
        ],
        [
          'nama_alternatif' => 'Jagung',
          'kode' => 'A02',
          'deskripsi' => 'UCL (University College London) has huge amounts of students, either undergraduate or postgraduate. Most students are studying full time while small amounts of them are studying part time. Female students are much more than the male ones. Students of UCL came from European Union, America, Middle East, Africa, and Australasia. They all need fun student life between their education lives.',
          'created_at' => date('Y-m-d H:i:s'),
          'updated_at' => date('Y-m-d H:i:s'),
        ],
        [
          'nama_alternatif' => 'Kacang Hijau',
          'kode' => 'A03',
          'deskripsi' => 'UCL (University College London) has huge amounts of students, either undergraduate or postgraduate. Most students are studying full time while small amounts of them are studying part time. Female students are much more than the male ones. Students of UCL came from European Union, America, Middle East, Africa, and Australasia. They all need fun student life between their education lives.',
          'created_at' => date('Y-m-d H:i:s'),
          'updated_at' => date('Y-m-d H:i:s'),
        ]
      ];
      DB::table('alternatif')->insert($data);
    }
}
