<?php

namespace App\Services\Todo;

use App\Models\Todo;

class DeleteTodoService
{
    public function execute(Todo $todo)
    {
        return $todo->delete();
    }
}
