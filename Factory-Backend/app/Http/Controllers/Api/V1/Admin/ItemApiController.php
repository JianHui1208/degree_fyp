<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\StockHistory;
use App\Models\Item;
use App\Http\Requests\ApiRequests\StoreItemApiRequest;
use App\Http\Requests\ApiRequests\UpdateItemApiRequest;
use App\Models\ItemCategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;

class ItemApiController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::with(['item_category', 'image'])->where('company_id', Auth::user()->company_id)->get();

        return parent::resFormat(1102, null, ['items' => $items]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ApiRequests\StoreItemApiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreItemApiRequest $request)
    {
        DB::beginTransaction();

        try {
            $request['uid'] = $this->generateUID('ITEM', 4);
            Item::create($request->all());

            DB::commit();
            return parent::resFormat(1101);
        } catch (Exception $e) {
            DB::rollBack();
            Log::channel("api")->error("Item Store 出错", ["request" => $request->validated(), 'error' => $e->getMessage()]);
            return parent::error();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Item::with(['item_category', 'image'])->where('id', $id)->first();

        if ($item->image) {
            $item['image_url'] = $item->image->document->url ?? null;
            $item['image_thumbnail'] = $item->image->document->thumbnail ?? null;
            $item['image_preview'] = $item->image->document->preview ?? null;
        }

        $item->makeHidden([
            'image', 'media'
        ]);

        return parent::resFormat(1103, null, ['item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ApiRequests\UpdateItemApiRequest  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateItemApiRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $item = Item::where('id', $id)->first();
            $item->update($request->all());

            DB::commit();
            return parent::resFormat(1104);
        } catch (Exception $e) {
            DB::rollBack();
            Log::channel("api")->error("Item Update 出错", ["request" => $request->validated(), 'error' => $e->getMessage()]);
            return parent::error();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Item::where('id', $id)->delete();
        return parent::resFormat(1105);
    }

    /**
     * Active the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function activeItem($id)
    {
        DB::beginTransaction();
        try {
            $item = Item::where('id', $id)->first();
            $data = ['status' => 1];

            if ($item->status) {
                $data = ['status' => 0];
            }

            $item->update($data);
            DB::commit();
            return parent::resFormat(1106);
        } catch (Exception $e) {
            DB::rollback();
            Log::channel("api")->error("Active Item Function Error", ["id" => $id, 'error' => $e->getMessage()]);
            return parent::resFormat(-1);
        }
    }

    public function searchItem(Request $request)
    {
        $keyword = request('keyword');

        $items = Item::with(['item_category', 'image'])->where('company_id', Auth::user()->company_id)
            ->where(function ($query) use ($keyword) {
                $query->where('name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('barcode', 'LIKE', '%' . $keyword . '%')
                    ->orWhereHas('item_category', function ($query) use ($keyword) {
                        $query->where('name', 'LIKE', '%' . $keyword . '%');
                    });
            })
            ->get();

        $itemLength = count($items);

        if ($itemLength == 0) {
            return parent::resFormat(1110);
        } else {
            foreach ($items as $item) {
                if ($item->image) {
                    $item['image_url'] = $item->image->document->url ?? null;
                    $item['image_thumbnail'] = $item->image->document->thumbnail ?? null;
                    $item['image_preview'] = $item->image->document->preview ?? null;
                }
                unset($item->image);
            }
            return parent::resFormat(1107, null, ['result' => $items]);
        }
    }

    public function searchItemByBarcode($barcode)
    {
        $items = Item::with(['item_category', 'image'])->where('barcode', $barcode)->first();

        if (!$items) {
            return parent::resFormat(1110);
        }

        if ($items->image) {
            $items['image_url'] = $items->image->document->url ?? null;
            $items['image_thumbnail'] = $items->image->document->thumbnail ?? null;
            $items['image_preview'] = $items->image->document->preview ?? null;
        }

        $items->makeHidden([
            'image', 'media'
        ]);

        return parent::resFormat(1107, null, ['item' => $items]);
    }

    public function getItemByItemCategory($id)
    {
        $items = Item::with(['item_category', 'image'])->where('item_category_id', $id)->orderBy('created_at', 'DESC')->get();

        foreach ($items as $item) {
            if ($item->image) {
                $item['image_url'] = $item->image->document->url ?? null;
                $item['image_thumbnail'] = $item->image->document->thumbnail ?? null;
                $item['image_preview'] = $item->image->document->preview ?? null;
            }
        }

        $items->makeHidden([
            'item_category_id', 'created_at', 'updated_at',
            'uid', 'status', 'cost', 'price', 'image_id',
            'deleted_at', 'barcode', 'warehouse_id',
            'supplier_id', 'item_category', 'image',
        ]);
        return parent::resFormat(1108, null, ['items' => $items]);
    }

    public function countQuantityItem()
    {
        $itemCategoryID = ItemCategory::where('company_id', Auth::user()->company_id)->pluck('id');
        $items_quantity = Item::whereIn('item_category_id', $itemCategoryID)->sum('quantity');
        $stockOut_quantity = StockHistory::where('company_id', Auth::user()->company_id)
            ->where('in_or_out', 1)->whereDate('created_at', Carbon::now())->sum('total_quantity');
        $stockIn_quantity = StockHistory::where('company_id', Auth::user()->company_id)
            ->where('in_or_out', 0)->whereDate('created_at', Carbon::now())->sum('total_quantity');

        return parent::resFormat(1109, null, [
            'items_quantity' => (int) $items_quantity,
            'stockOut_quantity' => (int) $stockOut_quantity,
            'stockIn_quantity' => (int) $stockIn_quantity
        ]);
    }

    public function getItemOfStockRecord()
    {
        $items = Item::with(['image'])->select(
            'id',
            'name',
            'quantity',
            'image_id'
        )->where('company_id', Auth::user()->company_id)->get();

        foreach ($items as $item) {
            $item['image_url'] = $item->image->document->url ?? null;
        }

        $items->makeHidden([
            'image_id', 'image'
        ]);

        return parent::resFormat(1111, null, ['items' => $items]);
    }
}
