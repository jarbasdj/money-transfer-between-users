<?php

namespace App\Services;

use App\Services\Contracts\ServiceInterface;
use Illuminate\Support\Facades\Http;

class TransactionService implements ServiceInterface
{
    public function validateTransaction(): bool
    {
        $result = Http::get('https://run.mocky.io/v3/8fafdd68-a090-496f-8c9a-3442cf30dae6');

        $message = $result->json()['message'] ?? null;

        if ($result->status() !== 200 && $message !== 'Autorizado') {
            return false;
        }

        return true;
    }
}
