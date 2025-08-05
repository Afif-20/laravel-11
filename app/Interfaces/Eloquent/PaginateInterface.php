<?php

namespace App\Interfaces\Eloquent;

use Illuminate\Pagination\LengthAwarePaginator;

interface PaginateInterface
{
    /**
     * Handle data paginaate from models.
     * 
     * @param int $pagination
     * 
     * @return LengthAwarePaginator
     */
    public function paginate(int $pagination = 10): LengthAwarePaginator;
}
