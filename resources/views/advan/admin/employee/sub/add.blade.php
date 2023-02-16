<div class="modal fade" id="add-user" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">إضافة مستخدم</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="fa fa-close"></i>
                </button>
            </div>
            <form class="form" id="user-form"
            {{-- method="post" action="{{route('admin.employee.store')}}" --}}
            >
              @csrf

                <input type="hidden" name="hidden" id="hidden">
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <label>الاسم بالكامل</label>
                        <input type="text" name="name" id="name" class="form-control form-control-solid"/>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <label>اسم المستخدم</label>
                        <input type="text" name="username" id="username" class="form-control form-control-solid"/>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <label>البريد الالكتروني</label>
                        <input type="email" name="email" id="email" class="form-control form-control-solid"/>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <label>رقم الجوال</label>
                        <input type="number" name="mobile" id="mobile" class="form-control form-control-solid"/>
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
                            <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                            <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                        </div>
                        <select class="form-control select {{ $errors->has('roles') ? 'is-invalid' : '' }}" name="roles[]" id="roles" multiple required>
                            @foreach($roles as $id => $role)
                                <option value="{{ $id }}" {{ in_array($id, old('roles', [])) ? 'selected' : '' }}>{{ $role }}</option>
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

<div class="modal fade" id="change-password-modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
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
							<input type="password" class="form-control" id="confirm_new_password" name="confirm_new_password">
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

