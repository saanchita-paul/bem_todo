<?php

namespace App\Http\Controllers;

use App\Services\Todo\GetAllTodosService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected GetAllTodosService $getAllTodosService;

    public function __construct(GetAllTodosService $getAllTodosService,)
    {
        $this->getAllTodosService = $getAllTodosService;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $todos = $this->getAllTodosService->execute();
        return view('home', compact('todos'));
    }
}
