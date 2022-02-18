<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    function create(Request $req)
    {

        $rules = array(
            'name'             => ["required", "unique:customers"],
            'address'             => ["required"],
            'phone'             => ["required", "string", "min:8", "max:11"],
            'email'             => ["required","email", "unique:customers"],
        );

        $validator = Validator::make($req->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {

            $customer = new Customer();

            $customer->name = $req->name;
            $customer->address = $req->address;
            $customer->phone = $req->phone;
            $customer->email = $req->email;

            $customer->save();

            if ($req->country && !empty($req->country)) {
                $customer->country()->associate($req->country);
            }

            $customer->save();

        }
    }

    function update(Request $req)
    {

        $rules = array(
            'name'             => ["required", Rule::unique('customers')->ignore($req->id)],
            'address'             => ["required"],
            'phone'             => ["required", "string", "min:8", "max:11"],
            'email'             => ["required","email", Rule::unique('customers')->ignore($req->id)],
        );

        $validator = Validator::make($req->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $customer = Customer::where('id', $req->id)->first();

            $customer->name = $req->name;
            $customer->address = $req->address;
            $customer->phone = $req->phone;
            $customer->email = $req->email;

            if ($req->country && !empty($req->country)) {
                $customer->country()->associate($req->country);
            }

            $customer->save();

            return $customer;
        }
    }

    function delete(Request $req)
    {
        $customer = Customer::where('id', $req->id)->first();
        return $customer->delete();
    }

    function search(Request $req)
    {
        $customers = Customer::with('country');

        if ($req->input('text_search')) {
            $customers->where('name', 'like', '%' . $req->input(
                'text_search'
            ) . '%')->orWhere('email', 'like', '%' . $req->input(
                'text_search'
            ) . '%');
        }

        if ($req->input('name')) {
            $customers->where('name', 'like', '%' . $req->input('name') . '%');
        }

        if ($req->input('email')) {
            $customers->where('email', 'like', '%' . $req->input('email') . '%');
        }

        if ($req->input('sort')) {
            $sorts = explode(".", $req->input('sort'));
            $sens = $sorts[1] == "ascend" ? "asc" : "desc";
            $customers->orderBy($sorts[0], $sens);
        }

        return $customers->paginate(
            $perPage = $req->input('size', 10),
            $columns = ['*'],
            $pageName = 'page'
        );
    }

    function findById(Request $req)
    {
        $customer = Customer::query();
        return $customer->where('id', $req->input('id'))->first();
    }
}
