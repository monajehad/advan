
<div class="modal fade" id="user-permission-modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">صلاحيات المستخدم</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="fa fa-close"></i>
                </button>
            </div>
            <form class="form" action="" id="user-permission-form">
                <div class="modal-body permission-modal-body">
                    <div class="form-group row">
                        @if(isset($data))
                        <input type="hidden" name="user" id="user" value="{{$data['user']}}">

                            @foreach($data['permissions'] as $key=>$permission)
                            <div class="col-mg-12 col-lg-12 py-1 font18 font-weight-bolder">
                                    @switch($key)
                                        @case(1)
                                        المستخدمون
                                        @break
                                        @case(2)
                                        الأصناف
                                        @break
                                        @case(3)
                                        العملاء
                                        @break
                                        @case(4)
                                        الموردون
                                        @break
                                        @case(5)
                                        المندوبون
                                        @break
                                        @case(6)
                                        المنافسون
                                        @break
                                        @case(7)
                                        ثوابت النظام
                                        @break
                                        @case(8)
                                        المناقصات
                                        @break
                                        @case(9)
                                        الإعدادات    
                                        @break
                                        @case(10)
                                       التقارير  
                                        @break
                                      
                                    @endswitch
                                    </div>
                               
                                <div class="col-md-12 col-lg-12 mb-2">
                                    <div class="separator separator-solid separator-border-1"></div>
                                </div>
                                <div class="checkbox-inline col-md-12 col-lg-12">
                                    <div class="row">
                                @foreach($permission as $permission_data)
                                        <label class="checkbox checkbox-info col-md-3 col-lg-3">
                                            <input type="checkbox" name="permissions[]" value="{{$permission_data['id']}}" {{(in_array($permission_data['id'],$data['user_permissions']))? 'checked':''}}>
                                            <span></span>{{$permission_data['ar_name']}}
                                        </label>
                                @endforeach
                                    </div>
                                </div>

                               
                            @endforeach
                        @endif
                    </div>
                </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">حفظ</button>

                <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
            </div>
            </form>
        </div>
    </div>
</div>
