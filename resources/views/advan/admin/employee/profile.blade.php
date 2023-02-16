@extends('layouts.cpanel.app')

@section('page-css')
@endsection
@section('page-title')
الملف الشخصي
@endsection
@section('breadcrumb')
    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">الرئيسية</h5>
    <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
    <span class="text-muted font-weight-bold mr-4">الملف الشخصي
    </span>

@endsection
@section('page-content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-custom">
				<div class="card-header card-header-tabs-line">
					<div class="card-title">
						<h3 class="card-label font-weight-bold">الملف الشخصي</h3>
					</div>
				<div class="card-toolbar">
					<ul class="nav nav-tabs nav-bold nav-tabs-line">
						<li class="nav-item">
							<a class="nav-link {{(session()->has('pass_error')||session()->has('pass_success'))? '':'active'}}" data-toggle="tab" href="#kt_tab_pane_1_2">البيانات الشخصية</a>
						</li>
						<li class="nav-item">
							<a class="nav-link {{(session()->has('pass_error')||session()->has('pass_success'))? 'active':''}}" data-toggle="tab" href="#kt_tab_pane_2_2">تغيير كلمة المرور</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="card-body">
				<div class="tab-content">
					<div class="tab-pane fade {{(session()->has('pass_error')||session()->has('pass_success'))? '':'show active'}}" id="kt_tab_pane_1_2" role="tabpanel">

                        <form class="form" id="personal_form" method="post">
							<div class="form-group row">
							    <label class="col-xl-3 col-lg-3 col-form-label">الاسم</label>
								<div class="col-lg-9 col-xl-6">
									<input class="form-control form-control-lg form-control-solid" name="name" type="text" value="{{Auth::user()->name}}" disabled>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-xl-3 col-lg-3 col-form-label">البريد الإلكتروني</label>
								<div class="col-lg-9 col-xl-6">
									<input class="form-control form-control-lg form-control-solid" name="email" type="text" value="{{Auth::user()->email}}" disabled>
								</div>
							</div>
                            <div class="form-group row">
								<label class="col-xl-3 col-lg-3 col-form-label">رقم الجوال</label>
								<div class="col-lg-9 col-xl-6">
									<input class="form-control form-control-lg form-control-solid" name="mobile" type="text" value="{{Auth::user()->mobile}}" disabled>
								</div>
							</div>

						</form>
                    </div>
					<div class="tab-pane fade {{(session()->has('pass_error')||session()->has('pass_success'))? 'show active':''}}" id="kt_tab_pane_2_2" role="tabpanel">
                    @if(session()->has('pass_error'))
                        <div class="alert alert-custom alert-light-danger fade show mb-5" role="alert">
                            <div class="alert-icon">
                                <i class="fa fa-exclamation-triangle"></i>
                            </div>
                            <div class="alert-text">{{session('pass_error')}}</div>
                            <div class="alert-close">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">
                                        <i class="fa fa-close"></i>
                                    </span>
                                </button>
                            </div>
                        </div>
                        @endif
                        @if(session()->has('pass_success'))
                        <div class="alert alert-custom alert-light-success fade show mb-5" role="alert">
                            <div class="alert-icon">
                                <i class="fa fa-check"></i>
                            </div>
                            <div class="alert-text">{{session('pass_success')}}</div>
                            <div class="alert-close">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">
                                        <i class="fa fa-close"></i>
                                    </span>
                                </button>
                            </div>
                        </div>
                        @endif
                        <form class="form" id="password_form" method="post" action="{{route('user.password')}}">
							@csrf
                            <div class="form-group row">
							    <label class="col-xl-3 col-lg-3 col-form-label">كلمة السر</label>
								<div class="col-lg-9 col-xl-6">
									<input class="form-control form-control-lg form-control-solid" type="password" name="old_pass" value="{{old('old_pass')}}">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-xl-3 col-lg-3 col-form-label">كلمة السر الجديدة</label>
								<div class="col-lg-9 col-xl-6">
									<input class="form-control form-control-lg form-control-solid" type="password" name="new_pass" id="new_pass" value="{{old('new_pass')}}">
								</div>
							</div>
                            <div class="form-group row">
								<label class="col-xl-3 col-lg-3 col-form-label">تأكيد كلمة السر</label>
								<div class="col-lg-9 col-xl-6">
									<input class="form-control form-control-lg form-control-solid" type="password" name="conf_pass" value="{{old('conf_pass')}}">
								</div>
							</div>
                            <div class="form-group row">
                                <div class="col-lg-12 col-md-12 text-center">
                                    <button type="submit" class="btn btn-success mr-2"> حفظ</button>
                                </div>
							</div>
						</form>

                    </div>
					</div>
				</div>
			</div>
        </div>
    </div>
</div>
@endsection
@section('page-js')

<script>
    $(function() {
        $('#password_form').validate({
            rules:{
                old_pass:{
                    required: true,
                },
                new_pass:{
                    required: true,
                },
                conf_pass:{
                    required: true,
                    equalTo:"#new_pass"
                },

            },
            messages: {
                old_pass:{
                    required: "يجب إدخال كلمة السر الحالية",
                },
                new_pass:{
                    required: "يجب إدخال كلمة السر الجديدة",
                },
                conf_pass:{
                    required: "يجب إدخال تأكيد كلمة السر الجديدة",
                    equalTo:"كلمة السر و تأكيدها غير متطابقتان"

                },
            },
            submitHandler:function(form){
                form.submit();
            }
    })
    })
</script>
@endsection
