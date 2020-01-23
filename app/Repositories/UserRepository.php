<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return User::create($data);
    }
}
