<?php

namespace App\Repositories;

use App\Models\Transaction;
use App\Models\User;
use App\Repositories\Contracts\TransactionRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;

class TransactionRepository extends AbstractRepository implements TransactionRepositoryInterface
{
    public function __construct(
        Transaction $model,
        protected UserRepositoryInterface $userRepository
    ) {
        $this->model = $model;
    }

    public function transferValueBetweenUsers(User|int $from, User|int $to, float $value): bool
    {
        try {
            if (!$from instanceof User) {
                $from = $this->userRepository->find($from);
            }

            if (!$to instanceof User) {
                $to = $this->userRepository->find($to);
            }

            DB::beginTransaction();

            $from->balance = $from->balance - $value;
            $from->save();

            $to->balance = $to->balance + $value;
            $to->save();

            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();

            return $e;
        }

        return false;
    }

    public function getPendingTransactionsValuesFromUser(User $user): float
    {
        $transactions = $this->model::selectRaw('SUM(value) AS pendingValue')
            ->where('from', $user->id)
            ->where('status', self::STATUS_NEW)
            ->groupBy('from')
            ->first();

        return $transactions->pendingValue ?? 0;
    }
}
