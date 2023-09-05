<?php

namespace App\Console\Commands;

use App\Models\User;
use App\SDKs\CoinPaymentSDK;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Services\CoinPaymentServices;

class TestingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Testing command';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // $sdk = new CoinPaymentSDK();
        // Log::alert($sdk->createTransaction(10, 'abdelkarim.chamlal@gmail.com'));
        // // Log::alert($sdk->getPaymentList());
        // // Log::alert($sdk->getPaymentsStatus([
        // //     "CPHC1KMV3S7Y7OMTZQQVO50AAA",
        // //     "CPHC7AK8PW2VQDMRWINRSSODL1",
        // //     "CPHC7LXUR6MZO0BQPHQWDOHMKQ",
        // //     "CPHC1GOIBZCJ76XQ9T8EEPFHO9",
        // //     "CPHC4MERBFISNSTMTSBX3ZI0CV"
        // // ]));

        // $user = User::forceCreate([
        //     'nickname' => 'Abdelkarim Chamlal',
        //     'email' => 'abdelkarim.chamlal@gmail.com',
        //     'password' => Hash::make('password'),
        // ]);

        // $response = CoinPaymentServices::createTransaction(10, 'BTC', $user);
        // Log::alert($response);
        // $info = CoinPaymentServices::handleIPN([
        //     'txn_id' => "CPHC7LXUR6MZO0BQPHQWDOHMKQ",
        // ]);
        // Log::alert($info);
        return 0;
    }
}
