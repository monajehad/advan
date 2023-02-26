@extends('layouts.cpanel.app')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.hit.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.hits.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.hit.fields.id') }}
                        </th>
                        <td>
                            {{ $hit->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hit.fields.clinic') }}
                        </th>
                        <td>
                            {{ $hit->client->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hit.fields.date_time') }}
                        </th>
                        <td>
                            {{ $hit->date_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hit.fields.visit_type') }}
                        </th>
                        <td>
                            {{ $hit->visit_type->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hit.fields.duration_visit') }}
                        </th>
                        <td>
                            {{ $hit->duration_visit }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hit.fields.number_samples') }}
                        </th>
                        <td>
                            {{ $hit->number_samples }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hit.fields.address') }}
                        </th>
                        <td>
                            {{ $hit->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hit.fields.report_type') }}
                        </th>
                        <td>
                            {{ $hit->report_type }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hit.fields.category') }}
                        </th>
                        <td>
                            {{ $hit->category->name ??'' }}
                        </td>
                    </tr>
                    <tr>

                        <th>
                            {{ trans('cruds.hit.fields.report_status') }}
                        </th>
                        <td>
                            {{ $hit->report_status }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hit.fields.user') }}
                        </th>
                        <td>
                            {{ $hit->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hit.fields.note') }}
                        </th>
                        <td>
                            {{ $hit->note }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hit.fields.sms') }}
                        </th>
                        <td>
                            {{ $hit->sms->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hit.fields.sms_message') }}
                        </th>
                        <td>
                            {{ $hit->sms_message }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hit.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\Hit::TYPE_SELECT[$hit->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            العينات
                        </th>
                        <td>
                            <div class="row w-100">
                            @foreach($sample as $key => $s)
                                <div class="col-md-3">
                                    <div class="card border-info mx-sm-1 p-3">
                                        <div class="text-info text-center mt-3"><h4>{{ $s->samples->sample->name}}</h4></div>
                                        <div class="text-info text-center mt-2"><h1>{{ $s->quantity }}</h1></div>
                                    </div>
                                </div>
                            @endforeach
                            </div>
                        </td>
                    </tr>
                    {{-- <tr>
                        <th>
                            {{ trans('cruds.hit.fields.doctors') }}
                        </th>
                        <td>
                            @foreach($hit->doctors as $key => $doctors)
                                <span class="label label-info">{{ $doctors->doctor_name }}</span>
                            @endforeach
                        </td>
                    </tr> --}}
                    <tr>
                        <th>
                            {{ trans('cruds.hit.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Hit::STATUS_SELECT[$hit->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.hits.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
