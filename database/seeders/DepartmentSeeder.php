<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // システム部を追加
        DB::table('departments')->insert([
            'name'=> 'システム部',
        ]);

        // 営業部を追加
        DB::table('departments')->insert([
            'name'=> '営業部',
        ]);

        // 経理部を追加
        DB::table('departments')->insert([
            'name'=> '経理部',
        ]);

        // 各部署にUserSeederで追加した人員を紐づけ
        
        for ($i=0;$i<15;$i++) {
            if ($i < 5) {
                $deps = 1;
            }
            else if ($i < 10) {
                $deps = 2;
            }
            else {
                $deps = 3;
            }
            DB::table('department_user')->insert([
                'user_id'=> $i + 1,
                'department_id'=> $deps,
            ]);
        }
    }
            
}
