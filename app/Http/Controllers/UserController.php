<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($request->password);

        User::create($data);
        echo "success create user";
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $data = $request->all();

        $data['password'] = Hash::make($request->password);
        unset($data['_token']);
        User::where('id', $id)->update($data);
        echo 'Success update user';
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);

        $user->delete();
        echo "Delete successfully";
    }

    public function index()
    {
        //$users = User::all();
        $users = DB::table('users')
            ->join('contacts', 'users.id', '=', 'contacts.user_id')
            ->select('users.*', 'contacts.address', 'contacts.age', 'contacts.telephone')
//            ->where('users.name', 'LIKE', '%cc%')
//            ->where(function ($query) {
//                $query->where('users.votes', '>', 10)
//                    ->orWhere('contacts.address', 'LIKE', '%HC%');
//            })
                ->orderBy('users.name', 'desc')
                ->orderBy('users.email', 'desc')
            ->get();

        $customer = DB::table('users')->pluck('name', 'email');
        DB::table('users')->orderBy('id')->lazy()->each(function ($user) {
            DB::table('users')
                ->where('id', $user->id)
                ->update(['yolo_column' => 'TTTTT']);
        });
        if (DB::table('users')->where('votes', 201)->doesntExist()) {
            $count = DB::table('users')->avg('votes');
        } else {
            $count = 99999;
        }

        $orders = DB::table('users')
            ->selectRaw('votes * ? as zzzz, name', [1.0825])
            ->get();

        $leftUsers = DB::table('users')
            ->leftJoin('contacts', 'users.id', '=', 'contacts.user_id')
            ->get();

        $rightUsers = DB::table('users')
            ->join('contacts', function ($join) {
                $join->on('users.id', '=', 'contacts.user_id')
                    ->where('contacts.user_id', '>', 2);
            })
            ->get();

//        DB::table('contacts')->upsert([
//            ['user_id' => '1', 'address' => 'HANOI', 'telephone' => 9999999999],
//            ['user_id' => '10', 'address' => 'HANOI', 'telephone' => 88888888888]
//        ], ['user_id', 'address'], ['telephone']);

        return view('users.index', [
            'users' => $users,
            'customers' => $customer,
            'count' => $count,
            'orders' => $orders,
            'leftUsers' => $leftUsers,
            'rightUsers' => $rightUsers
        ]);
    }
}
