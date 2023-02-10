@extends('layouts.cpanel.app')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.sampleStock.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sample-stocks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.sampleStock.fields.id') }}
                        </th>
                        <td>
                            {{ $sampleStock->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sampleStock.fields.name') }}
                        </th>
                        <td>
                            {{ $sampleStock->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            رقم الباتش
                        </th>
                        <td>
                            {{ $sampleStock->patch_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sampleStock.fields.quantity') }}
                        </th>
                        <td>
                            {{ $sampleStock->quantity }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sampleStock.fields.received_date') }}
                        </th>
                        <td>
                            {{ $sampleStock->received_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sampleStock.fields.end_date') }}
                        </th>
                        <td>
                            {{ $sampleStock->end_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sampleStock.fields.category') }}
                        </th>
                        <td>
                            {{ $sampleStock->category->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sampleStock.fields.available') }}
                        </th>
                        <td>
                            {{ $sampleStock->available }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sampleStock.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\SampleStock::STATUS_SELECT[$sampleStock->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sample-stocks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
