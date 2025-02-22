
<style>
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
    .modal-content {
    position: relative;
    display: flex;
    flex-direction: column;
    width: 480px !important;
    height: 100vh;
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
</style>


<div class="modal fade modal-lg" id="add-competitor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">إضافة  منافس</h5>
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
            <form id="competitor-form">
                @csrf
                  <input type="hidden" name="hidden" id="hidden">
                <div class="card-body">
                    <div class="form-group">
                        <label>الاسم <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control"/>

                    </div>
                    <div class="form-group">
                        <label>البريد الالكتروني</label>
                        <input type="email" name="email" id="email" class="form-control "/>

                    </div>
                    <div class="form-group">
                        <label>رقم الهاتف</label>
                        <input type="text" name="phone" id="phone" class="form-control "/>

                    </div>
                    <div class="form-group">
                        <label>رقم الجوال</label>
                        <input type="number" name="mobile" id="mobile" class="form-control "/>

                    </div>
                    <div class="form-group">
                        <label>العنوان</label>
                        <input type="text" name="address" id="address" class="form-control "/>

                    </div>
                    {{-- <div class="form-group">
                        <label>اللون</label>
                        <input type="color" name="color" id="color" class="form-control "/>

                    </div> --}}

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
                        <button type="submit"  id="save"class="btn btn-primary">حفظ</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                    </div>



            </form>


        </div>
    </div>
</div>
