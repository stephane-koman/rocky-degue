<?php

namespace App\Http\Controllers;

use App\Models\PaymentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PaymentTypeController extends Controller
{
    function findAll()
    {
        return PaymentType::all();
    }

    function create(Request $req)
    {

        $rules = array(
            'name'             => ["required", "unique:payment_types"],
            'code'             => ["required", "unique:payment_types"],
        );

        $validator = Validator::make($req->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {

            $paymentType = new PaymentType();

            $paymentType->name = $req->name;
            $paymentType->code = $req->code;

            $paymentType->save();
        }
    }

    function update(Request $req)
    {

        $rules = array(
            'name'             => ["required", Rule::unique('payment_types')->ignore($req->id)],
            'code'             => ["required", Rule::unique('payment_types')->ignore($req->id)],
        );

        $validator = Validator::make($req->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $paymentType = PaymentType::where('id', $req->id)->first();

            $paymentType->name = $req->name;
            $paymentType->code = $req->code;

            $paymentType->save();

            return $paymentType;
        }
    }

    function delete(Request $req)
    {
        $paymentType = PaymentType::where('id', $req->id)->first();
        return $paymentType->delete();
    }

    function search(Request $req)
    {
        $paymentTypes = PaymentType::query();

        if ($req->input('text_search')) {
            $paymentTypes->where('name', 'like', '%' . $req->input(
                'text_search'
            ) . '%')->orWhere('code', 'like', '%' . $req->input(
                'text_search'
            ) . '%');
        }

        if ($req->input('name')) {
            $paymentTypes->where('name', 'like', '%' . $req->input('name') . '%');
        }

        if ($req->input('code')) {
            $paymentTypes->where('code', 'like', '%' . $req->input('code') . '%');
        }

        if ($req->input('sort')) {
            $sorts = explode(".", $req->input('sort'));
            $sens = $sorts[1] == "ascend" ? "asc" : "desc";
            $paymentTypes->orderBy($sorts[0], $sens);
        }

        return $paymentTypes->paginate(
            $perPage = $req->input('size', 10),
            $columns = ['*'],
            $pageName = 'page'
        );
    }

    function findById(Request $req)
    {
        $paymentType = PaymentType::query();
        return $paymentType->where('id', $req->input('id'))->first();
    }
}
