
<style>
    .modal-content {
    position: relative;
    display: flex;
    flex-direction: column;
    width: 480px !important;
    height:100vh;
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
    height: 100vh;
    overflow-x: hidden;
    overflow-y: auto;
    outline: 0;
}

.modal.show .modal-dialog {
    -webkit-transform: none;
    transform: none;
    height: 100vh;
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
            <form class="form" id="user-form"  >
                @csrf
                <input type="hidden" name="hidden" id="hidden">
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
                        <input type="text" name="name" id="name"  class="form-control"  />
                    </div>

                    <div class="form-group">
                        <label> اسم المستخدم <span class="text-danger">*</span></label>
                        <input type="text" name="username" id="username" class="form-control"  />
                    </div>
                    <?php


                    $roles = App\Models\Role::where('id' , '!=' , 2)->pluck('title', 'id');

                   ?>
                    <div class="form-group">
                        <label for="exampleSelect1">الصلاحيات <span class="text-danger">*</span></label>

                        <select class="form-control"  {{ $errors->has('roles') ? 'is-invalid' : '' }}
                            name="roles[]" id="roles " multiple required >
                      @foreach($roles as $id => $role)
                            <option value="{{ $id }}" {{ in_array($id, old('roles', [])) ? 'selected' : '' }}>
                                {{ $role  }}</option>
                        @endforeach

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1" id="show-password">كلمة المرور <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" type="password" name="password" id="password"
                            placeholder="كلمة المرور" />
                    </div>


                    <div class="form-group">
                        <label>البريد الإلكرتوني <span class="text-danger">*</span></label>
                        <input type="email" name="email" id="email" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label> رقم الجوال <span class="text-danger">*</span></label>
                        <input type="text" name="mobile" id="mobile" class="form-control" />
                    </div>

                </div>
                    <div class="card-footer">
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





<script>
var avatar3 = new KTImageInput('kt_image_3');
</script>
