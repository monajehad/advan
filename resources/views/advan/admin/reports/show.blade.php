@extends('layouts.cpanel.app')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.report.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.reports.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.report.fields.id') }}
                        </th>
                        <td>
                            {{ $report->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.report.fields.user') }}
                        </th>
                        <td>
                            {{ $report->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.report.fields.type') }}
                        </th>
                        <td>
                            {{ $report->type->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.report.fields.name') }}
                        </th>
                        <td>
                            {{ $report->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.report.fields.client') }}
                        </th>
                        <td>
                            {{ $report->client->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.report.fields.date') }}
                        </th>
                        <td>
                            {{ $report->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.report.fields.time') }}
                        </th>
                        <td>
                            {{ $report->time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.report.fields.client_name') }}
                        </th>
                        <td>
                            {{ $report->client_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.report.fields.title') }}
                        </th>
                        <td>
                            {{ $report->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.report.fields.description') }}
                        </th>
                        <td>
                            {{ $report->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.report.fields.note') }}
                        </th>
                        <td>
                            {{ $report->note }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.report.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Report::STATUS_SELECT[$report->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.reports.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
