<?php

namespace App\Http\Controllers\Api\V1\Users;

use App\Http\Controllers\Controller;
use App\Models\StockHistory;
use App\Http\Requests\StoreStockHistoryRequest;
use App\Http\Requests\UpdateStockHistoryRequest;

class StockHistoryApiController extends Controller
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
