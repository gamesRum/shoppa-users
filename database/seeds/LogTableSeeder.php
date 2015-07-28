<?php
    use App\Models\Log;
    use Illuminate\Database\Seeder;

    class LogTableSeeder extends Seeder {
        public function run() {
            Log::create([
                'user_id' => '1',
                'type' => 'LogIn',
                'description' => 'User 1 LogIn'
            ]);

            Log::create([
              'user_id' => '2',
              'type' => 'LogOut',
              'description' => 'User 1 LogIn'
            ]);

            Log::create([
              'user_id' => '1',
              'type' => 'Modified Profile',
              'description' => 'User 1 Modified Profile'
            ]);
        }
    }
