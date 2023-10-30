@extends('layouts.admin')
@section('content')
    @can('user_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.users.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.user.title_singular') }}
                </a>
            </div>
        </div>
    @endcan

    <div class="card">
        <div class="card-header">
            {{ trans('cruds.user.title_singular') }} {{ trans('global.search') }}
        </div>
        <div class="card-body">
            <form class="row" id="search">
                <div class="form-group col-12 col-lg-6 col-xl-3">
                    <label>{{ trans('cruds.user.fields.name') }}</label>
                    <input type="text" class="form-control" id="search_name">
                </div>
                <div class="form-group col-12 col-lg-6 col-xl-3">
                    <label>{{ trans('cruds.user.fields.email') }}</label>
                    <input type="text" class="form-control" id="search_email">
                </div>
                <div class="form-group col-12 col-lg-6 col-xl-3">
                    <label>{{ trans('cruds.user.fields.type') }}</label>
                    <select class="form-control select2" id="search_type">
                        <option value="All">{{ trans('global.all') }}</option>
                        @foreach (App\Models\user::TYPE_SELECT as $key => $label)
                            <option value="{{ $key }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-12 col-lg-6 col-xl-3">
                    <label>{{ trans('cruds.user.fields.is_active') }}</label>
                    <select class="form-control select2" id="search_is_active">
                        <option value="All">{{ trans('global.all') }}</option>
                        @foreach (App\Models\user::STATUS_SELECT as $key => $label)
                            <option value="{{ $key }}">{{ $label }}</option>
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
            <div class="form-check col-12 text-right">
                <label class="checkbox-inline mr-2">
                    <input class="form-check-input" type="checkbox" value="" id="refresh" checked>
                    <label class="form-check-label" for="refresh">
                        {{ trans('global.auto_refresh') }}
                    </label>
                </label>
                <button type="button" id="refresh_button" class="btn btn-light btn_controller" disabled>
                    {{ trans('global.refresh') }} (<span id="countdown_number">15</span>)
                </button>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            {{ trans('cruds.user.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-User">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.user.fields.uid') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.username') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.roles') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.type') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.company_id') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.is_active') }}
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

            var firstTime = true;

            const default_page = 0;
            const default_page_length = 100;
            const localStorage_name = "user";

            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('user_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
                let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.users.massDestroy') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
                return entry.id
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
                order: [
                    [2, 'asc']
                ],
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
                    url: "{{ route('admin.users.index') }}",
                    data: function(d) {

                        if (localStorage.getItem(localStorage_name) && firstTime) {
                            var data = JSON.parse(localStorage.getItem(localStorage_name));

                            var page = data['page'] ? data['page'] : default_page;
                            var length = data['length'] ? data['length'] : default_page_length;

                            d.start = page * length;
                        }

                        d.name      = $('#search_name').val();
                        d.email     = $('#search_email').val();
                        d.type      = $('#search_type').val();
                        d.is_active = $('search_is_active').val();
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
                        data: 'uid',
                        name: 'uid'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'username',
                        name: 'username'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'roles',
                        name: 'roles.title' ?? 'User'
                    },
                    {
                        data: 'type',
                        name: 'type'
                    },
                    {
                        data: 'company_id',
                        name: 'company_id'
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
            let table = $('.datatable-User').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

            $('.datatable-User').on('page.dt', function() {
                datatable_set_page_and_length();
            });

            $('.datatable-User').on('length.dt', function(e, settings, len) {
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

            $("#refresh_button").click(function() {
                reset_reload_button();
            })

            var doUpdate = function() {
                if ($('#refresh').is(':checked')) {
                    var count = parseInt($('#countdown_number').html());
                    if (count !== 0) {
                        $('#countdown_number').html(count - 1);
                    } else {
                        reset_reload_button();
                    }
                }
            };

            function reset_reload_button() {
                $('.btn_controller').prop('disabled', true);
                $('#countdown_number').html(15);
                table.ajax.reload(null, false);
            }

            setInterval(doUpdate, 1000);

            $("#reset").on('click', function(e) {
                e.preventDefault();

                $('.btn_controller').prop('disabled', true);

                Reset();
                Searching();
            });

            function Reset() {
                $('#search_name').val('');
                $('#search_email').val('');
                $('#search_type').val('All').trigger('change');
                $('#search_is_active').val('All').trigger('change');
            }

            function Default() {
                if (localStorage.getItem(localStorage_name)) {
                    var searching = JSON.parse(localStorage.getItem(localStorage_name));

                    $('#search_name').val(searching['name'] ? searching['name'] : '');
                    $('#search_email').val(searching['email'] ? searching['email'] : '');
                    $('#search_type').val(searching['type'] ? searching['type'] : 'All').trigger('change');
                    $('#search_is_active').val(searching['status'] ? searching['status'] : 'All').trigger('change');

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
                    'name': $('#search_name').val(),
                    'email': $('#search_email').val(),
                    'type': $('#search_type').val(),
                    'status': $('#search_is_active').val(),
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

        });
    </script>
@endsection
