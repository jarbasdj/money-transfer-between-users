<?php

namespace App\Jobs;

use App\Models\Transaction;
use App\Repositories\Contracts\TransactionRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProccessTransaction implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(
        private Transaction $transaction,
    ) {
    }

    public function handle(UserRepositoryInterface $userRepository, TransactionRepositoryInterface $transactionRepository)
    {
        try {
            $from = $userRepository->find($this->transaction->from);
            $to = $userRepository->find($this->transaction->to);

            if ($transactionRepository->transferValueBetweenUsers(
                $from,
                $to,
                $this->transaction->value
            )) {
                $transactionRepository->update($this->transaction->id, [
                    'status' => $transactionRepository::STATUS_SUCCESS,
                ]);

                return true;
            }
        } catch (Exception $e) {
            $transactionRepository->update($this->transaction->id, [
                'status' => $transactionRepository::STATUS_ERROR,
                'status_message' => 'Can\'t make transaction. Error: ' . $e->getMessage(),
            ]);
        }

        return false;
    }
}
