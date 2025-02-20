<?php

namespace App\Services\Todo;

use Illuminate\Support\Facades\Auth;

class CreateTodoService
{
    public function execute(array $data)
    {
        return Auth::user()->todos()->create($data);
    }
}
