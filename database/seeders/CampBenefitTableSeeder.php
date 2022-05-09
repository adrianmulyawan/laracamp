<?php

namespace Database\Seeders;

use App\Models\CampBenefit;
use Illuminate\Database\Seeder;

class CampBenefitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $benefits = [
            [
                'camp_id' => 1,
                'name' => 'Memahami Syntax PHP',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time()),
            ],
            [
                'camp_id' => 1,
                'name' => 'Bisa Membuat API Menggunakan Laravel',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time()),
            ],
            [
                'camp_id' => 1,
                'name' => 'Memahami Basic Database',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time()),
            ],
            [
                'camp_id' => 1,
                'name' => 'Bisa Membuat Website E-Commerce',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time()),
            ],
            [
                'camp_id' => 1,
                'name' => 'Bisa Menggunakan Version Control System (GIT)',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time()),
            ],
            [
                'camp_id' => 1,
                'name' => 'Bisa Merancang Sistem Database',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time()),
            ],
            [
                'camp_id' => 1,
                'name' => 'Menguasai Konsep DOM di Javascript',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time()),
            ],
            [
                'camp_id' => 1,
                'name' => 'Mampu Memahami Bahasa HTML, CSS, dan Javascript',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time()),
            ],
            [
                'camp_id' => 2,
                'name' => 'Memahami Bahasa Python',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time()),
            ],
            [
                'camp_id' => 2,
                'name' => 'Mampu Mengolah Data Menggunakan Python',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time()),
            ],
            [
                'camp_id' => 2,
                'name' => 'Memahami Konsep Dasar Database',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time()),
            ],
            [
                'camp_id' => 2,
                'name' => 'Memahami Query',
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time()),
            ],
        ];

        CampBenefit::insert($benefits);
    }
}
