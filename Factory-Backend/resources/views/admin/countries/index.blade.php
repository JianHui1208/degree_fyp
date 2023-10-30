@extends('layouts.admin')
@section('content')
    @can('country_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.countries.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.country.title_singular') }}
                </a>
            </div>
        </div>
    @endcan

    <div class="card">
        <div class="card-header">
            {{ trans('cruds.country.title_singular') }} {{ trans('global.search') }}
        </div>
        <div class="card-body">
            <form class="row" id="search">
                <div class="form-group col-12 col-lg-6 col-xl-3">
                    <label>{{ trans('cruds.country.fields.is_active') }}</label>
                    <select class="form-control select2" id="search_is_active">
                        <option value="All">{{ trans('global.all') }}</option>
                        @foreach (App\Models\Country::STATUS_SELECT as $key => $label)
                            <option value="{{ $key }}">
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-12 col-xl-3 align-self-end">
                    <button type="button" id="search_form_submit" class="btn btn-primary btn_controller" disabled>
                        {{ trans('global.search') }}
                    </button>
                    <button type="button" id="reset" class="btn btn-danger btn_controller" disabled>
                        {{ trans('global.reset') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            {{ trans('cruds.country.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Country">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.country.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.country.fields.short_code') }}
                            </th>
                            <th>
                                {{ trans('cruds.country.fields.mobile_code') }}
                            </th>
                            <th>
                                {{ trans('cruds.country.fields.icon') }}
                            </th>
                            <th>
                                {{ trans('cruds.country.fields.is_active') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    @parent
    <script>
        $(function() {

            var firstTime = true;

            const default_page = 0;
            const default_page_length = 10;
            const localStorage_name = "Countries";

            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('country_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.countries.massDestroy') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
                return $(entry).data('entry-id')
                });
            
                if (ids.length === 0) {
                alert('{{ trans('global.datatables.zero_selected') }}')
            
                return
                }
            
                if (confirm('{{ trans('global.areYouSure') }}')) {
                $.ajax({
                headers: {'x-csrf-token': _token},
                method: 'POST',
                url: config.url,
                data: { ids: ids, _method: 'DELETE' }})
                .done(function () { location.reload() })
                }
                }
                }
                dtButtons.push(deleteButton)
            @endcan

            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                orderCellsTop: true,
                aLengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "All"]
                ],
                pageLength: localStorage.getItem(localStorage_name) ? JSON.parse(localStorage.getItem(
                        localStorage_name))[
                        'length'] ? JSON.parse(localStorage.getItem(localStorage_name))['length'] :
                    default_page_length : default_page_length,
                ajax: {
                    url: "{{ route('admin.countries.index') }}",
                    data: function(d) {

                        if (localStorage.getItem(localStorage_name) && firstTime) {
                            var data = JSON.parse(localStorage.getItem(localStorage_name));

                            var page = data['page'] ? data['page'] : default_page;
                            var length = data['length'] ? data['length'] : default_page_length;

                            d.start = page * length;
                        }

                        d.is_active         = $('#search_is_active').val();
                    }
                },
                initComplete: function(settings, json) {
                    if (localStorage.getItem(localStorage_name)) {
                        var data = JSON.parse(localStorage.getItem(localStorage_name));
                        if (data['page']) {
                            const api = $.fn.dataTable.Api(settings);
                            api.page(data['page']).draw(false);
                        }
                        firstTime = false;
                    }
                },
                drawCallback: function(settings) {
                    $('.btn_controller').prop('disabled', false);
                },
                columns: [{
                        data: 'placeholder',
                        name: 'placeholder',
                        visible: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'short_code',
                        name: 'short_code'
                    },
                    {
                        data: 'mobile_code',
                        name: 'mobile_code'
                    },
                    { 
                        data: 'icon', 
                        name: 'icon', 
                        sortable: false, 
                        searchable: false 
                    },
                    {
                        data: 'is_active',
                        name: 'is_active'
                    },
                    {
                        data: 'actions',
                        name: '{{ trans("global.actions") }}'
                    }
                ],
            };
            let table = $('.datatable-Country').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

            $('.datatable-Country').on('page.dt', function() {
                datatable_set_page_and_length();
            });

            $('.datatable-Country').on('length.dt', function(e, settings, len) {
                datatable_set_page_and_length();
            });

            function datatable_set_page_and_length() {
                var info = table.page.info();

                if (localStorage.getItem(localStorage_name)) {
                    var search_arr = JSON.parse(localStorage.getItem(localStorage_name));
                }

                search_arr['page'] = info.page;
                search_arr['length'] = info.length;

                localStorage.setItem(localStorage_name, JSON.stringify(search_arr));
            }

            $("#reset").on('click', function(e) {
                e.preventDefault();

                $('.btn_controller').prop('disabled', true);

                Reset();
                Searching();
            });

            function Reset() {
                $('#search_is_active').val('1').trigger('change');
            }

            function Default() {
                if (localStorage.getItem(localStorage_name)) {
                    var searching = JSON.parse(localStorage.getItem(localStorage_name));

                    $('#search_is_active').val(searching['is_active'] ? searching['is_active'] : '1').trigger('change');

                    Searching();
                } else {
                    Reset();
                    Searching();
                }
            }

            Default();

            function Searching() {
                table.ajax.reload();

                var store_arr = {
                    'is_active': $('#search_is_active').val(),
                };

                if (localStorage.getItem(localStorage_name) && firstTime) {
                    var old_search_data = JSON.parse(localStorage.getItem(localStorage_name));

                    var page = old_search_data['page'] ? old_search_data['page'] : default_page;
                    var length = old_search_data['length'] ? old_search_data['length'] : default_page_length;

                    store_arr['page'] = page;
                    store_arr['length'] = length;
                }

                localStorage.setItem(localStorage_name, JSON.stringify(store_arr));
            }

            $('#search_form_submit').on('click', function(e) {
                e.preventDefault();

                $('.btn_controller').prop('disabled', true);

                Searching();
            });

        })
    </script>
@endsection
