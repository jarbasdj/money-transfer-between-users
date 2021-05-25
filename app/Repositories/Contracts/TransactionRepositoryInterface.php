<?php

namespace App\Repositories\Contracts;

interface TransactionRepositoryInterface extends RepositoryInterface
{
    public const STATUS_NEW = 'new';
    public const STATUS_ERROR = 'error';
    public const STATUS_SUCCESS = 'success';
}
