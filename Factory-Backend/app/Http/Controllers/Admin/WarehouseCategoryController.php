<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WarehouseCategory;
use App\Http\Requests\StoreWarehouseCategoryRequest;
use App\Http\Requests\UpdateWarehouseCategoryRequest;

class WarehouseCategoryController extends Controller
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
     * @param  \App\Http\Requests\StoreWarehouseCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWarehouseCategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WarehouseCategory  $warehouseCategory
     * @return \Illuminate\Http\Response
     */
    public function show(WarehouseCategory $warehouseCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WarehouseCategory  $warehouseCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(WarehouseCategory $warehouseCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWarehouseCategoryRequest  $request
     * @param  \App\Models\WarehouseCategory  $warehouseCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWarehouseCategoryRequest $request, WarehouseCategory $warehouseCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WarehouseCategory  $warehouseCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(WarehouseCategory $warehouseCategory)
    {
        //
    }
}
