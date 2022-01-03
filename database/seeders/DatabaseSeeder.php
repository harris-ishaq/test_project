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
        // $permission_list = [
        //     'user-list',
        //     'user-create',
        //     'user-edit',
        //     'user-delete',
        //     'student-list',
        //     'student-create',
        //     'student-edit',
        //     'student-delete',
        //     'student-search',
        //     'book-list',
        //     'book-create',
        //     'book-edit',
        //     'book-delete',
        //     'book-search',
        //     'transaction-list',
        //     'transaction-create',
        //     'transaction-edit',
        //     'transaction-delete'
        //  ];

        $user = User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => Hash::make('admin123')
        ]);

        $listPermissionAdmin = explode(',', config('permission_list.permission.Admin'));
        foreach ($listPermissionAdmin as $permissions) {
            Permission::create(['name' => $permissions]);
        }
        $roleAdmin = Role::create(['name' => 'Admin']);
        $permissionsAdmin = Permission::whereIn('name', $listPermissionAdmin)->pluck('id','id')->all();
        $roleAdmin->syncPermissions($permissionsAdmin);
        $user->assignRole([$roleAdmin->id]);

        // $rolePengguna = Role::create(['name' => 'Pengguna']);
        // $listPermissionPengguna = explode(',', config('permission_list.permission.Pengguna'));
        // foreach ($listPermissionPengguna as $permissions) {
        //     Permission::create(['name' => $permissions]);
        // }
        // $permissionsPengguna = Permission::whereIn('name', $listPermissionPengguna)->pluck('id','id')->all();
        // $rolePengguna->syncPermissions($permissionsPengguna);

        $roleKepSek = Role::create(['name' => 'Kepala Sekolah']);
        $listPermissionKepSek = explode(',', config('permission_list.permission.Kepala Sekolah'));
        $permissionsKepSek = Permission::whereIn('name', $listPermissionKepSek)->pluck('id','id')->all();
        $roleKepSek->syncPermissions($permissionsKepSek);

    }
}
