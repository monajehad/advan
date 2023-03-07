
@extends('layouts.cpanel.app')
@section('content')

<div class="card w-50 mr-10 overflow-auto " style="height: 370px">
    <div class="card-header  d-flex justify-content-between ">
        <div class="py-5 h3">تعديل  نوع العميل </div>
        <div class="form-group text-left  mb-0 py-3">
            <a href="{{route("admin.clients-specialties.index")}}"
                class="btn btn-primary " type="submit">
                الرجوع
        </a>
        </div>
    </div>



    <div class="card-body">
        <form method="POST" action="{{ route("admin.clients-specialties.update", [$clientsSpecialty->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">اسم نوع العميل</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $clientsSpecialty->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <?php if($clientsSpecialty->status=='1')
                $clientsSpecialty->status='on';
                ?>
                <div class="col-md-6 col-lg-6 col-sm-12 status-div">
                    <label>الحالة</label>
                    <span class="switch">
                        <label>
                            <input type="checkbox"   {{$clientsSpecialty->status ? 'checked' : ''}} name="status" id="status">
                            <span></span>
                        </label>
                    </span>
                </div>

                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
            </div>
            <div class="form-group text-left">
                <button class="btn btn-primary w-50" type="submit">
                    حفظ
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
