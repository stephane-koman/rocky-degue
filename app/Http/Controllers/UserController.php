<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function me()
    {
        $user = User::with('role', 'permissions')->where('id', auth()->user()->id)->first();

        $result = new User();
        $result->name = $user->name;
        $result->email = $user->email;
        $result->role = $user->role;
        if ($user->role) {
            $role = Role::with('permissions')->where('id', $user->role->id)->first();
            $result->role->permissions = $role->permissions->pluck('name');
        }
        if ($user->permissions) {
            $result->permissions = $user->permissions->pluck('name');
        }
        return $result;
    }

    function login(Request $req)
    {
        $user = User::where('email', $req->email)->first();
        if (!$user || !Hash::check($req->password, $user->password)) {
            return ["error" => "Email or password is not matched"];
        }
        return $user;
    }

    function create(Request $req)
    {

        $rules = array(
            'name'             => 'required',
            'email'            => 'required|email|unique:users',
            'password'         => 'required',
            'password_confirm' => 'required|same:password'
        );

        $validator = Validator::make($req->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {

            $user = new User();

            $user->name = $req->name;
            $user->email = $req->email;
            $user->password = Hash::make($req->password);
            
            $user->save();

            if ($req->role && !empty($req->role)) {
                $user->role()->associate($req->role);
            }
            if ($req->permissions && !empty($req->permissions)) {
                $user->permissions()->sync($req->permissions);
            }

            $user->save();
        }
    }

    function update(Request $req)
    {
        $rules = array(
            'name'             => 'required',
            'email'            => ["required", "email", Rule::unique('users')->ignore($req->id)],
        );

        $validator = Validator::make($req->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $user = User::where('id', $req->id)->first();

            $user->name = $req->name;
            $user->email = $req->email;

            if ($req->role && !empty($req->role)) {
                $role = Role::where('id', $req->role)->first();
                $user->role()->associate($role);
            }

            $user->permissions()->sync($req->get('permissions', []));

            $user->save();

            return $user;
        }
    }

    function delete(Request $req)
    {
        $user = User::where('id', $req->id)->first();
        return $user->delete();
    }

    function resetPassword(Request $req)
    {
        $rules = array(
            'password'         => 'required',
            'password_confirm' => 'required|same:password'
        );

        $validator = Validator::make($req->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $user = User::where('id', $req->id)->first();

            $user->password = Hash::make($req->password);

            $user->save();

            return $user;
        }
    }

    function searchUsers(Request $req)
    {
        $users = User::with('role', 'permissions');

        if ($req->input('text_search')) {
            $users->where('name', 'like', '%' . $req->input(
                'text_search'
            ) . '%')->orWhere('email', 'like', '%' . $req->input('text_search') . '%');
        }

        if ($req->input('name')) {
            $users->where('name', 'like', '%' . $req->input('name') . '%');
        }

        if ($req->input('email')) {
            $users->where('email', 'like', '%' . $req->input('email') . '%');
        }

        if ($req->input('role') && !empty($req->input('role'))) {
            $users->whereHas("role", function($query) use ($req){
                $query->whereIn("name", $req->input('role'));
            });
        }

        if ($req->input('sort')) {
            $sorts = explode(".", $req->input('sort'));
            $sens = $sorts[1] == "ascend" ? "asc" : "desc";
            $users->orderBy($sorts[0], $sens);
        }

        return $users->paginate(
            $perPage = $req->input('size', 10),
            $columns = ['*'],
            $pageName = 'page'
        );
    }

    function findById(Request $req)
    {
        return User::where('id', $req->input('id'))->first();
    }
}
