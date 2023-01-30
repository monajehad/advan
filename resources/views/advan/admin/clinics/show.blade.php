@extends('layouts.cpanel.app')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.clinic.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.clinics.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.clinic.fields.id') }}
                        </th>
                        <td>
                            {{ $clinic->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.clinic.fields.name') }}
                        </th>
                        <td>
                            {{ $clinic->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.clinic.fields.doctor_name') }}
                        </th>
                        <td>
                            {{ $clinic->doctor_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.clinic.fields.specialty') }}
                        </th>
                        <td>
                            {{ $clinic->specialty->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.clinic.fields.image') }}
                        </th>
                        <td>
                            @if($clinic->image)
                                <a href="{{ $clinic->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $clinic->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.clinic.fields.email') }}
                        </th>
                        <td>
                            {{ $clinic->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.clinic.fields.phone') }}
                        </th>
                        <td>
                            {{ $clinic->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.clinic.fields.clinic_phone') }}
                        </th>
                        <td>
                            {{ $clinic->clinic_phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.clinic.fields.address_1') }}
                        </th>
                        <td>
                            {{ $clinic->address_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.clinic.fields.address_2') }}
                        </th>
                        <td>
                            {{ $clinic->address_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.clinic.fields.address_3') }}
                        </th>
                        <td>
                            {{ $clinic->address_3 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.clinic.fields.latitude') }}
                        </th>
                        <td>
                            {{ $clinic->latitude }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.clinic.fields.longitude') }}
                        </th>
                        <td>
                            {{ $clinic->longitude }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.clinic.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Clinic::STATUS_SELECT[$clinic->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.clinics.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#clinic_hits" role="tab" data-toggle="tab">
                {{ trans('cruds.hit.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="clinic_hits">
            @includeIf('admin.clinics.relationships.clinicHits', ['hits' => $clinic->clinicHits])
        </div>
    </div>
</div>

@endsection
