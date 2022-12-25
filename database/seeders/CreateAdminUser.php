<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateAdminUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => 'Максим',
            'last_name' => 'Янов',
            'phone' => '89990009900',
            'email' => 'm.yanov1998@gmail.com',
            'company_id' => null,
            'address' => '',
            'description' => '',
            'password' => bcrypt('admin')
        ]);
    }
}
