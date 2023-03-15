	<!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Theme Styles(used by all pages)-->
		<link href="{{ asset("assets/plugins/global/plugins.bundle.css")}} "rel="stylesheet" type="text/css" />
        <link href="{{ asset("assets/plugins/custom/prismjs/prismjs.bundle.css")}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset("assets/css/style.bundle.rtl.css")}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('component_assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />

        <!--end::Global Theme Styles-->
        <!--begin::Layout Themes(used by all pages)-->
        <link href="{{ asset("assets/css/header/base/light.css")}} " rel="stylesheet" type="text/css" />
        <link href="{{ asset("assets/css/header/menu/light.css")}} " rel="stylesheet" type="text/css" />
        <link href="{{ asset("assets/css/brand/light.css")}} " rel="stylesheet" type="text/css" />
        <link href="{{ asset("assets/css/aside/light.css")}} " rel="stylesheet" type="text/css" />
            <!--end::Layout Themes-->
    <link href="{{asset('component_assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />

    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" /> --}}

    <!--end::Layout Themes-->
<style>
    .datatable.datatable-default.datatable-loaded {
    display: block;
    overflow-y: hidden;
}
div#table-vacation-requests_filter {
    display: none;
}
    @media (min-width: 992px){
.aside-enabled .header.header-fixed{
    right: 265px;
    left: 0;
}
.header-fixed.aside-minimize .header
 {
    right: 70px;
    left:0
}

.aside-enabled .header.header-fixed header.d-flex.align-items-center.px-xl-7.px-5.py-5 {
    right: 256;
    left: 0;
}
,.header-fixed.aside-minimize .header.header-fixed header.d-flex.align-items-center.px-xl-7.px-5.py-5 {
    right: 70px;
    left:0
}

    }

    .search-header .search-input .btn-command {

    right: -20px;
}

::before {

  right: 0 !important;

}
.stock-icon.ic2.p-3.rounded-circle.d-inline-block.mb-4 {
  background-color:  rgba(255, 165, 0, 0.15) !important;
}

.title.title-color.red.title-custom::before {
  width: 10px !important;
  height: 10px !important;
  border-radius: 50% !important;
  background-color:rgba(42, 133, 255, 0.85) !important;
}

@media (min-width: 992px){
.aside-fixed.aside-minimize:not(.aside-minimize-hover) .wrapper {
    padding-right: 70px;
    padding-left: 0;
}
.aside-fixed .wrapper {
    padding-right: 265px;
    padding-left: 0;

}
}
.page-body.pb-4.pb-xl-6 {
    background-color: #fcfcfc;
}

.card.mb-2.p-4.p-sm-5 {
    background-color: #fcfcfc;
}
.stock-item {
    width: 200px;
}

thead, tbody, tfoot, tr, td, th {
    border-color: #f5f5f5;
    border-style: solid;
    border-width: 2px;
    height: 4.5rem;
}
.table-bordered > :not(caption) > * > * {
    border-width: 0 1px;
    vertical-align: middle;
}

.modal-content {
    position: relative;
    display: flex;
    flex-direction: column;
    width: 100%;
    pointer-events: auto;
    background-color: #fafafa;
    background-clip: padding-box;
    border: 1px solid rgba(0, 0, 0, 0.2);
    border-radius: 8px;
    outline: 0;
}

.card.card-custom > .card-header .card-title, .card.card-custom > .card-header .card-title .card-label {
    font-weight: 600;
    font-size: 2.275rem;
    color: #0a0a0a;
}
body{
    background-color:#f4f4f4 !important;
}
.grey-bg{
    background-color:#f4f4f4;
}
.border-1 {
    border-width: 0px !important;
}

.modal-header {
    display: flex;
    flex-shrink: 0;
    align-items: center;
    justify-content: space-between;
    padding: 2rem 2rem;
    border-bottom: 1px solid #EFEFEF;
    border-top-left-radius: 7px;
    border-top-right-radius: 7px;
}

.modal .modal-header .modal-title {
    font-weight: 600;
    font-size: 1.5rem;
    color: #0a0a0a;
}


.table-striped tbody tr:nth-of-type(odd) {
    background-color: #f4f4f4;
}

</style>
