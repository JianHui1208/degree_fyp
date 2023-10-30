<?php

namespace App\Http\Controllers\Api\V1\Users;

use App\Http\Controllers\Controller;
use App\Models\SupplierCategory;
use App\Http\Requests\StoreSupplierCategoryRequest;
use App\Http\Requests\UpdateSupplierCategoryRequest;

class SupplierCategoryApiController extends Controller
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
     * @param  \App\Http\Requests\StoreSupplierCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSupplierCategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SupplierCategory  $supplierCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SupplierCategory $supplierCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSupplierCategoryRequest  $request
     * @param  \App\Models\SupplierCategory  $supplierCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSupplierCategoryRequest $request, SupplierCategory $supplierCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SupplierCategory  $supplierCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SupplierCategory $supplierCategory)
    {
        //
    }
}
