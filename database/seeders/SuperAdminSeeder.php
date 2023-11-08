<?php

namespace Database\Seeders;

use App\Models\User;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Super Admin
        $user = User::create(
        [
            'nama'      =>  'Ketua Program Studi', 
            'email'     =>  'kpspti@mail.com',
            'username'  =>  'kpspti',
            'password'  =>  bcrypt('pti2023'),
        ]);

        $role = Role::create(['name' => 'Super Admin']);
        $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);

        $user->assignRole('Super Admin');

        // Role
        $role = Role::create(['name' => 'Mahasiswa']);
        $role = Role::create(['name' => 'Dosen Pembimbing']);
        $role = Role::create(['name' => 'Guru Pamong']);
        $role = Role::create(['name' => 'Observer']);
        $role = Role::create(['name' => 'Dosen Penguji']);
    }
}
