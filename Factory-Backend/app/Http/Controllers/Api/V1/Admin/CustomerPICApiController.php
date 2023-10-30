<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomerPIC;
use App\Http\Requests\StoreCustomerPICRequest;
use App\Http\Requests\UpdateCustomerPICRequest;

class CustomerPICApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCustomerPICRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerPICRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomerPIC  $customerPIC
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerPIC $customerPIC)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCustomerPICRequest  $request
     * @param  \App\Models\CustomerPIC  $customerPIC
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerPICRequest $request, CustomerPIC $customerPIC)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomerPIC  $customerPIC
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerPIC $customerPIC)
    {
        //
    }
}
