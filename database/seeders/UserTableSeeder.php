<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        User::query()->truncate();

        if (config('client.debug')){
            $admin = User::query()->create([
                'id' => (string)Str::uuid(),
                'full_name' => 'مدیر سیستم',
                'mobile' => '09191234567',
                'gender' => 'male',
                'email' => 'admin@gmail.com',
                'type' => 'admin',
                'password' => bcrypt('admin'),
            ]);
//            $admin->assignRole('admin');
//            $permissions = Permission::all();
//            foreach ($permissions as $permission) {
//                $admin->givePermissionTo($permission['name']);
//            }


            // clients
            User::query()->create([
                'id' => (string)Str::uuid(),
                'full_name' => 'جواد حسینی',
                'gender' => 'male',
                'mobile' => '09191234573',
                'email' => 'javad.hosseini@gmail.com',
                'type' => 'client',
                'password' => bcrypt('javad.hosseini'),
            ]);
            User::query()->create([
                'id' => (string)Str::uuid(),
                'full_name' => 'زهرا صداقت',
                'gender' => 'female',
                'mobile' => '09191234574',
                'email' => 'zahra.sedaghat@gmail.com',
                'type' => 'client',
                'password' => bcrypt('zahra.sedaghat'),
            ]);
            User::query()->create([
                'id' => (string)Str::uuid(),
                'full_name' => 'عباس حسینی',
                'gender' => 'male',
                'mobile' => '09191234575',
                'email' => 'abbas.hosseini@gmail.com',
                'type' => 'client',
                'password' => bcrypt('abbas.hosseini'),
            ]);
            User::query()->create([
                'id' => (string)Str::uuid(),
                'full_name' => 'ترگل بختیاری',
                'gender' => 'female',
                'mobile' => '09191234576',
                'email' => 'targol.bakhtiari@gmail.com',
                'type' => 'client',
                'password' => bcrypt('targol.bakhtiari'),
            ]);
            User::query()->create([
                'id' => (string)Str::uuid(),
                'full_name' => 'حسین مردانی',
                'gender' => 'male',
                'mobile' => '09191234577',
                'email' => 'hossein.mardani@gmail.com',
                'type' => 'client',
                'password' => bcrypt('hossein.mardani'),
            ]);
            User::query()->create([
                'id' => (string)Str::uuid(),
                'full_name' => 'کوروش طهرانی',
                'gender' => 'male',
                'mobile' => '09191234578',
                'email' => 'korosh.tehrani@gmail.com',
                'type' => 'client',
                'password' => bcrypt('korosh.tehrani'),
            ]);
        }else{
            $admin = User::query()->create([
                'id' => (string)Str::uuid(),
                'full_name' => 'مدیر سیستم',
                'mobile' => '09191234567',
                'gender' => 'male',
                'email' => 'admin@gmail.com',
                'type' => 'admin',
                'password' => bcrypt('admin'),
            ]);
//            $admin->assignRole('admin');
//            $permissions = Permission::all();
//            foreach ($permissions as $permission) {
//                $admin->givePermissionTo($permission['name']);
//            }
        }


    }

}
