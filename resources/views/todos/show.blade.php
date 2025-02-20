@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Todo Details</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><strong>Title:</strong> {{ $todo->title }}</h5>
            <p class="card-text"><strong>Description:</strong> {{ $todo->description }}</p>
            <p class="card-text"><strong>Reminder At:</strong> {{ $todo->reminder_at }}</p>
            <p class="card-text"><strong>Email Notification Sent:</strong> {{ $todo->email_notification_sent ? 'Yes' : 'No' }}</p>
            <a href="{{ route('todos.edit', $todo->id) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('todos.destroy', $todo->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
    <a href="{{ route('home') }}" class="btn btn-secondary mt-3">Back to List</a>
</div>
@endsection
