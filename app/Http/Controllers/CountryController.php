<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CountryController extends Controller
{
    function findAll()
    {
        return Country::all();
    }

    function create(Request $req)
    {

        $rules = array(
            'name'             => ["required", "unique:countries"],
            'code'             => ["required", "unique:countries"],
        );

        $validator = Validator::make($req->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {

            $country = new Country();

            $country->name = $req->name;
            $country->code = $req->code;

            $country->save();
        }
    }

    function update(Request $req)
    {

        $rules = array(
            'name'             => ["required", Rule::unique('countries')->ignore($req->id)],
            'code'             => ["required", Rule::unique('countries')->ignore($req->id)],
        );

        $validator = Validator::make($req->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $country = Country::where('id', $req->id)->first();

            $country->name = $req->name;
            $country->code = $req->code;

            $country->save();

            return $country;
        }
    }

    function delete(Request $req)
    {
        $country = Country::where('id', $req->id)->first();
        return $country->delete();
    }

    function search(Request $req)
    {
        $countries = Country::query();

        if ($req->input('text_search')) {
            $countries->where('name', 'like', '%' . $req->input(
                'text_search'
            ) . '%')->orWhere('code', 'like', '%' . $req->input(
                'text_search'
            ) . '%');
        }

        if ($req->input('name')) {
            $countries->where('name', 'like', '%' . $req->input('name') . '%');
        }

        if ($req->input('code')) {
            $countries->where('code', 'like', '%' . $req->input('code') . '%');
        }

        if ($req->input('sort')) {
            $sorts = explode(".", $req->input('sort'));
            $sens = $sorts[1] == "ascend" ? "asc" : "desc";
            $countries->orderBy($sorts[0], $sens);
        }

        return $countries->paginate(
            $perPage = $req->input('size', 10),
            $columns = ['*'],
            $pageName = 'page'
        );
    }

    function findById(Request $req)
    {
        $country = Country::with('cities');
        return $country->where('id', $req->input('id'))->first();
    }
}
