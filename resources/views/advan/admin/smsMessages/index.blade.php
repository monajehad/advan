@extends('layouts.cpanel.app')



@section('content')
<!--begin::Container-->
<div class="container">
    <div class="card card-custom gutter-b">
        <!--begin::Header-->
        <div class="card-header border-1 py-4">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label font-weight-bolder text-dark">
               المسجات
                </span>
            </h3>
            <div class="card-toolbar">
     {{-- @can('sms_message_create') --}}
   <div style="margin-bottom: 10px;" class="row">
       <div class="col-lg-12">
           <a class="btn btn-success" href="{{ route('admin.sms-messages.create') }}">
               {{ trans('global.add') }} {{ trans('cruds.smsMessage.title_singular') }}
           </a>
       </div>
   </div>
{{--@endcan--}}

            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="row mt-4">
            <div class="col-md-4 col-lg-4 ml-8">
                <form class="form">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-sm" id="search_input" name="search_input"  placeholder="الاسم"/>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body py-0">
            <!--begin::Table-->
            <div class="users-table-body">  @includeIf('advan.admin.smsMessages.table-data')</div>

           <!--End::Table-->
        </div>
        <!--end::Body-->
    </div>

</div>
<!--end::Container-->
@endsection
