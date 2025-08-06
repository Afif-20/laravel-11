<?php

namespace App\Services;

use App\Http\Requests\UserRequest;
use App\Traits\UploadTrait;

class UserService
{
    use UploadTrait;

    public function mapStore(UserRequest $request): array
    {
        $data = $request->validated();

        if ($request->password) {
            $data["password"] = bcrypt($request->password);
        }

        if ($request->password) {
            $data["photo"] = $this->upload("users", $request->file('photo'));
        }

        return $data;
    }
}
