<?php

use Illuminate\Database\Seeder;

class OverviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('overviews')->insert([
            'keyword' => '生技,保健,赫群生技',
            'description' => '',
            'logo' => 'test.fdf.fd',
            'logo' => 'testlogo.img',
            'ico' => 'testlogo.ico',
            'contact_phone' => '032432423432',
            'contact_email' => 'dfas@gmailcom',
            'contact_add' => 'taichung, chung chu',
        ]);

    }
}
;