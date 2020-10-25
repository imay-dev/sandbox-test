<?php

namespace App\Services;

use App\Entities\Transaction;

/**
 * Interface ServiceInterface
 * @package App\Services
 */
interface ServiceInterface
{
    /**
     * @param null $args
     * @return string
     */
    public function init($args = null): string;

    /**
     * @param Transaction $transaction
     * @param bool $success
     *
     * @return mixed
     */
    public function confirm(Transaction $transaction, bool $success);
}
