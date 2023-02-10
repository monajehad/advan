<div class="modal fade" id="add-item" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">إضافة صنف</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="fa fa-close"></i>
                </button>
            </div>
            <form class="form"  id="item-form" >
                @csrf
                <input type="hidden" name="hidden" id="hidden">
            <div class="modal-body scroll_div">
                    <div class="form-group row">
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <label>رقم الصنف<span class="text-danger">*</span></label>
                            <input type="text" name="item_no" id="item_no" class="form-control"/>
                            <label class="form-text text-muted text-danger" id="item_no-error"></label>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <label>الاسم<span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control"/>
                            <label class="form-text text-muted text-danger" id="name-error"></label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <label>الوحدة</label>
                            <select class="form-control" id="unit" name="unit">
                                <option value="" disabled selected>اختر الوحدة</option>
                                @foreach($data['unit_select'] as $unit)
								    <option value="{{$unit->value}}">{{$unit->name}}</option>
								@endforeach
							</select>
                            <label class="form-text text-muted text-danger" id="unit-error"></label>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <label>الشكل الصيدلاني</label>
                            <select class="form-control" id="shape" name="shape">
                                <option value="" disabled selected>اختر الشكل</option>
                                @foreach($data['shape_select'] as $shape)
								    <option value="{{$shape->value}}">{{$shape->name}}</option>
								@endforeach
							</select>
                        </div>
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
                    <div class="form-group row">
                        <div class="col-md-12 col-lg-12 col-sm-12 h4 my-1 font-weight-bolder">الأسماء التجارية
                            <button class="btn btn-icon btn-xs btn-circle btn-success add-name" title="إضافة اسم تجاري"><i class="fa fa-plus"></i></button>
                        </div>
                        <div class="col-md-12 col-lg-12 mb-2">
                            <div class="separator separator-solid separator-border-1"></div>
                        </div>
                        <div class="col-md-12 col-lg-12 names-div row"></div>

                    </div>


            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="item-form" id="save-item" name="save-item">حفظ</button>

                <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="import-item-modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> إضافة صنف من ملف اكسل</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="fa fa-close"></i>
                </button>
            </div>
            <form class="form" id="item-import-form" method="post" enctype="multipart/form-data">

            <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 font-weight-bolder h3">
                            هيكلية ملف الاكسل <a href="{{route('item.download.excel')}}">
                                    <i class="fa fa-file-excel-o"></i>
                             </a>
                        </div>
                        <div class="col-md-12  my-2">
                            <table class="table table-bordered text-center">
                                <tr>
                                    <th>ItemNo</th>
                                    <th>name</th>
                                    <th>unit</th>
                                    <th>status</th>
                                    <th>tradeNames</th>
                                    <th>shape</th>
                                </tr>
                            </table>
                        </div>
                        <div class="row">
                            <ul>
                                <li>يجب أن تكون الحالة 0 أو 1 (status)</li>
                                <li>إذا كان للصنف أكثر من اسم تجاري أن يتم وضع  <span class="font-weight-bolder">/</span> بينهم (tradeNames)</li>
                                <li>أن تكون الوحدة على حسب الاسم الذي تم إضافته في ثوابت النظام (unit)</li>
                                <li>أن يكون الشكل على حسب الاسم الذي تم إضافته في ثوابت النظام (shape)</li>
                            </ul>
                        </div>
                    </div>

                    <div class="form-group row">

                        <div class="col-md-12 col-lg-12 col-sm-12">
                            <label>الملف</label>
                            <input type="file" name="file" id="file" class="form-control"/>

                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="import" name="import">إضافة</button>

                <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
            </div>
            </form>
        </div>
    </div>
</div>
