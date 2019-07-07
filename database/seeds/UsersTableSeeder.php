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
        //
        $data = [
            [

                'name' => 'unknown author',
                'email' => 'unknown@author.com',
                'password' => bcrypt(str_random(16)),
            ],
            [
                'name' => 'Author',
                'email' => 'author@gmail.com',
                'password' => bcrypt('123123'),
            ],
        ];

        DB::table('users')->insert($data);
    }
}
