<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    function findAll()
    {
        return Role::all();
    }

    function create(Request $req)
    {

        $rules = array(
            'name'             => ["required", "unique:roles"],
        );

        $validator = Validator::make($req->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {

            $role = new Role();

            $role->name = $req->name;
            $role->description = $req->description;

            $role->save();

            if ($req->permissions && !empty($req->permissions)) {
                $role->permissions()->sync($req->permissions);
            }
        }
    }

    function update(Request $req)
    {

        $rules = array(
            'name'             => ["required", Rule::unique('roles')->ignore($req->id)],
        );

        $validator = Validator::make($req->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $role = Role::where('id', $req->id)->first();

            $role->name = $req->name;
            $role->description = $req->description;

            $role->save();

            $role->permissions()->sync($req->get('permissions', []));

            return $role;
        }
    }

    function delete(Request $req)
    {
        $role = Role::where('id', $req->id)->first();
        return $role->delete();
    }

    function searchRoles(Request $req)
    {
        $roles = Role::with('permissions');

        if ($req->input('name')) {
            $roles->where('name', 'like', '%' + $req->input('name') + '%');
        }

        if ($req->input('description')) {
            $roles->where('description', 'like', '%' + $req->input('description') + '%');
        }

        if ($req->input('sort')) {
            $roles->orderBy($req->input('sort'));
        }

        return $roles->paginate(
            $perPage = $req->input('size', 10),
            $columns = ['*'],
            $pageName = 'page'
        );
    }

    function findById(Request $req)
    {
        return Role::where('id', $req->input('id'))->first();
    }
}
