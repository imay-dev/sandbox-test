<?php

use App\Entities\Service;
use Illuminate\Database\Seeder;

class ServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::insert([
            'title' => 'credit',
            'class' => 'App\\Services\\Credit'
        ]);
        Role::insert(config('role_data.roles'));

        $permissions = [];
        foreach (config('permission_data.permissions') as $permission) {
            array_push($permissions, $permission['name']);
        }
        Role::findByName('super.admin', 'api')->syncPermissions($permissions);
    }
}
