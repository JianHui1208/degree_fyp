@extends('layouts.admin')
@section('content')

@can('company_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('admin.companies.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.company.title_singular') }}
        </a>
    </div>
</div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.company.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-company">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.company.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.company.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.company.fields.email') }}
                    </th>
                    <th>
                        {{ trans('cruds.company.fields.subscription') }}
                    </th>
                    <th>
                        {{ trans('cruds.company.fields.status') }}
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
            ajax: "{{ route('admin.companies.index') }}",
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
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'subscription',
                    name: 'subscription'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'actions',
                    name: "{{ trans('global.actions') }}"
                }
            ],
            orderCellsTop: true,
            order: [
                [2, 'asc']
            ],
            pageLength: 100,
        };
        let table = $('.datatable-company').DataTable(dtOverrideGlobals);
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });

    });
</script>
@endsection