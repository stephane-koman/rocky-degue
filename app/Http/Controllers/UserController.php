<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    function register(Request $req)
    {
        $user = new User();
        $user->name = $req->input('name');
        $user->email = $req->input('email');
        $user->password = Hash::make($req->input('password'));
        $user->save();

        return $user;
    }

    function login(Request $req)
    {
        $user = User::where('email', $req->email)->first();
        if(!$user || !Hash::check($req->password, $user->password)){
            return ["error" => "Email or password is not matched"];
        }
        return $user;
    }

    function searchUsers(Request $req)
    {
        $query = User::query();

        $perPage = $req->input('size', 10);
        $page = $req->input('page', 1);
        $total = $query->count();

        $result = $query->offset(($page - 1) * $perPage)->limit($perPage)->get();

        return [
            'result' => $result,
            'total' => $total,
            'page' => $page,
            'last_page' => ceil($total / $perPage)
        ];
    }

    function getUser(Request $req)
    {
        return User::where('id', $req->id)->first();
    }
}
