<div class="modal fade" id="add-competitor" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">إضافة منافس</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="fa fa-close"></i>
                </button>
            </div>
            <form class="form"
             {{-- action="
            {{route('competitor.store')}}
            " method="POST" --}}
             id="competitor-form">
              @csrf
                <input type="hidden" name="hidden" id="hidden">
            <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <label>الاسم <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control form-control-solid"/>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <label>البريد الالكتروني</label>
                            <input type="email" name="email" id="email" class="form-control form-control-solid"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <label>رقم الهاتف</label>
                            <input type="text" name="phone" id="phone" class="form-control form-control-solid"/>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <label>رقم الجوال</label>
                            <input type="number" name="mobile" id="mobile" class="form-control form-control-solid"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <label>العنوان</label>
                            <input type="text" name="address" id="address" class="form-control form-control-solid"/>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <label>اللون</label>
                            <input type="color" name="color" id="color" class="form-control form-control-solid"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 col-lg-6 col-sm-12 status-div">
                            <label>الحالة</label>
                            <span class="switch">
                                <label>
                                    <input type="checkbox" checked="checked" name="status" id="status">
                            <span></span>
                            </label>
                        </span>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit"  id="save"class="btn btn-primary">حفظ</button>

                <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
            </div>
            </form>
        </div>
    </div>
</div>
