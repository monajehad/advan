@extends('layouts.cpanel.app')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.kindsOfOccasion.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.kinds-of-occasions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.kindsOfOccasion.fields.id') }}
                        </th>
                        <td>
                            {{ $kindsOfOccasion->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kindsOfOccasion.fields.name') }}
                        </th>
                        <td>
                            {{ $kindsOfOccasion->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kindsOfOccasion.fields.description') }}
                        </th>
                        <td>
                            {{ $kindsOfOccasion->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kindsOfOccasion.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\KindsOfOccasion::STATUS_SELECT[$kindsOfOccasion->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.kinds-of-occasions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
