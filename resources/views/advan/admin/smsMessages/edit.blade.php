@extends('layouts.cpanel.app')

@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.smsMessage.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.sms-messages.update", [$smsMessage->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.smsMessage.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $smsMessage->title) }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.smsMessage.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="message">{{ trans('cruds.smsMessage.fields.message') }}</label>
                <textarea class="form-control {{ $errors->has('message') ? 'is-invalid' : '' }}" name="message" id="message">{{ old('message', $smsMessage->message) }}</textarea>
                @if($errors->has('message'))
                    <div class="invalid-feedback">
                        {{ $errors->first('message') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.smsMessage.fields.message_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.smsMessage.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $smsMessage->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.smsMessage.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="doctor_id">{{ trans('cruds.smsMessage.fields.doctor') }}</label>
                <select class="form-control select2 {{ $errors->has('doctor') ? 'is-invalid' : '' }}" name="doctor_id" id="doctor_id">
                    @foreach($doctors as $id => $entry)
                        <option value="{{ $id }}" {{ (old('doctor_id') ? old('doctor_id') : $smsMessage->doctor->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('doctor'))
                    <div class="invalid-feedback">
                        {{ $errors->first('doctor') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.smsMessage.fields.doctor_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="status">{{ trans('cruds.smsMessage.fields.status') }}</label>
                <input class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" type="text" name="status" id="status" value="{{ old('status', $smsMessage->status) }}">
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.smsMessage.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
