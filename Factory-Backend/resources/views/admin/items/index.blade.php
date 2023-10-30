@extends('layouts.admin')
@section('content')

@can('item_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('admin.items.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.item.title_singular') }}
        </a>
    </div>
</div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.item.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-item">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.item.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.item.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.item.fields.item_category_id') }}
                    </th>
                    <th>
                        {{ trans('cruds.item.fields.bar_code') }}
                    </th>
                    <th>
                        {{ trans('cruds.item.fields.cost') }}
                    </th>
                    <th>
                        {{ trans('cruds.item.fields.price') }}
                    </th>
                    <th>
                        {{ trans('cruds.item.fields.quantity') }}
                    </th>
                    <th>
                        {{ trans('cruds.item.fields.image_id') }}
                    </th>
                    <th>
                        {{ trans('cruds.item.fields.company_id') }}
                    </th>
                    <th>
                        {{ trans('cruds.item.fields.is_active') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>

@endsection
@section('scripts')
@parent
<script>
    $(function() {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

        let dtOverrideGlobals = {
            buttons: dtButtons,
            processing: true,
            serverSide: true,
            retrieve: true,
            aaSorting: [],
            ajax: "{{ route('admin.items.index') }}",
            columns: [{
                    data: 'placeholder',
                    name: 'placeholder',
                    visible: false,
                },
                {
                    data: 'id',
                    name: 'id',
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'item_category',
                    name: 'item_category'
                },
                {
                    data: 'barcode',
                    name: 'barcode'
                },
                {
                    data: 'cost',
                    name: 'cost'
                },
                {
                    data: 'price',
                    name: 'price'
                },
                {
                    data: 'quantity',
                    name: 'quantity'
                },
                {
                    data: 'image_id',
                    name: 'image_id'
                },
                {
                    data: 'company_id',
                    name: 'company_id'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'actions',
                    name: '{{ trans("global.actions") }}'
                }
            ],
            orderCellsTop: true,
            order: [
                [2, 'asc']
            ],
            pageLength: 100,
        };
        let table = $('.datatable-item').DataTable(dtOverrideGlobals);
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });

    });
</script>
@endsection