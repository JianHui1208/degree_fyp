@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.warehouse.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-warehouse">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.warehouse.fields.uid') }}
                    </th>
                    <th>
                        {{ trans('cruds.warehouse.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.warehouse.fields.status') }}
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
            ajax: "{{ route('admin.warehouses.index') }}",
            columns: [{
                    data: 'placeholder',
                    name: 'placeholder',
                    visible: false,
                },
                {
                    data: 'uid',
                    name: 'uid',
                    visible: false,
                },
                {
                    data: 'name',
                    name: 'name'
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
        let table = $('.datatable-warehouses').DataTable(dtOverrideGlobals);
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });

    });
</script>
@endsection