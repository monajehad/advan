<div class="modal fade" id="add-user" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">إضافة مستخدم</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-primary svg-icon-2x">
                        <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Navigation\Close.svg--><svg
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                            height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)"
                                    fill="#000000">
                                    <rect x="0" y="7" width="16" height="2" rx="1" />
                                    <rect opacity="0.3"
                                        transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000) "
                                        x="0" y="7" width="16" height="2" rx="1" />
                                </g>
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>

                </button>
            </div>
            <form class="form" id="user-form" {{-- method="post" action="{{route('admin.employee.store')}}" --}}>
                @csrf

                <div class="form-group">
                    <label>Email address
                        <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" placeholder="Enter email">
                    <span class="form-text text-muted">We'll never share your email with anyone else.</span>
                </div>

                <input type="hidden" name="hidden" id="hidden">
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <label>الاسم بالكامل</label>
                            <input type="text" name="name" id="name" class="form-control form-control-solid" />
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <label>اسم المستخدم</label>
                            <input type="text" name="username" id="username" class="form-control form-control-solid" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <label>البريد الالكتروني</label>
                            <input type="email" name="email" id="email" class="form-control form-control-solid" />
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <label>رقم الجوال</label>
                            <input type="phone" name="mobile" id="mobile" class="form-control form-control-solid" />
                        </div>
                        <div class="form-group">
                            <label>كلمةالمرور</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button class="btn btn-primary" type="button" id="show-password">
                                        <span class="svg-icon svg-icon-primary svg-icon-2x">
                                            <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Hidden.svg--><svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                    <path
                                                        d="M19.2078777,9.84836149 C20.3303823,11.0178941 21,12 21,12 C21,12 16.9090909,18 12,18 C11.6893441,18 11.3879033,17.9864845 11.0955026,17.9607365 L19.2078777,9.84836149 Z"
                                                        fill="#000000" fill-rule="nonzero" />
                                                    <path
                                                        d="M14.5051465,6.49485351 L12,9 C10.3431458,9 9,10.3431458 9,12 L5.52661464,15.4733854 C3.75006453,13.8334911 3,12 3,12 C3,12 5.45454545,6 12,6 C12.8665422,6 13.7075911,6.18695134 14.5051465,6.49485351 Z"
                                                        fill="#000000" fill-rule="nonzero" />
                                                    <rect fill="#000000" opacity="0.3"
                                                        transform="translate(12.524621, 12.424621) rotate(-45.000000) translate(-12.524621, -12.424621) "
                                                        x="3.02462111" y="11.4246212" width="19" height="2" />
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                    </button>
                                </div>
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="كلمة المرور">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 col-lg-6 col-sm-12 password-div">
                            <label>كلمة السر</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="show-password">
                                        <i class="fa fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <?php


                    $roles = App\Models\Role::where('id' , '!=' , 2)->pluck('title', 'id');

                   ?>
                        <div class="form-group">
                            <label class="required" for="roles">{{ trans('cruds.user.fields.roles') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all"
                                    style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all"
                                    style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select {{ $errors->has('roles') ? 'is-invalid' : '' }}"
                                name="roles[]" id="roles" multiple required>
                                @foreach($roles as $id => $role)
                                <option value="{{ $id }}" {{ in_array($id, old('roles', [])) ? 'selected' : '' }}>
                                    {{ $role }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('roles'))
                            <div class="invalid-feedback">
                                {{ $errors->first('roles') }}
                            </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.roles_helper') }}</span>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 col-lg-6 col-sm-12 status-div">
                                <label>الحالة</label>
                                <span class="switch">
                                    <label>
                                        <input type="checkbox" checked="checked" name="status" id="status" value="1">
                                        <span></span>
                                    </label>
                                </span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" id="save" class="btn btn-primary">حفظ</button>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="change-password-modal" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">تغيير كلمة سر المستخدم</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="fa fa-close"></i>
                </button>
            </div>
            <form class="form" action="" id="change-password-form">
                <input type="hidden" id="employee_id" name="employee_id">
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label>كلمة السر الجديدة</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="new_password" name="new_password">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="show-new-password">
                                        <i class="fa fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label>تأكيد كلمة السر</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="confirm_new_password"
                                    name="confirm_new_password">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="show-confirm-new-password">
                                        <i class="fa fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="change">تغيير</button>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                </div>
            </form>
        </div>
    </div>
</div>




