<?php

namespace Database\Seeders;

use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $wallets = Wallet::pluck('id');

        foreach($wallets as $wallet_id) {
            Transaction::factory()->count(2)->create(['wallet_id' => $wallet_id, 'type' => 'in', 'amount' => rand(10000, 20000)]);
            Transaction::factory()->count(2)->create(['wallet_id' => $wallet_id, 'type' => 'out', 'amount' => rand(1000, 2000)]);
        }
    }
}
