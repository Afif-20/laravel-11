<?php

namespace App\Interfaces;

use App\Interfaces\Eloquent\DeleteInterface;
use App\Interfaces\Eloquent\GetInterface;
use App\Interfaces\Eloquent\ShowInterface;
use App\Interfaces\Eloquent\StoreInterface;
use App\Interfaces\Eloquent\UpdateInterface;

interface BaseInterface extends GetInterface, StoreInterface, ShowInterface, UpdateInterface, DeleteInterface
{
    /**
     * Get all data.
     * 
     * @return mixed
     */
    public function get():mixed;

    /**
     * Store new data
     * 
     * @param array $data
     * @return mixed
     */

    public function store(array $data): mixed;

    /**
     * Show spesific data by id.
     * 
     * @param int $id
     * @return mixed
     */

    public function show(mixed $id): mixed;

    /**
     * Store new data.
     * 
     * @param array $data
     * @return mixed
     */

    public function update(mixed $id, array $data): mixed;

    /**
     * Delete spesific data by id.
     * 
     * @param mixed $id
     * @return mixed
     */

    public function delete(mixed $id): mixed;
}
