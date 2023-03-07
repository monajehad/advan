@extends('layouts.cpanel.app')
@section('content')

<div class="card w-50 mr-10">
    <div class="card-header  d-flex justify-content-between ">
        <div class="py-5 h3">تعديل الصلاحية </div>
        <div class="form-group text-left  mb-0 py-3">
            <a href="{{route("admin.permissions.index")}}" class="btn btn-primary " type="submit">
                الرجوع
            </a>
        </div>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route("admin.permissions.update", [$permission->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="title">عنوان الصلاحية</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $permission->title) }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="name">اسم الصلاحية</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $permission->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
            </div>
            <div class="form-group text-center ">
                <button class="btn btn-primary w-50" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
