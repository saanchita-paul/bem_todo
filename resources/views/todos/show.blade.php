<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Todo Details</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $todo->title }}</h5>
            <p class="card-text">{{ $todo->description }}</p>
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
    <a href="{{ route('todos.index') }}" class="btn btn-secondary mt-3">Back to List</a>
</div>
</body>
</html>
