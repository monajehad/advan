<div class="modal fade" id="add-supplier" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">إضافة مورد</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="fa fa-close"></i>
                </button>
            </div>
            <form class="form"
            id="supplier-form"
              {{-- method="post"
             action="{{ route("supplier.store") }}"
               enctype="multipart/form-data" --}}
               >
              @csrf
                <input type="hidden" name="hidden" id="hidden">

            <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <label>الاسم بالعربي</label>
                            <input type="text" name="ar_name" id="ar_name" class="form-control form-control-solid"/>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <label>الاسم بالانجليزي</label>
                            <input type="text" name="en_name" id="en_name" class="form-control form-control-solid"/>
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
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <label>رقم الهاتف</label>
                            <input type="text" name="phone" id="phone" class="form-control form-control-solid"/>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <label>العنوان</label>
                            <input type="text" name="address" id="address" class="form-control form-control-solid"/>
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
                <button type="submit" class="btn btn-primary" name="save" id="save">حفظ</button>

                <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
            </div>
            </form>
        </div>
    </div>
</div>
