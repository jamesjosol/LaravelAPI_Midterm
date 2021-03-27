<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Customer::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'lname'             => 'required',
            'fname'             => 'required',
            'address'           => 'required',
            'phone'             => 'required',
            'email'             => 'required|email|unique:customers',
        ]);

        if ($validator->fails()) {
            return response()->json(["error" => $validator->errors()->all()], 400);
        }

        return Customer::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return Customer::find($customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {

        $validator = Validator::make($request->all(), [
            'email'             => 'email',
        ]);

        if ($validator->fails()) {
            return response()->json(["error" => $validator->errors()->all()], 400);
        }

        $customer->update($request->all());

        return $customer;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        Customer::destroy($customer->id);
    }

    /**
     * get all transactions from a specific customer
     */
    public function transactionsByCustomer(Customer $customer) {
        return Customer::with('transactions')
            ->where('id', $customer->id)
            ->get();
    }

}
