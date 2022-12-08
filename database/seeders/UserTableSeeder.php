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

        if (config('app.debug')){
            $admin = User::query()->create([
                'id' => (string)Str::uuid(),
                'full_name' => 'مدیر سیستم',
                'username' => 'admin',
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
                'username' => 'javad.hosseini',
                'gender' => 'male',
                'mobile' => '09191234573',
                'email' => 'javad.hosseini@gmail.com',
                'type' => 'app',
                'password' => bcrypt('javad.hosseini'),
            ]);
            User::query()->create([
                'id' => (string)Str::uuid(),
                'full_name' => 'زهرا صداقت',
                'username' => 'zahra.sedaghat',
                'gender' => 'female',
                'mobile' => '09191234574',
                'email' => 'zahra.sedaghat@gmail.com',
                'type' => 'app',
                'password' => bcrypt('zahra.sedaghat'),
            ]);
            User::query()->create([
                'id' => (string)Str::uuid(),
                'full_name' => 'عباس حسینی',
                'username' => 'abbas.hosseini',
                'gender' => 'male',
                'mobile' => '09191234575',
                'email' => 'abbas.hosseini@gmail.com',
                'type' => 'app',
                'password' => bcrypt('abbas.hosseini'),
            ]);
            User::query()->create([
                'id' => (string)Str::uuid(),
                'full_name' => 'ترگل بختیاری',
                'username' => 'targol.bakhtiari',
                'gender' => 'female',
                'mobile' => '09191234576',
                'email' => 'targol.bakhtiari@gmail.com',
                'type' => 'app',
                'password' => bcrypt('targol.bakhtiari'),
            ]);
            User::query()->create([
                'id' => (string)Str::uuid(),
                'full_name' => 'حسین مردانی',
                'username' => 'hossein.mardani',
                'gender' => 'male',
                'mobile' => '09191234577',
                'email' => 'hossein.mardani@gmail.com',
                'type' => 'app',
                'password' => bcrypt('hossein.mardani'),
            ]);
            User::query()->create([
                'id' => (string)Str::uuid(),
                'full_name' => 'کوروش طهرانی',
                'username' => 'korosh.tehrani',
                'gender' => 'male',
                'mobile' => '09191234578',
                'email' => 'korosh.tehrani@gmail.com',
                'type' => 'app',
                'password' => bcrypt('korosh.tehrani'),
            ]);
        }else{
            $admin = User::query()->create([
                'id' => (string)Str::uuid(),
                'full_name' => 'مدیر سیستم',
                'username' => 'admin',
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
