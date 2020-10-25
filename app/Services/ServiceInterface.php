<?php

namespace App\Services;

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
     * @param null $args
     * @return mixed
     */
    public function confirm($args = null);
}
