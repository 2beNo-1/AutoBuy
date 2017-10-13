<?php

use Illuminate\Database\Seeder;

class AdministratorInitializeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrator = [
            'name' => 'AutoBuy',
            'email' => 'auto_buy@admin.com',
            'password' => bcrypt('admin123'),
        ];

        \App\User::create($administrator);
    }
}
