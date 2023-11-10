<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            // Role
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',            
            
            // User
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',

            // Mata Kuliah
            'mataKuliah-list',
            'mataKuliah-create',
            'mataKuliah-edit',
            'mataKuliah-delete', 

            // Mahasiswa
            'mahasiswa-list',
            'mahasiswa-create',
            'mahasiswa-edit',
            'mahasiswa-delete',

            // Sekolah
            'sekolah-list',
            'sekolah-create',
            'sekolah-edit',
            'sekolah-delete',

            // Jurusan
            'jurusan-list',
            'jurusan-create',
            'jurusan-edit',
            'jurusan-delete',

            // Guru Pamong
            'guruPamong-list',
            'guruPamong-create',
            'guruPamong-edit',
            'guruPamong-delete',
        ];
 
 
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
