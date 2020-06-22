<?php

use App\Models\Account;
use Illuminate\Database\Seeder;
use App\Models\Status;
use App\Models\User;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $defaultUser = User::firstOrCreate([
            'name' => 'Usuário padrão',
            'email' => 'user@mail.com',
        ], ['password' => bcrypt('123456')]);

        Account::insert([
            ['balance' => 300, 'user_id' => $defaultUser->id, 'created_at' => date('Y-m-d H:i:s')],
        ]);

        $this->command->info('All accounts were created.');
    }
}
