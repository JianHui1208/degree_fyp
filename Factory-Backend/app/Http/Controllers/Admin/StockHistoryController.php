<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StockHistory;
use App\Http\Requests\StoreStockHistoryRequest;
use App\Http\Requests\UpdateStockHistoryRequest;

class StockHistoryController extends Controller
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
     * @param  \App\Http\Requests\StoreStockHistoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStockHistoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StockHistory  $stockHistory
     * @return \Illuminate\Http\Response
     */
    public function show(StockHistory $stockHistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StockHistory  $stockHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(StockHistory $stockHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStockHistoryRequest  $request
     * @param  \App\Models\StockHistory  $stockHistory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStockHistoryRequest $request, StockHistory $stockHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StockHistory  $stockHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(StockHistory $stockHistory)
    {
        //
    }
}
