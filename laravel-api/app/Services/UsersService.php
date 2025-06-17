<?php

namespace App\Services;


use App\Models\User;

class UsersService
{
    /**
     * @param array $data
     * @return User
     */
    public function save(array $data): User
    {
        if ($data['is_create']) {
            $user = new User();
        } else {
            $user = User::find($data['id']);
        }
        $user->name = $data['name'];
        $user->surname = $data['surname'];
        $user->email = $data['email'];
        if (isset($data['new_password'])) {
            $user->password = bcrypt($data['new_password']);
        }
        $user->status = $data['status'];
        $user->save();

        return $user;
    }
}
