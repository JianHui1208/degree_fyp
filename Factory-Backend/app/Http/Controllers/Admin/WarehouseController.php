<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Warehouse;
use App\Http\Requests\StoreWarehouseRequest;
use App\Http\Requests\UpdateWarehouseRequest;

class WarehouseController extends Controller
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
     * @param  \App\Http\Requests\StoreWarehouseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWarehouseRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Warehouse  $Warehouse
     * @return \Illuminate\Http\Response
     */
    public function show(Warehouse $Warehouse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Warehouse  $Warehouse
     * @return \Illuminate\Http\Response
     */
    public function edit(Warehouse $Warehouse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWarehouseRequest  $request
     * @param  \App\Models\Warehouse  $Warehouse
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWarehouseRequest $request, Warehouse $Warehouse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Warehouse  $Warehouse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Warehouse $Warehouse)
    {
        //
    }
}
