<style>
    .modal-content {
    position: relative;
    display: flex;
    flex-direction: column;
    width: 480px !important;

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


<div class="modal fade modal-lg" id="add-constant" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">إضافة ثابت نظام</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="fa fa-close"></i>
                </button>
            </div>
            <form class="form" action="" id="constant-form">
                <input type="hidden" name="hidden" id="hidden">
            <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <label>الاسم<span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control form-control-solid"/>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <label>نوع الثابت<span class="text-danger">*</span></label>

                            <select class="form-control" id="type" name="type">
                            <option value="" selected disabled>اختر النوع</option>
								@foreach($data['system_constants'] as $constant)
                                        <option value="{{$constant->value2}}">{{$constant->name}}</option>
                                @endforeach
							</select>
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
            <div class="card-footer">
                <button type="submit" id="save" class="btn btn-primary">حفظ</button>

                <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
            </div>
            </form>
        </div>
    </div>
</div>


