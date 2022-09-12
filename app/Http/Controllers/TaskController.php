<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\DB;
class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all();

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $parent_id = '';
        if ($request->parent_id) {
            $parent_id = $request->parent_id;
        }
        $users = User::all()->pluck('name', 'id');
        $tasks = Task::all()->pluck('title', 'id');
        return view('tasks.create', compact('users', 'tasks', 'parent_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        unset($data['assignees']);
        $task = Task::create($data);
        $assignees = $request->assignees;
        $task->user()->sync($assignees);
        return redirect('/tasks')->with('success', 'Task is successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $users = User::all()->pluck('name', 'id');
        $tasks = Task::all()->except($id)->pluck('title', 'id');
        $assignees = $task->user->pluck('id')->toArray();
        return view('tasks.edit', compact('task', 'users', 'assignees', 'tasks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        unset($data['assignees']);
        unset($data['_method']);
        unset($data['_token']);
        Task::whereId($id)->update($data);
        $assignees = $request->assignees;
        $task = Task::find($id);
        $task->user()->sync($assignees);
//        $UserData = [
//            'name' => 'zzzzz9999',
//            'email' => '9999@gmail.com',
//            'password' => 'ccccccccc'
//        ];
//        $task->user()->create($UserData);
        return redirect('/tasks')->with('success', 'Task is successfully saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect('/tasks')->with('success', 'Task is successfully deleted');
    }
}
