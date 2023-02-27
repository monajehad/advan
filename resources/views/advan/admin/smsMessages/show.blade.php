@extends('layouts.cpanel.app')

@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.smsMessage.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sms-messages.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.smsMessage.fields.id') }}
                        </th>
                        <td>
                            {{ $smsMessage->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.smsMessage.fields.title') }}
                        </th>
                        <td>
                            {{ $smsMessage->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.smsMessage.fields.message') }}
                        </th>
                        <td>
                            {{ $smsMessage->message }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.smsMessage.fields.user') }}
                        </th>
                        <td>
                            {{ $smsMessage->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.smsMessage.fields.doctor') }}
                        </th>
                        <td>
                            {{ $smsMessage->doctor->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.smsMessage.fields.status') }}
                        </th>
                        <td>
                            {{ $smsMessage->status }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sms-messages.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
