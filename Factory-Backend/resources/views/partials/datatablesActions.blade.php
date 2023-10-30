@can($viewGate)
    <a class="btn btn-xs btn-outline-primary" href="{{ route('admin.' . $crudRoutePart . '.show', $row->id) }}">
        {{ trans('global.view') }}
    </a>
@endcan

@can($editGate)
    <a class="btn btn-xs btn-info" href="{{ route('admin.' . $crudRoutePart . '.edit', $row->id) }}">
        {{ trans('global.edit') }}
    </a>
@endcan

@can($deleteGate)
    <form action="{{ route('admin.' . $crudRoutePart . '.destroy', $row->id) }}" method="POST"
        onsubmit="return confirm('{{ trans('global.areYouSure') }}');">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
    </form>
@endcan

@if(isset($activeGate))
    <form action="{{ route('admin.' . $crudRoutePart . '.active') }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id" value="{{ $row->id }}">
        <input type="submit" class="btn btn-xs btn-info" value="{{ trans('global.active') }}">
    </form>
@endif

@if(isset($inactiveGate))
    <form action="{{ route('admin.' . $crudRoutePart . '.inactive') }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id" value="{{ $row->id }}">
        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.inactive') }}">
    </form>
@endif