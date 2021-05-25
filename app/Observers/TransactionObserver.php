<?php

namespace App\Observers;

use App\Jobs\ProccessTransaction;
use App\Models\Transaction;

class TransactionObserver
{
    /**
     * Handle the Transaction "created" event.
     */
    public function created(Transaction $transaction)
    {
        ProccessTransaction::dispatch($transaction)->delay(10);
    }

    /**
     * Handle the Transaction "updated" event.
     */
    public function updated(Transaction $transaction)
    {
        // TODO:: Notification
    }

    /**
     * Handle the Transaction "deleted" event.
     */
    public function deleted(Transaction $transaction)
    {
    }

    /**
     * Handle the Transaction "restored" event.
     */
    public function restored(Transaction $transaction)
    {
    }

    /**
     * Handle the Transaction "force deleted" event.
     */
    public function forceDeleted(Transaction $transaction)
    {
    }
}
