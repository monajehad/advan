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


    <!--end::Layout Themes-->
<style>
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
</style>
