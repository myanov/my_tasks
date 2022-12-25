<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreatePermissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert(
            [
                [
                    'name' => 'Полный доступ к ролям',
                    'alias' => 'ROLES_ACCESS'
                ],
                [
                    'name' => 'Просмотр ролей',
                    'alias' => 'ROLES_VIEW'
                ],
                [
                    'name' => 'Добавление ролей',
                    'alias' => 'ROLES_CREATE'
                ],
                [
                    'name' => 'Изменение ролей',
                    'alias' => 'ROLES_EDIT'
                ],
                [
                    'name' => 'Удаление ролей',
                    'alias' => 'ROLES_DELETE'
                ]
            ]
        );
    }
}
