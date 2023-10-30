<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Image;
use App\Models\ItemCategory;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('item_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Item::with(['item_category'])->select(sprintf('%s.*', (new Item())->table))->orderBy('created_at', 'DESC');

            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'item_show';
                $editGate = 'item_edit';
                $activeGate = 'item_edit';
                $inactiveGate = 'item_edit';
                $deleteGate = 'item_delete';
                $crudRoutePart = 'items';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'activeGate',
                    'inactiveGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });

            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });

            $table->editColumn('barcode', function ($row) {
                return $row->barcode ? $row->barcode : '';
            });

            $table->editColumn('cost', function ($row) {
                return $row->cost ? $row->cost : '';
            });

            $table->editColumn('price', function ($row) {
                return $row->price ? $row->price : '';
            });

            $table->editColumn('quantity', function ($row) {
                return $row->quantity ? $row->quantity : '';
            });

            $table->editColumn('item_category', function ($row) {
                return $row->item_category ? $row->item_category->name : '';
            });

            $table->editColumn('status', function ($row) {
                return Item::STATUS_SELECT[$row->status] ? Item::STATUS_SELECT[$row->status] : '';
            });

            $table->rawColumns(['actions', 'status', 'item_category']);

            return $table->make(true);
        }

        return view('admin.items.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $itemCategories = ItemCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $images = Image::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');
        $companies = Company::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.items.create', compact('itemCategories', 'images', 'companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreItemRequest $request)
    {
        $request->merge(['uid' => uniqid()]);
        $item = Item::create($request->all());

        return redirect()->route('admin.items.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        $itemCategories = ItemCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $images = Image::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');
        $companies = Company::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $item->load('item_category', 'image', 'company');

        return view('admin.items.edit', compact('itemCategories', 'images', 'companies', 'item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateItemRequest  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        $item->update($request->all());

        return redirect()->route('admin.items.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
    }
}
