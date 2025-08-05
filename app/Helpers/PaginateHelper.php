<?php

namespace App\Helpers;

use Illuminate\Pagination\LengthAwarePaginator;

class PaginateHelper
{
    /**
     * Get to paginate array.
     * 
     * @param LengthAwarePaginator $paginator
     * @return array
     */
    public static function getPaginate(LengthAwarePaginator $paginator)
    {
        return [
            'path' => self::path($paginator),
            'per_page' => self::perPage($paginator),
            'current_page' => self::currentPage($paginator),
            'total' => self::total($paginator),
            'last_page' => self::lastPage($paginator),
            'next_page_url' => self::nextPageUrl($paginator),
            'prev_page_url' => self::prevPageUrl($paginator),
            'from' => self::from($paginator),
            'to' => self::to($paginator),
        ];
    }
    
    /**
     * Get the current page path.
     * 
     * @param LengthAwarePaginator $paginator
     * @return string
     */

    public static function path(LengthAwarePaginator $paginator)
    {
        return $paginator->path();
    }

    /**
     * Get the current per page.
     * 
     * @param LengthAwarePaginator $paginator
     * @return int
     */
    public static function perPage(LengthAwarePaginator $paginator)
    {
        return $paginator->perPage();
    }

    /**
     * Get the current page.
     * 
     * @param LengthAwarePaginator $paginator
     * @return int
     */

    public static function currentPage(LengthAwarePaginator $paginator)
    {
        return $paginator->currentPage();
    }

    /**
     * Get the total number of items.
     * 
     * @param LengthAwarePaginator $paginator
     * @return int
     */

    public static function total(LengthAwarePaginator $paginator)
    {
        return $paginator->total();
    }

    /**
     * Get the last page number.
     * 
     * @param LengthAwarePaginator $paginator
     * @return int
     */

    public static function LastPage(LengthAwarePaginator $paginator)
    {
        return $paginator->lastPage();
    }

    /**
     * Get the next page URL.
     * 
     * @param LengthAwarePaginator $paginator
     * @return string|null
     */

    public static function nextPageUrl(LengthAwarePaginator $paginator)
    {
        return $paginator->nextPageUrl();
    }

    /**
     * Get the previous page URL.
     * 
     * @param LengthAwarePaginator $paginator
     * @return string|null
     */

    public static function prevPageUrl(LengthAwarePaginator $paginator)
    {
        return $paginator->previousPageUrl();
    }

    /**
     * Get the starting item number of the current page.
     * 
     * @param LengthAwarePaginator $paginator
     * @return int
     */

    public static function from(LengthAwarePaginator $paginator)
    {
        return $paginator->firstItem();
    }

    /**
     * Get the ending item number of the current page.
     * 
     * @param LengthAwarePaginator $paginator
     * @return int
     */

    public static function to(LengthAwarePaginator $paginator)
    {
        return $paginator->lastItem();
    }
    
}
