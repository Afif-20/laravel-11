<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    private UserRepository $user;
    private UserService $userService;

    public function __construct(UserRepository $user, UserService $userService)
    {
        $this->user = $user;
        $this->userService = $userService;
    }

    /**
     * Get current User using auth token.
     * 
     * @param Request $request
     * @return JsonResponse
     */

     public function index(Request $request): JsonResponse
    {
        try {
            return ResponseHelper::success(UserResource::collection($this->user->get()), trans('alert.get_current_user'));
        } catch (\Throwable $th) {
            return ResponseHelper::error(message: $th->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request): JsonResponse
    {
        DB::beginTransaction();
        try{
            $store = $this->userService->mapStore($request);
            $user = $this->user->store($store);
            
            DB::commit();
            return ResponseHelper::success(message: trans('alert.add_success'));
        } catch(\Throwable $th) {
            DB::rollBack();
            $errorMessage = trans('alert.add_failed') . "=>" . $th->getMessage();
            return ResponseHelper::error(message: $errorMessage);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        try {
            return ResponseHelper::success($this->user->show($id), trans('alert.get_current_user'));
        } catch (\Throwable $th) {
            return ResponseHelper::error(message: $th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user): JsonResponse
    {
        DB::beginTransaction();
        try {
            $payload = $this->userService->mapUpdate($request, $user);
            $user->update($payload);

            DB::commit();
            return ResponseHelper::success(message: trans('alert.update_success'));
        } catch (\Throwable $th) {
            DB::rollBack();
            $errorMessage = trans('alert.update_failed') . "=>" . $th->getMessage();
            return ResponseHelper::error(message: $errorMessage);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        DB::beginTransaction();
        try {
            $this->userService->removeImage($user);
            $user->delete();

            DB::commit();
            return ResponseHelper::success(message: trans('alert.user_soft_delete_succes'));
        } catch (\Throwable $th) {
            DB::rollBack();
            $errorMessage = trans('alert.user_soft_delete_failed') . "=>" . $th->getMessage();
            return ResponseHelper::error(message: $errorMessage);
        }
    }

    public function login(LoginRequest $request)
    {
        try {
            $signInResult = $this->userService->handleSignIn($request);

            return ResponseHelper::success(
                $signInResult,
                message: trans('alert.login_success')
            );
        } catch (\Throwable $th) {
            $errorMessage = trans('alert.login_failed') . "=>" . $th->getMessage();
            return ResponseHelper::error(message: $errorMessage);
             }
    }

    public function logout(Request $request)
    {
        try {
            $user = $request->user();

            if($user && $user->currentAccessToken()) {
                $user->currentAccessToken()->delete();
                return ResponseHelper::success(message: trans('auth.logout_success'));
            }

            return ResponseHelper::error(message: 'auth.invalid_token');
        } catch (\Throwable $th) {
            return ResponseHelper::error(message: $th->getMessage());
        }
    }
}
