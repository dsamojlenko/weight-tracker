<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class WeightsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('weights')->insert([
            'weight' => '220',
            'user_id' => '1',
            'created_at' => Carbon::now()->addDays(1)
        ]);
        DB::table('weights')->insert([
            'weight' => '219',
            'user_id' => '1',
            'created_at' => Carbon::now()->addDays(2)
        ]);
        DB::table('weights')->insert([
            'weight' => '218',
            'user_id' => '1',
            'created_at' => Carbon::now()->addDays(3)
        ]);
        DB::table('weights')->insert([
            'weight' => '218.5',
            'user_id' => '1',
            'created_at' => Carbon::now()->addDays(4)
        ]);
        DB::table('weights')->insert([
            'weight' => '218',
            'user_id' => '1',
            'created_at' => Carbon::now()->addDays(5)
        ]);
        DB::table('weights')->insert([
            'weight' => '217.5',
            'user_id' => '1',
            'created_at' => Carbon::now()->addDays(6)
        ]);
        DB::table('weights')->insert([
            'weight' => '217',
            'user_id' => '1',
            'created_at' => Carbon::now()->addDays(7)
        ]);


        DB::table('weights')->insert([
            'weight' => '228',
            'user_id' => '2',
            'created_at' => Carbon::now()->addDays(1)
        ]);
        DB::table('weights')->insert([
            'weight' => '217',
            'user_id' => '2',
            'created_at' => Carbon::now()->addDays(2)
        ]);
        DB::table('weights')->insert([
            'weight' => '217',
            'user_id' => '2',
            'created_at' => Carbon::now()->addDays(3)
        ]);
        DB::table('weights')->insert([
            'weight' => '216.5',
            'user_id' => '2',
            'created_at' => Carbon::now()->addDays(4)
        ]);
        DB::table('weights')->insert([
            'weight' => '216',
            'user_id' => '2',
            'created_at' => Carbon::now()->addDays(5)
        ]);
        DB::table('weights')->insert([
            'weight' => '215.5',
            'user_id' => '2',
            'created_at' => Carbon::now()->addDays(6)
        ]);
        DB::table('weights')->insert([
            'weight' => '215',
            'user_id' => '2',
            'created_at' => Carbon::now()->addDays(7)
        ]);
    }
}
