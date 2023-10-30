<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomerCategory;
use App\Http\Requests\StoreCustomerCategoryRequest;
use App\Http\Requests\UpdateCustomerCategoryRequest;

class CustomerCategoryController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCustomerCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerCategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomerCategory  $customerCategory
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerCategory $customerCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustomerCategory  $customerCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomerCategory $customerCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCustomerCategoryRequest  $request
     * @param  \App\Models\CustomerCategory  $customerCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerCategoryRequest $request, CustomerCategory $customerCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomerCategory  $customerCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerCategory $customerCategory)
    {
        //
    }
}
