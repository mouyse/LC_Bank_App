<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class TransactionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      DB::table('transaction_types')->delete();
      $transaction_types = array(
        array('transaction_type' => "Credit"),
        array('transaction_type' => "Debit"),
      );
      DB::table('transaction_types')->insert($transaction_types);
    }
}
