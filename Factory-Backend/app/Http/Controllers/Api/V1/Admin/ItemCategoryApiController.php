<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\BaseController;
use App\Models\ItemCategory;
use App\Models\Item;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ApiRequests\StoreItemCategoryApiRequest;
use App\Http\Requests\ApiRequests\UpdateItemCategoryApiRequest;
use App\Http\Requests\ApiRequests\ActiveItemCategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class ItemCategoryApiController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $itemCategories = ItemCategory::with(['image'])->where('company_id', Auth::user()->company_id)->get();

        foreach ($itemCategories as $itemCategory) {
            $itemCategory['image_url'] = $itemCategory->image->document->url ?? null;
            $itemCategory['image_preview'] = $itemCategory->image->document->preview ?? null;
            $itemCategory['image_thumbnail'] = $itemCategory->image->document->thumbnail ?? null;
        }

        $itemCategories->makeHidden(['created_at', 'updated_at', 'deleted_at', 'image', 'media']);

        return parent::resFormat(1052, null, ['itemCategories' => $itemCategories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreItemCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreItemCategoryApiRequest $request)
    {
        DB::beginTransaction();

        try {
            $request['uid'] = $this->generateUID('ITEM_CATE');
            ItemCategory::create($request->all());

            DB::commit();
            return parent::resFormat(1051);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::channel("api")->error("Item Category Store 出错", ["request" => $request->validated(), 'error' => $e->getMessage()]);
            return parent::error();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ItemCategory  $itemCategory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $itemCategory = ItemCategory::where('id', $id)->first();

        return parent::resFormat(1053, null, ['itemCategory' => $itemCategory]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateItemCategoryRequest  $request
     * @param  \App\Models\ItemCategory  $itemCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateItemCategoryApiRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $itemCategory = ItemCategory::where('id', $id)->first();
            $itemCategory->update($request->all());
            DB::commit();
            return parent::resFormat(1054);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::channel("api")->error("Item Category Update 出错", ["request" => $request->validated(), 'error' => $e->getMessage()]);
            return parent::error();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItemCategory  $itemCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ItemCategory::where('id', $id)->delete();
        return parent::resFormat(1055);
    }

    public function active_item_cateory($id)
    {
        DB::beginTransaction();
        try {
            $item_category = ItemCategory::where('id', $id)->first();
            $data = ['status' => 1];

            if ($item_category->status) {
                $data = ['status' => 0];
            }

            $item_category->update($data);
            DB::commit();
            return parent::resFormat(1056);
        } catch (Exception $e) {
            DB::rollback();
            Log::channel("api")->error("Active Item Category Function Error", ["id" => $id, 'error' => $e->getMessage()]);
            return parent::resFormat(-1);
        }
    }

    public function getCategoryList()
    {
        $itemCategories = ItemCategory::with(['items' => function ($query) {
            // $query->select('item_category_id');
        }])->where('company_id', Auth::user()->company_id)->withCount('items')->get();

        foreach ($itemCategories as $itemCategory) {
            $items = Item::where('item_category_id', $itemCategory->id)->sum('quantity');
            $itemCategory['total_quantity'] = (int) $items;

            foreach ($itemCategories as $itemCategory) {
                $itemCategory['image_url'] = $itemCategory->image->document->url ?? null;
                $itemCategory['image_preview'] = $itemCategory->image->document->preview ?? null;
                $itemCategory['image_thumbnail'] = $itemCategory->image->document->thumbnail ?? null;
            }

            unset($itemCategory->items);
        }

        $itemCategories->makeHidden(['created_at', 'updated_at', 'deleted_at', 'uid', 'image', 'media']);

        return parent::resFormat(1057, null, ['itemCategories' => $itemCategories]);
    }

    function getItemCateByCompanyId()
    {
        $itemCategories = ItemCategory::where('company_id', Auth::user()->company_id)->get();

        return parent::resFormat(1058, null, ['itemCategories' => $itemCategories]);
    }
}
