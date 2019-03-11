<?php

use Illuminate\Database\Seeder;

class AclSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new App\User();
        $admin->name = 'admin';
        $admin->email = 'nnbelyaev@gmail.com';
        $admin->password = \Illuminate\Support\Facades\Hash::make('admin');
        $admin->save();

        $editor = new App\User();
        $editor->name = 'editor';
        $editor->email = 'nnbelyaev-editor@gmail.com';
        $editor->password = \Illuminate\Support\Facades\Hash::make('editor');
        $editor->save();

        $roleAdmin = new App\Role();
        $roleAdmin->name = 'Administator';
        $roleAdmin->save();

        $roleEditor = new App\Role();
        $roleEditor->name = 'Editor';
        $roleEditor->save();

        $admin->roles()->save($roleAdmin);
        $editor->roles()->save($roleEditor);
    }
}
