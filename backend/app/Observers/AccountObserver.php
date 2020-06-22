<?php

namespace App\Observers;

use App\Models\Account;
use App\Models\Transaction;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Log;

class AccountObserver
{
    private $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function updated(Account $account)
    {
        $description = "";
        if ($account->getOriginal('balance') < $account->balance) {
            $difference = $account->balance - $account->getOriginal('balance');
            $description = "{$difference} were deposited";
        } else if ($account->getOriginal('balance') > $account->balance) {
            $difference = $account->getOriginal('balance') - $account->balance;
            $description = "{$difference} were withdrawn";
        }

        $this->transactionService->store([
            'account_id' => $account->id,
            'description' => $description
        ]);
    }
}
