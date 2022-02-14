<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CityController extends Controller
{
    function findAll()
    {
        return City::all();
    }

    function create(Request $req)
    {

        $rules = array(
            'name'             => ["required", "unique:cities"],
            'code'             => ["required", "unique:cities"],
            'country'             => ["required"],
        );

        $validator = Validator::make($req->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {

            $city = new City();

            $city->name = $req->name;
            $city->code = $req->code;

            $city->save();

            if ($req->country && !empty($req->country)) {
                $city->country()->associate($req->country);
            }

            $city->save();

        }
    }

    function update(Request $req)
    {

        $rules = array(
            'name'             => ["required", Rule::unique('cities')->ignore($req->id)],
            'code'             => ["required", Rule::unique('cities')->ignore($req->id)],
            'country'             => ["required"],
        );

        $validator = Validator::make($req->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $city = City::where('id', $req->id)->first();

            $city->name = $req->name;
            $city->code = $req->code;

            $city->save();

            if ($req->country && !empty($req->country)) {
                $city->country()->associate($req->country);
            }

            return $city;
        }
    }

    function delete(Request $req)
    {
        $city = City::where('id', $req->id)->first();
        return $city->delete();
    }

    function search(Request $req)
    {
        $cities = City::with("country");

        if ($req->input('text_search')) {
            $cities->where('name', 'like', '%' . $req->input(
                'text_search'
            ) . '%')->orWhere('code', 'like', '%' . $req->input(
                'text_search'
            ) . '%');
        }

        if ($req->input('name')) {
            $cities->where('name', 'like', '%' . $req->input('name') . '%');
        }

        if ($req->input('code')) {
            $cities->where('code', 'like', '%' . $req->input('code') . '%');
        }

        if ($req->input('country') && !empty($req->input('country'))) {
            $cities->whereHas("country", function ($query) use ($req) {
                $query->whereIn("name", $req->input('country'));
            });
        }

        if ($req->input('sort')) {
            $sorts = explode(".", $req->input('sort'));
            $sens = $sorts[1] == "ascend" ? "asc" : "desc";
            $cities->orderBy($sorts[0], $sens);
        }

        return $cities->paginate(
            $perPage = $req->input('size', 10),
            $columns = ['*'],
            $pageName = 'page'
        );
    }

    function findById(Request $req)
    {
        return City::where('id', $req->input('id'))->first();
    }
}
