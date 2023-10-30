<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StockItemRecordHistory;
use App\Http\Requests\StoreStockItemRecordHistoryRequest;
use App\Http\Requests\UpdateStockItemRecordHistoryRequest;

class StockItemRecordHistoryController extends Controller
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
     * @param  \App\Http\Requests\StoreStockItemRecordHistoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStockItemRecordHistoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StockItemRecordHistory  $stockItemRecordHistory
     * @return \Illuminate\Http\Response
     */
    public function show(StockItemRecordHistory $stockItemRecordHistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StockItemRecordHistory  $stockItemRecordHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(StockItemRecordHistory $stockItemRecordHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStockItemRecordHistoryRequest  $request
     * @param  \App\Models\StockItemRecordHistory  $stockItemRecordHistory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStockItemRecordHistoryRequest $request, StockItemRecordHistory $stockItemRecordHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StockItemRecordHistory  $stockItemRecordHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(StockItemRecordHistory $stockItemRecordHistory)
    {
        //
    }
}
