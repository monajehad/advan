@extends('layouts.cpanel.app')

@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.sample.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.samples.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.sample.fields.id') }}
                        </th>
                        <td>
                            {{ $sample->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sample.fields.sample') }}
                        </th>
                        <td>
                            {{ $sample->sample->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sample.fields.user') }}
                        </th>
                        <td>
                            {{ $sample->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sample.fields.quantity_request') }}
                        </th>
                        <td>
                            {{ $sample->quantity_request }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sample.fields.quantity') }}
                        </th>
                        <td>
                            {{ $sample->quantity }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sample.fields.end_date') }}
                        </th>
                        <td>
                            {{ $sample->end_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sample.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Sample::STATUS_SELECT[$sample->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.samples.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
