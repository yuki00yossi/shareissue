<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('projects')->insert([
            'name'=> '営業ツール開発',
        ]);
        DB::table('projects')->insert([
            'name'=> '人事評価ツール開発',
        ]);

        // プロジェクトとUserSeederで追加されたユーザーを紐づけ
        for ($i=0;$i<15;$i++) {
            // システム部
            if ($i < 5) {
                DB::table('project_user')->insert([
                    'user_id'=> $i + 1,
                    'project_id'=> 1,
                ]);
                DB::table('project_user')->insert([
                    'user_id'=> $i + 1,
                    'project_id'=> 2,
                ]);
            }
            else if ($i < 10) {
                // 営業部
                DB::table('project_user')->insert([
                    'user_id'=> $i + 1,
                    'project_id'=> 1,
                ]);
            }
            else {
                DB::table('project_user')->insert([
                    'user_id'=> $i + 1,
                    'project_id'=> 2,
                ]);
            }
        }
    }
}
