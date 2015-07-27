<?php
    use App\Models\User;
    use Illuminate\Database\Seeder;

    class UserTableSeeder extends Seeder {
        public function run() {
            User::create([
                'username' => 'admin',
                'password_hash' => md5('admin'),
                'email' => 'admin@shopping.dev'
            ]);

            User::create([
                'username' => 'guest',
                'password_hash' => md5('guest'),
                'email' => 'guest@shopping.dev'
            ]);

            User::create([
                'username' => 'deleteme',
                'password_hash' => md5('deleteme'),
                'email' => 'deleteme@shopping.dev'
            ]);
        }
    }
