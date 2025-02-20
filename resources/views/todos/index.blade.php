<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Style for wrapping text in table cells */
        .table td, .table th {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 200px; /* Adjust as necessary */
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .table td, .table th {
                max-width: 100px; /* Reduce width for smaller screens */
                font-size: smaller;
            }
            /* Adjust action buttons */
            .table td:last-child {
                display: flex;
                flex-wrap: wrap;
                gap: 5px;
            }
            .table td:last-child a, .table td:last-child form button {
                margin: 2px;
            }
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1>Todo List</h1>
    <a href="{{ route('todos.create') }}" class="btn btn-primary mb-3">Create New Todo</a>
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
</body>
</html>
