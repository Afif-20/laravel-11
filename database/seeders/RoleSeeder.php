<?php

namespace Database\Seeders;

use App\Enums\UserRoleEnum;
use App\Helpers\EnumHelper;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Contracts\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = EnumHelper::toArray(UserRoleEnum::class);

        foreach ($roles as $role) {
            Role::firstOrCreate(
                ['name' => $role],
                ['guard_name' => 'web'],

            );

            $user = User::firstOrCreate(
                ['email' => strtolower(str_replace('', '_', $role)) . '@gmail.com'],
                [
                    'name' => ucfirst($role),
                    'password' => bcrypt
                ]
            );
        }
    }
}
