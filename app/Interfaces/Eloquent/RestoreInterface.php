<?php

namespace App\Interfaces\Eloquent;

interface RestoreInterface
{
    /**
     * Handle restore data instantly from models.
     */
    public function restore(mixed $id): mixed;
}
