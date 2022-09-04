<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // システム部のユーザーを追加
        for ($i=1;$i<6;$i++) {
            DB::table('users')->insert([
                'name'=> 'system' . $i,
                'email'=> 'system' . $i . '@test.com',
                'password'=> Hash::make('password'),
                'is_admin'=> true,
            ]);
        }

        // 営業部のユーザー追加
        for ($i=1;$i<6;$i++) {
            DB::table('users')->insert([
                'name'=> 'sales' . $i,
                'email'=> 'sales' . $i . '@test.com',
                'password'=> Hash::make('password'),
            ]);
        }

        // 総務部のユーザー追加
        for ($i=1;$i<6;$i++) {
            DB::table('users')->insert([
                'name'=> 'accounting' . $i,
                'email'=> 'accounting' . $i . '@test.com',
                'password'=> Hash::make('password'),
            ]);
        }
    }
}
