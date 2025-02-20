<?php

namespace App\Services\Todo;

use App\Models\Todo;

class UpdateTodoService
{
    public function execute(Todo $todo, array $data)
    {
        $todo->update($data);
        return $todo;
    }
}
