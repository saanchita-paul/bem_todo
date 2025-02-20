<?php

namespace App\Services\Todo;

use App\Models\Todo;

class GetTodoByIdService
{
    public function execute(Todo $todo)
    {
        return $todo;
    }
}
