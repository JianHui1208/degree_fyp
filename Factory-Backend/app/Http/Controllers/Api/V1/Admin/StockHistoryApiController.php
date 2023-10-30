<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\BaseController;
use App\Models\StockHistory;
use App\Models\StockItemRecordHistory;
use App\Models\Item;
use App\Http\Requests\StoreStockHistoryRequest;
use App\Http\Requests\UpdateStockHistoryRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Exception;

class StockHistoryApiController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all()->sum('quantity');
        $in_stockHistory = StockHistory::whereDate('created_at', Carbon::now())->where('in_or_out', 0)->sum('total_quantity');
        $out_stockHistory = StockHistory::whereDate('created_at', Carbon::now())->where('in_or_out', 1)->sum('total_quantity');

        $return_response = [
            'items_total_quantity' => (string) $items,
            'in_stockHistory_count' => $in_stockHistory,
            'out_stockHistory_count' => $out_stockHistory,
        ];

        return parent::resFormat(1151, null, [
            'stockHistory' => $return_response
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStockHistoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStockHistoryRequest $request)
    {
        DB::beginTransaction();
        try {
            $request['company_id'] = auth()->user()->company_id;
            $stockHistory = StockHistory::create($request->all());

            foreach ($request['stockItems'] as $stockItem) {
                $stockItem['stock_history_id'] = $stockHistory->id;
                StockItemRecordHistory::create($stockItem);
            }
            DB::commit();
            return parent::resFormat(1154);
        } catch (Exception $e) {
            DB::rollBack();
            Log::channel("api")->error("StockHistory Store 出错", ["request" => $request->validated(), 'error' => $e->getMessage()]);
            return parent::error();
        }
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

    public function getStockListGroupByDate()
    {
        $stockHistories = StockHistory::select('stock_histories.*', DB::raw('DATE(created_at) as date'))
            ->orderBy('created_at', 'desc')
            ->where('company_id', auth()->user()->company_id)
            ->get()
            ->groupBy('date');

        $transformedData = [];
        $index = 1;

        foreach ($stockHistories as $date => $histories) {
            $stockListKey = 'StockList' . $index;
            $transformedData[$stockListKey] = [
                'date' => $date,
                'stockOrder' => $histories
            ];
            $index++;
        }

        foreach ($transformedData as $stockHistory) {
            foreach ($stockHistory['stockOrder'] as $stockOrder) {
                $stockListItem = StockItemRecordHistory::selectRaw('sum(new_quantity) as total_quantity')->where('stock_history_id', $stockOrder->id)->get();
                $stockOrder['total_quantity'] = $stockListItem[0]->total_quantity;
                $stockOrder['item_count'] = StockItemRecordHistory::where('stock_history_id', $stockOrder->id)->count();
            }
        }

        return parent::resFormat(1152, null, [
            'stockHistory' => $transformedData
        ]);
    }

    public function getStockHistoryById($id)
    {
        $stockHistory = StockHistory::where('id', $id)->first();
        $stockHistory['stockItems'] = StockItemRecordHistory::with(['items', 'items.image'])->where('stock_history_id', $id)->get();
        $stockHistory['item_count'] = StockItemRecordHistory::where('stock_history_id', $id)->count();
        foreach ($stockHistory['stockItems'] as $stockOrder) {
            $stockOrder['items']['imageUrl'] = $stockOrder->items->image->document->url ?? null;
            $stockOrder['items']->makeHidden(['barcode', 'cost', 'price', 'item_category_id', 'image_id', 'warehouse_id', 'status', 'created_at', 'updated_at', 'deleted_at', 'quantity', 'supplier_id']);
            unset($stockOrder->items->image);
        }

        // $stockTotalQuantity = StockItemRecordHistory::selectRaw('sum(new_quantity) as total_quantity')->where('stock_history_id', $id)->get();
        // $stockHistory['total_quantity'] = (int) $stockTotalQuantity[0]->total_quantity;

        return parent::resFormat(1153, null, [
            'stockHistory' => $stockHistory
        ]);
    }
}
