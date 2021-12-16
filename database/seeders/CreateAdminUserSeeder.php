<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Hash;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => bcrypt('admin123')
        ]);

        $role = Role::create(['name' => 'Admin']);
        $listPermissionAdmin = explode(',', config('permission_list.permission.Admin'));
        $permissions = Permission::whereIn('name', )->pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);

        Role::create(['name' => 'Pengguna']);
        Role::create(['name' => 'Kepala Sekolah']);

    }
}
