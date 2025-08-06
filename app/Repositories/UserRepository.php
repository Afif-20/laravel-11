<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Interfaces\UserInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRepository extends BaseRepository implements UserInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * Find user by email.
     * 
     * @param string $email
     * @return mixed
     */

    public function findByEmail(string $email)
    {
        return $this->model->query->where('email', $email)->first();
    }

    /**
     * Handle paginate data event from models.
     * 
     * @param Request $request
     * @param int $pagination
     * 
     * @return LengthAwarePaginator
     */

    public function customPaginate(Request $request, int $pagination = 10)
    {
        return $this->model->paginate($pagination);
    }
}
