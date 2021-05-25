<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Jobs\ProccessTransaction;
use App\Models\User;
use App\Repositories\Contracts\TransactionRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function __construct(
        protected TransactionRepositoryInterface $transactionRepository,
        protected UserRepositoryInterface $userRepository,
        protected TransactionService $transactionService
    ) {
    }

    public function index()
    {
        // Not implemented because it's not necessary on scenery
    }

    public function store(StoreTransactionRequest $request)
    {
        $from = $this->userRepository->find($request->get('from'));
        $value = $request->get('value');

        $pendingValues = $this->transactionRepository
            ->getPendingTransactionsValuesFromUser($from);

        $userBalance = $from->balance - $pendingValues;

        if ($value > $userBalance) {
            return response()->json([
                'success' => false,
                'message' => 'The value is less than user balance',
            ], 422);
        }

        if ($from->type !== User::TYPE_CUSTOMER) {
            return response()->json([
                'success' => false,
                'message' => 'Wrong user type. Only "'
                    . User::TYPE_CUSTOMER . '" user type can make transactions',
            ], 422);
        }

        if (!$this->transactionService->validateTransaction()) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction not authorized',
            ], 403);
        }

        $data = array_merge($request->all(), [
            'status' => $this->transactionRepository::STATUS_NEW,
        ]);

        if (!$transaction = $this->transactionRepository->create($data)) {
            response('Can\'t create the transaction', 422);
        }

        return response($transaction, 201);
    }

    public function show($id)
    {
        // Not implemented because it's not necessary on scenery
    }

    public function update(Request $request, $id)
    {
        // Not implemented because it's not necessary on scenery
    }

    public function destroy($id)
    {
        // Not implemented because it's not necessary on scenery
    }
}
