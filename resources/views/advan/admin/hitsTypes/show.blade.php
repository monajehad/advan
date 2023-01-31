@extends('layouts.cpanel.app')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.hitsType.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.hits-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.hitsType.fields.id') }}
                        </th>
                        <td>
                            {{ $hitsType->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hitsType.fields.name') }}
                        </th>
                        <td>
                            {{ $hitsType->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hitsType.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\HitsType::STATUS_SELECT[$hitsType->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.hits-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
