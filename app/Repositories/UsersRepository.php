<?php

namespace App\Repositories;

use App\Eloquent\User;

class UsersRepository extends AbstractRepository
{
    protected $model;

    /** @var User */
    private $user;

    public function __construct(User $user)
    {
        $this->model = $this->user = $user;
    }
}