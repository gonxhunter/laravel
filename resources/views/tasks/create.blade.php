<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create new task</title>
</head>
<body>
<h2>Create task</h2>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div><br />
@endif
<form action="{{ route('tasks.store') }}" method="post">
    @csrf
    <label for="title">
        Title:
        <input type="text" name="title" />
    </label><br><br>
    <label for="Description">
        Description:
        <textarea name="description" rows="4" cols="50"></textarea>
    </label><br><br>
    @if ($users->count())
    <label for="assignees">
        Choose assignees:
        <select name="assignees[]" multiple>
            @foreach ($users as $id => $name)
                <option value="{{ $id }}">{{ $name }}</option>
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
                    <option value="{{ $id }}" {{ $id == $parent_id ? "selected" : "" }}>{{ $title }}</option>
                @endforeach
            </select>
        </label>
    @endif
    <br><br>
    <label for="Due date">
        Due date:
        <input name="due_date" type="date" />
    </label><br><br>
    <button type="submit">Create task</button>
</form>
</body>
</html>
