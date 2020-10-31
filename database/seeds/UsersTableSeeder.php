<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([

        [
            'screen_name'    => 'GestUser',
            'name'           => 'ゲスト ユーザー',
            'description'    => 'ゲストユーザーはプロフィールを編集できません',
            'email'          => 'guestuser@example.com',
            'password'       => Hash::make('guestuser+password'),
            'remember_token' => Str::random(10),
            'created_at'     => now(),
            'updated_at'     => now()
        ]
        ]);

    }
}
