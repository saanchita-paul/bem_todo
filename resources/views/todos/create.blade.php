@extends('layouts.app')

@section('content')
<div class="card container m-auto">
    <h1>Create New Todo</h1>
    <form action="{{ route('todos.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="reminder_at" class="form-label">Reminder At</label>
            <input type="datetime-local" class="form-control" id="reminder_at" name="reminder_at" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('home') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection

