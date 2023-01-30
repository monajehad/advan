@extends('layouts.cpanel.app')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.clinicsSpecialty.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.clinics-specialties.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.clinicsSpecialty.fields.id') }}
                        </th>
                        <td>
                            {{ $clinicsSpecialty->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.clinicsSpecialty.fields.name') }}
                        </th>
                        <td>
                            {{ $clinicsSpecialty->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.clinicsSpecialty.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\ClinicsSpecialty::STATUS_SELECT[$clinicsSpecialty->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.clinics-specialties.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
