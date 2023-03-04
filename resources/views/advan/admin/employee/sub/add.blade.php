
<style>
    .modal-content {
    position: relative;
    display: flex;
    flex-direction: column;
    width: 480px !important;
    height: 100vh !important;
    top: -20px;
    pointer-events: auto;
    background-color: #fafafa;
    background-clip: padding-box;
    border: 1px solid rgba(0, 0, 0, 0.2);
    border-radius: 0;
    outline: 0;
}

.image-input .image-input-wrapper {
    width: 100px;
    height: 100px;
    margin-bottom: 15px;
    border-radius: 0.42rem;
    background-repeat: no-repeat;
    background-size: cover;
}

.modal {
    position: fixed;
    top: 0;
    left: -122px;
    z-index: 1055;
    display: none;
    width: 100%;
    height: 100%;
    overflow-x: hidden;
    overflow-y: auto;
    outline: 0;
}
</style>


<div class="modal fade modal-lg" id="add-user" data-backdrop="static" tabindex="-1" role="dialog"
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
            <form>
                <div class="card-body">

                    <div class="image-input image-input-outline image-input-circle align-center" id="kt_image_3">
                        <div class="image-input-wrapper" style="background-image: url(assets/media/users/100_3.jpg)">
                        </div>

                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                            data-action="change" data-toggle="tooltip" title="" data-original-title="تعديل الصورة">
                            <span class="svg-icon svg-icon-primary svg-icon-2x">
                                <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Design\Edit.svg--><svg
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <path
                                            d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z"
                                            fill="#000000" fill-rule="nonzero"
                                            transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) " />
                                        <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1" />
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                            <input type="file" name="profile_avatar" accept=".png, .jpg, .jpeg" />
                            <input type="hidden" name="profile_avatar_remove" />
                        </label>

                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                            data-action="cancel" data-toggle="tooltip" title="حذف الصورة">

                            <span class="svg-icon svg-icon-primary svg-icon-2x">
                                <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Navigation\Close.svg--><svg
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
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
                        </span>
                    </div>

                    <div class="form-group">
                        <label>الإسم ثلاثي <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" placeholder="محمد أحمد عبدالله" />
                    </div>

                    <div class="form-group">
                        <label> اسم المستخدم <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" placeholder="malik" />
                    </div>
                    <div class="form-group">
                        <label for="exampleSelect1">الصلاحيات <span class="text-danger">*</span></label>
                        <select class="form-control" id="exampleSelect1">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">كلمة المرور <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="exampleInputPassword1"
                            placeholder="كلمة المرور" />
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">تأكيد كلمة المرور <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="exampleInputPassword1"
                            placeholder="تأكيد كلمة المرور" />
                    </div>

                    <div class="form-group">
                        <label>البريد الإلكرتوني <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" placeholder="mail@example.com" />
                    </div>
                    <div class="form-group">
                        <label> رقم الجوال <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" placeholder="0500 000 000" />
                    </div>



                </div>
                <div class="card-footer">
                    <button type="submit" id="save" class="btn btn-primary">حفظ</button>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                </div>
            </form>
            <!-- <form class="form" id="user-form" {{-- method="post" action="{{route('admin.employee.store')}}" --}}>
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
                                           <svg
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
            </form> -->

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

<!-- New User Form -->
<!-- <form>
    <div class="card-body">

        <div class="image-input image-input-outline image-input-circle" id="kt_image_3">
            <div class="image-input-wrapper" style="background-image: url(assets/media/users/100_3.jpg)"></div>

            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                data-action="change" data-toggle="tooltip" title="" data-original-title="تعديل الصورة">
                <i class="fa fa-pen icon-sm text-muted"></i>
                <input type="file" name="profile_avatar" accept=".png, .jpg, .jpeg" />
                <input type="hidden" name="profile_avatar_remove" />
            </label>

            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                data-action="cancel" data-toggle="tooltip" title="حذف الصورة">
                <i class="ki ki-bold-close icon-xs text-muted"></i>
            </span>
        </div>

        <div class="form-group">
            <label>الإسم ثلاثي <span class="text-danger">*</span></label>
            <input type="email" class="form-control" placeholder="محمد أحمد عبدالله" />
        </div>

        <div class="form-group">
            <label> اسم المستخدم <span class="text-danger">*</span></label>
            <input type="email" class="form-control" placeholder="malik" />
        </div>
    <div class="form-group">
            <label for="exampleSelect1">الصلاحيات <span class="text-danger">*</span></label>
            <select class="form-control" id="exampleSelect1">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">كلمة المرور <span class="text-danger">*</span></label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="كلمة المرور" />
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">تأكيد كلمة المرور <span class="text-danger">*</span></label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="تأكيد كلمة المرور" />
        </div>

        <div class="form-group">
            <label>البريد الإلكرتوني <span class="text-danger">*</span></label>
            <input type="email" class="form-control" placeholder="mail@example.com" />
        </div>
        <div class="form-group">
            <label> رقم الجوال <span class="text-danger">*</span></label>
            <input type="email" class="form-control" placeholder="0500 000 000" />
        </div>

        

    </div>
    <div class="card-footer">
        <button type="submit" id="save" class="btn btn-primary">حفظ</button>

        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
    </div>
</form> -->
<!--end::Form-->




<script>
var avatar3 = new KTImageInput('kt_image_3');
</script>