<?php

namespace App\Http\Controllers\Api\V1\Users;

use App\Http\Controllers\Controller;
use App\Models\SupplierPIC;
use App\Http\Requests\StoreSupplierPICRequest;
use App\Http\Requests\UpdateSupplierPICRequest;

class SupplierPICApiController extends Controller
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
     * @param  \App\Http\Requests\StoreSupplierPICRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSupplierPICRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SupplierPIC  $supplierPIC
     * @return \Illuminate\Http\Response
     */
    public function show(SupplierPIC $supplierPIC)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSupplierPICRequest  $request
     * @param  \App\Models\SupplierPIC  $supplierPIC
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSupplierPICRequest $request, SupplierPIC $supplierPIC)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SupplierPIC  $supplierPIC
     * @return \Illuminate\Http\Response
     */
    public function destroy(SupplierPIC $supplierPIC)
    {
        //
    }
}
