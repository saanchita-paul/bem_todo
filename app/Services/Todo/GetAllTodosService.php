<?php

namespace App\Services\Todo;

use Illuminate\Support\Facades\Auth;

class GetAllTodosService
{
    public function execute()
    {
        return Auth::user()->todos()->orderByDesc('created_at')->get();
    }
}
