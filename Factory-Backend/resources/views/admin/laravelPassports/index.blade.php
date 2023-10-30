@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.passport.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-passport">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.passport.fields.user_id') }}
                    </th>
                    <th>
                        {{ trans('cruds.passport.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.passport.fields.secret') }}
                    </th>
                    <th>
                        {{ trans('cruds.passport.fields.provider') }}
                    </th>
                    <th>
                        {{ trans('cruds.passport.fields.redirect') }}
                    </th>
                    <th>
                        {{ trans('cruds.passport.fields.personal_access_client') }}
                    </th>
                    <th>
                        {{ trans('cruds.passport.fields.password_client') }}
                    </th>
                    <th>
                        {{ trans('cruds.passport.fields.revoked') }}
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
                ajax: "{{ route('admin.laravel-passports.index') }}",
                columns: [{
                        data: 'placeholder',
                        name: 'placeholder',
                        visible: false
                    },
                    {
                        data: 'user_id',
                        name: 'user_id',
                        visible: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'secret',
                        name: 'secret'
                    },
                    {
                        data: 'provider',
                        name: 'provider'
                    },
                    {
                        data: 'redirect',
                        name: 'redirect'
                    },
                    {
                        data: 'personal_access_client',
                        name: 'personal_access_client'
                    },
                    {
                        data: 'password_client',
                        name: 'password_client'
                    },
                    {
                        data: 'revoked',
                        name: 'revoked'
                    },
                    {
                        data: 'actions',
                        name: '{{ trans('global.actions') }}'
                    }
                ],
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 100,
            };
            let table = $('.datatable-passport').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        });
    </script>
@endsection
