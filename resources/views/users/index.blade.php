<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h2>List users</h2>
<table border="1">
    <tr>
        <td>ID</td>
        <td>Name</td>
        <td>Email</td>
        <td>Age</td>
        <td>Address</td>
        <td>Telephone</td>
        <td>Votes</td>
        <td>Yolo</td>
        <td>Action</td>
        <td>Action</td>
    </tr>
    @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->age }}</td>
            <td>{{ $user->address }}</td>
            <td>{{ $user->telephone }}</td>
            <td>{{ $user->votes }}</td>
            <td>{{ $user->yolo_column }}</td>
            <td><a href="/users/update/{{ $user->id }}">Edit</a></td>
            <td><a href="/users/delete/{{ $user->id }}">Delete</a></td>
        </tr>
    @endforeach
</table>
@foreach($customers as $name => $email)
    {{$name}} - {{$email}}
@endforeach

@foreach($orders as $order)
    {{$order->name}} - {{$order->zzzz}}
@endforeach


@foreach($rightUsers as $user)
    <?php
        print_r($user);
        echo "<pre />";
        ?>
@endforeach
<p> Number of customers: {{$count}}</p>
<a href="/users/create">Create user</a>
</body>
</html>
