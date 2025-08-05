<?php

namespace App\Interfaces\Eloquent;

interface SumInterface
{
    /**
     * Handle sum data event to models.
     * 
     * @return int
     */
    public function sum(): int;
}
