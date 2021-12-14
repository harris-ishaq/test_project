<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $permission_list = [
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'student-list',
            'student-create',
            'student-edit',
            'student-delete',
            'student-search',
            'book-list',
            'book-create',
            'book-edit',
            'book-delete',
            'book-search',
            'transaction-list',
            'transaction-create',
            'transaction-edit',
            'transaction-delete'
         ];

        foreach ($permission_list as $permissions) {
            Permission::create(['name' => $permissions]);
        }

         $user = User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => Hash::make('admin123')
        ]);

        $role = Role::create(['name' => 'Admin']);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);

        Role::create(['name' => 'Pengguna']);
        Role::create(['name' => 'Staff Sekolah']);
    }
}
