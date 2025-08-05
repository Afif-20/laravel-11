<?php

namespace App\Interfaces\Eloquent;


interface GetAllInterface
{
    /**
     * Handel the Get all data event from models.
     * 
     * @return  mixed
     */
    public function getAll(): mixed;
}
