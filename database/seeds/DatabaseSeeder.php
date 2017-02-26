<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory(\App\User::class)->create([
            'name'  => 'Daniel López',
            'email'  => 'daniel@gmail.com',
        ]);

        factory(\App\User::class)->create([
            'name'  => 'Juan Moreno',
            'email'  => 'juan@gmail.com',
        ]);
    }
}
