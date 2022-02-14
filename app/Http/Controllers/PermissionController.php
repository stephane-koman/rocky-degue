<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    
    function findAll(){
        return Permission::all();
    }

    function search(Request $req){
        $permissions = Permission::query();

        if ($req->input('name')) {
            $permissions->where('name', 'like', '%' + $req->input('name') + '%');
        }

        if ($req->input('description')) {
            $permissions->where('description', 'like', '%' + $req->input('description') + '%');
        }

        if ($req->input('sort')) {
            $permissions->orderBy($req->input('sort'));
        }

        return $permissions->paginate(
            $perPage = $req->input('size', 10),
            $columns = ['*'],
            $pageName = 'page'
        );
    }
}
