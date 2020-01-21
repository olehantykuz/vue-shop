<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /** @var UserRepository */
    protected $repository;

    public function __construct()
    {
        $this->repository = new UserRepository();
    }

    public function create(array $data)
    {
        return $this->repository
            ->create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
        ]);
    }

}
