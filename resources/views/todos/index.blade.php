@extends('layouts.app')

@section('content')
<div class="card container m-auto">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Todo List</h1>
        <a href="{{ route('todos.create') }}" class="btn btn-primary">Create New Todo</a>
    </div>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Reminder At</th>
            <th>Email Sent</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($todos as $todo)
            <tr>
                <td>{{ $todo->title }}</td>
                <td>{{ $todo->description }}</td>
                <td>{{ $todo->reminder_at }}</td>
                <td>{{ $todo->email_notification_sent ? 'Yes' : 'No' }}</td>
                <td>
                    <a href="{{ route('todos.show', $todo->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('todos.edit', $todo->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('todos.destroy', $todo->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
