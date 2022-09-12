<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit task</title>
</head>
<body>
<h2>Edit task</h2>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div><br />
@endif
<form action="{{ route('tasks.update', $task->id) }}" method="post">
    @csrf
    @method('PATCH')
    <label for="title">
        Title:
        <input type="text" name="title" value="{{ $task->title }}" />
    </label><br><br>
    <label for="Description">
        Description:
        <textarea name="description" rows="4" cols="50">{{ $task->description }}</textarea>
    </label><br><br>

    @if ($users->count())
        <label for="assignees">
            Choose assignees:
            <select name="assignees[]" multiple>
                @foreach ($users as $id => $name)
                    <option value="{{ $id }}" {{ in_array($id, $assignees) ? "selected" : "" }}>{{ $name }}</option>
                @endforeach
            </select>
        </label>
    @endif
    <br><br>
    @if ($tasks->count())
        <label for="task">
            Choose parent task:
            <select name="parent_id">
                <option value=""> Select task</option>
                @foreach ($tasks as $id => $title)
                    <option value="{{ $id }}" {{ $id == $task->parent_id ? "selected" : "" }}>{{ $title }}</option>
                @endforeach
            </select>
        </label>
    @endif
    <br><br>
    {{ $task->getTaskById($id) }}
    <button type="submit">Update task</button>
</form>
</body>
</html>
