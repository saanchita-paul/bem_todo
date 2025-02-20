<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use App\Services\Todo\GetAllTodosService;
use App\Services\Todo\CreateTodoService;
use App\Services\Todo\GetTodoByIdService;
use App\Services\Todo\UpdateTodoService;
use App\Services\Todo\DeleteTodoService;

class TodoController extends Controller
{
    protected GetAllTodosService $getAllTodosService;
    protected CreateTodoService $createTodoService;
    protected GetTodoByIdService $getTodoByIdService;
    protected UpdateTodoService $updateTodoService;
    protected DeleteTodoService $deleteTodoService;

    public function __construct(
        GetAllTodosService $getAllTodosService,
        CreateTodoService $createTodoService,
        GetTodoByIdService $getTodoByIdService,
        UpdateTodoService $updateTodoService,
        DeleteTodoService $deleteTodoService
    ) {
        $this->middleware('auth');
        $this->getAllTodosService = $getAllTodosService;
        $this->createTodoService = $createTodoService;
        $this->getTodoByIdService = $getTodoByIdService;
        $this->updateTodoService = $updateTodoService;
        $this->deleteTodoService = $deleteTodoService;
    }

    public function index()
    {
        $todos = $this->getAllTodosService->execute();
        return view('todos.index', compact('todos'));
    }

    public function create()
    {
        return view('todos.create');
    }

    public function store(TodoRequest $request)
    {
        $this->createTodoService->execute($request->validated());
        return redirect()->route('todos.index');
    }

    public function show(Todo $todo)
    {
        $this->authorize('view', $todo);
        $todo = $this->getTodoByIdService->execute($todo);
        return view('todos.show', compact('todo'));
    }

    public function edit(Todo $todo)
    {
        $this->authorize('update', $todo);
        return view('todos.edit', compact('todo'));
    }

    public function update(TodoRequest $request, Todo $todo)
    {
        $this->authorize('update', $todo);
        $this->updateTodoService->execute($todo, $request->validated());
        return redirect()->route('todos.index');
    }

    public function destroy(Todo $todo)
    {
        $this->authorize('delete', $todo);
        $this->deleteTodoService->execute($todo);
        return redirect()->route('todos.index');
    }
}
