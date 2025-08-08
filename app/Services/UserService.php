<?php

namespace App\Services;

use App\Helpers\ResponseHelper;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Traits\UploadTrait;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class UserService
{
    use UploadTrait;

    public function mapStore(UserRequest $request): array
    {
        $data = $request->validated();

        if ($request->password) {
            $data["password"] = bcrypt($request->password);
        }

        if ($request->hasFile('photo')) {
            $data["photo"] = $this->upload("users", $request->file('photo'));
        }

        return $data;
    }

    public function mapUpdate(UserRequest $request, User $user)
    {
        $data = $request->validated();

        if ($request->password) {
            $data["password"] = bcrypt($request->password);
        }

        if ($request->hasFile('photo')) {
            if ($user?->photo) $this->remove($user->photo);
            $data["photo"] = $this->upload("users", $request->file('photo'));
        }

        return $data;
    }

    public function handleSignIn(LoginRequest $request): object
    {
        $validated = $request->validated();

        $remember = false;
        if(isset($validated["remember"])) {
            $remember = $validated["remember"];
        }

        //ambil hanya email & password
        $credentials = [
            'email' => $validated['email'],
            'password' => $validated['password'],
        ];

        if (!Auth::attempt($credentials, $remember)) {
            return ResponseHelper::error(null, trans('auth.failed'), Response::HTTP_UNAUTHORIZED);
        }

        $user = Auth::user();

        $role = DB::table('model_has_roles')
        ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
        ->where('model_has_roles.model_id', $user->id)
        ->where('model_has_roles.model_type', get_class($user))
        ->value('roles.name');

        return (object)[
            'user' => $user,
            'token' => $user->createToken('auth_token')->plainTextToken,
            'role' => $role,
        ];
    }





    public function removeImage(User $user)
    {
        if ($user->image && Storage::exists($user->image)) {
            Storage::delete($user->image);
        }
    }

}
