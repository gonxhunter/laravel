<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task management</title>
</head>
<body>
<h2>List tasks</h2>
<table border="1">
    <tr>
        <td>ID</td>
        <td>Title</td>
        <td>Description</td>
        <td>Assignees</td>
        <td>Parent task</td>
        <td>Due date</td>
        <td>Created at</td>
        <td>Updated at</td>
        <td>Action</td>
    </tr>
    @foreach($tasks as $task)
        <tr>
            <td>{{ $task->id }}</td>
            <td>{{ $task->title }}</td>
            <td>{{ $task->description }}</td>
            <td>
                @foreach($task->user as $user)
                    {{$user->name}}
                @endforeach
            </td>
            <td>{{ $task->getTaskById($task->parent_id) }}</td>
            <td>{{ $task->due_date ? date('Y-m-d', strtotime($task->due_date)) : "" }}</td>
            <td>{{ $task->created_at }}</td>
            <td>{{ $task->updated_at }}</td>
            <td>
                <a href="{{ route('tasks.edit', $task->id)}}">Edit</a>
                <form action="{{ route('tasks.destroy', $task->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Delete</button>
                </form>
                <a href="{{ route('tasks.create', ['parent_id' => $task->id]) }}">Create sub task</a>
            </td>
        </tr>
    @endforeach
</table>

<a href="/tasks/create">Create task</a>
</body>
</html>
