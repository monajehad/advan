@extends('layouts.cpanel.app')

@section('title')
العينات
@endsection
@section('style')
<style>
    .bootstrap-select > .dropdown-toggle.bs-placeholder.btn {
    color: #ffffff;
    background-color: #f4f4f4 !important;
}

#show-password,
#show-new-password,
#show-confirm-new-password {
    cursor: pointer;
}

.checkbox-cutom-label {
    font-size: 15px !important;
    font-weight: bold !important;
}
</style>
@endsection


@section('content')

<!--begin::Container-->
<div class="container">
    <div class="card card-custom gutter-b">
        <!--begin::Header-->
        <div class="card-header border-1 py-4 mx-5 mb-4">
            <h2 class="card-title align-items-start flex-column">

                طلبات العينات
            </h2>

            <div>

                {{-- @can('users-add') --}}
                <a data-toggle="modal" data-target="#add_button" class="btn btn-primary font-size-sm ml-3">
                    <span class="svg-icon svg-icon-md svg-icon-2x">
                        <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Code\Plus.svg--><svg
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                            height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24" />
                                <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10" />
                                <path
                                    d="M11,11 L11,7 C11,6.44771525 11.4477153,6 12,6 C12.5522847,6 13,6.44771525 13,7 L13,11 L17,11 C17.5522847,11 18,11.4477153 18,12 C18,12.5522847 17.5522847,13 17,13 L13,13 L13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 L11,13 L7,13 C6.44771525,13 6,12.5522847 6,12 C6,11.4477153 6.44771525,11 7,11 L11,11 Z"
                                    fill="#000000" />
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>
                    إضافة عينة
                </a>

                {{-- @endcan --}}
                <!--begin::Dropdown-->
                <div class="dropdown dropdown-inline mr-2 show">
                    <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <span class="svg-icon svg-icon-md">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"></rect>
                                    <path
                                        d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z"
                                        fill="#000000" opacity="0.3"></path>
                                    <path
                                        d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z"
                                        fill="#000000"></path>
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>تصدير</button>
                    <!--begin::Dropdown Menu-->
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right"
                        style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-62px, 39px, 0px);"
                        x-placement="bottom-end">
                        <!--begin::Navigation-->
                        <ul class="navi flex-column navi-hover py-2">
                            <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">
                                تصدير كـ:</li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-icon">
                                        <i class="la la-print"></i>
                                    </span>
                                    <span class="navi-text">طباعة</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-icon">
                                        <i class="la la-copy"></i>
                                    </span>
                                    <span class="navi-text">نسخ</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-icon">
                                        <i class="la la-file-excel-o"></i>
                                    </span>
                                    <span class="navi-text">إكسل</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-icon">
                                        <i class="la la-file-text-o"></i>
                                    </span>
                                    <span class="navi-text">CSV</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-icon">
                                        <i class="la la-file-pdf-o"></i>
                                    </span>
                                    <span class="navi-text">PDF</span>
                                </a>
                            </li>
                        </ul>
                        <!--end::Navigation-->
                    </div>
                    <!--end::Dropdown Menu-->
                </div>
                <!--end::Dropdown-->
            </div>
        </div>

        <div class="card-body py-0">

            <div class="mb-7">
                <div class="row align-items-center">
                    <div class="col-lg-9 col-xl-8">
                        <div class="row align-items-center">

                            <div class="col-md-3 my-2 my-md-0">
                                <div class="d-flex align-items-center">
                                    <select id="user_search" class=" form-control search_select" name="user_search">
                                       <option value="" selected>المندوب </option>

                                        @foreach($users as $user)
                                        {{-- @if(isset($sample->category)&&isset($sample->category->id)) --}}
                                        <option  value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 my-2 my-md-0">
                                <div class="d-flex align-items-center">
                                    <select id="category_search" class=" form-control search_select" name="category_search">
                                        <option value="" selected>عائلة الصنف </option>

                                        @foreach($samples as $sample)
                                        @if(isset($sample->category)&&isset($sample->category->id))
                                        <option  value="{{$sample->category->id}}">{{$sample->category->name}}</option>
                                       @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 my-2 my-md-0">
                                <div class="d-flex align-items-center">
                                    <select id="date_search" class=" form-control search_select" name="date_search">
                                        <option value="" selected>التاريخ  </option>

                                        @foreach($samples as $sample)

                                        <option  value="{{$sample->date}}">{{$sample->date}}</option>

                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!--begin::Table-->
            <div class="samples-table-body">

                @includeIf('advan.admin.samples.table-data')

            </div>

            <!--End::Table-->
        </div>
        <!--end::Body-->
    </div>



</div>
@includeIf('advan.admin.samples.create')
<!--end::Container-->
@endsection




{{-- <form method="get" action="{{url('admin/report')}}">
<div class="row">
    <div class="col-12 form-group">
        <label class="control-label" for="m">المندوب</label>
        <select class="form-control" name="user_name">
            <option value="">اختر مندوب</option>
            @foreach($users as $value)
            <option value="{{$value->id}}">{{$value->name}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="row">
    <div class="col-3 form-group">
        <label class="control-label" for="y">{{ trans('global.year') }}</label>
        <select name="y" id="y" class="form-control">
            @foreach(array_combine(range(date("Y"), 2000), range(date("Y"), 2000)) as $year)
            <option value="{{ $year }}" @if($year===old('y', Request::get('y', date('Y')))) selected @endif>
                {{ $year }}
            </option>
            @endforeach
        </select>
    </div>
    <div class="col-3 form-group">
        <label class="control-label" for="m">{{ trans('global.month') }}</label>
        <select name="m" for="m" class="form-control">
            @foreach(cal_info(0)['months'] as $month)
            <option value="{{ $month }}" @if($month===old('m', Request::get('m', date('F')))) selected @endif>
                {{ month()[$month] }}
            </option>
            @endforeach
        </select>
    </div>
    <div class="col-4">
        <label class="control-label">&nbsp;</label><br>
        <button class="btn btn-primary" type="submit">عرض التقرير</button>
    </div>
</div>


</form>
--}}

@section('script')
@parent


<script>

function load_data_table(page = '') {
    $.ajax({
        url: '{{url("admin/samples/")}}?page=' + page,
        data: {
            user: $('#user_search').val(),category: $('#category_search').val(),date: $('#date_search').val()
        },
        type: "get",
        success: function(response) {
            $('.samples-table-body').html(response.samples)

        },
        error: function(response) {}

    })
}

$(function () {

$('.search_select').on('change',function() {
            load_data_table()
        })
})



$(document).on('click', '.delete-sample', function() {
    var id = $(this).data('sample-id');
    Swal.fire({
        title: 'هل أنت متأكد من حذف  العينة',
        showDenyButton: true,
        confirmButtonText: 'نعم',
        denyButtonText: `لا`,
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{route("admin.samples.delete")}}',
                type: "POST",
                data: {
                    id: id
                },
                success: function(response) {
                    if (response.status == true) {
                        Swal.fire({
                            showCloseButton: true,
                            icon: 'success',
                            title: 'نجاح الحذف.',
                            text: response.success,
                            confirmButtonText: 'موافق'
                        })
                        load_data_table()
                    } else {
                        Swal.fire({
                            showCloseButton: true,
                            icon: 'error',
                            title: 'خطأ في الحذف',
                            text: response.error,
                            confirmButtonText: 'موافق'
                        })
                    }
                },
                error: function(response) {}
            })
        }
    })

})
</script>
@endsection
