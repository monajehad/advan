<!DOCTYPE html>

<html lang="en" >
	<!--begin::Head-->
	<head>
		<title>تسجيل الدخول</title>
		<meta charset="utf-8" />
		<link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
		<link rel="shortcut icon" href="/metronic8/demo1/assets/media/logos/favicon.ico" />
		<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900;1000&display=swap" rel="stylesheet">
		<!--begin::Fonts(mandatory for all pages)-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
		<link href="{{asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('component_assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('component_assets/sass/_select.sass')}}" rel="stylesheet" type="text/css" />

<style>
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
</style>
		<!--end::Global Stylesheets Bundle-->
		<!--Begin::Google Tag Manager -->
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0], j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src= 'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f); })(window,document,'script','dataLayer','GTM-5FS8GGP');</script>
		<!--End::Google Tag Manager -->
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="app-blank" style="background: #E4E4E4">
		<!--begin::Theme mode setup on page load-->
		<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-theme-mode")) { themeMode = document.documentElement.getAttribute("data-theme-mode"); } else { if ( localStorage.getItem("data-theme") !== null ) { themeMode = localStorage.getItem("data-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-theme", themeMode); }</script>
		<!--end::Theme mode setup on page load-->
		<!--Begin::Google Tag Manager (noscript) -->
		<noscript>
			<iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5FS8GGP" height="0" width="0" style="display:none;visibility:hidden"></iframe>
		</noscript>
		<!--End::Google Tag Manager (noscript) -->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root" id="kt_app_root">
			<!--begin::Authentication - Sign-in -->
			<div class="d-flex flex-column flex-lg-row flex-column-fluid">
				<!--begin::Body-->
				<div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
					<!--begin::Form-->
					<div class="d-flex flex-center flex-column flex-lg-row-fluid">
					<!--begin::Wrapper-->
						<div class="w-lg-500px p-10 p-lg-15 mx-auto" dir="rtl">

							<!--begin::Form-->
							<form class="form w-100"  id="kt_sign_in_form" action="{{route('adminlogin')}}" method="post">
								@csrf
								<!--begin::Heading-->
								<div class="text-center mb-10">
									<!--begin::Title-->
									<h1 class="text-dark mb-3 ">تسجيل الدخول</h1>
									<!--end::Title-->
									<div class="separator separator-content my-14">
										<span class="w-125px text-gray-500 fw-semibold fs-7"></span>
									</div>
								</div>
								@if(session()->has('danger'))
							<div class="mb-2">
								<div class="font-weight-bold text-danger">{{session()->get('danger')}}</div>
</div>
							@endif
								<!--begin::Heading-->
								<!--begin::Input group-->
								<div class="fv-row mb-10">
									<!--begin::Label-->
									<label class="form-label fs-6 fw-bolder text-dark">رقم الجوال </label>
									<!--end::Label-->
									<!--begin::Input-->
									<input class="form-control form-control-lg form-control-solid" type="text" name="username" placeholder="رقم الجوال" autocomplete="off" />
									<!--end::Input-->
								</div>
								<!--end::Input group-->
								<!--begin::Input group-->
								<div class="fv-row mb-10">
									<!--begin::Wrapper-->
									<div class="d-flex flex-stack mb-2">
										<!--begin::Label-->
										<label class="form-label fw-bolder text-dark fs-6 mb-0">كلمة المرور</label>
										<!--end::Label-->
										<!--begin::Link-->
										<a href="{{ route('password.request') }}" class="link fs-6 fw-bolder" style="color: black">هل نسيت كلمة المرور؟</a>
										<!--end::Link-->
									</div>
									<!--end::Wrapper-->
									<!--begin::Input-->
									<input class="form-control form-control-lg form-control-solid" type="password"placeholder="كلمة السر" name="password"  />
									<!--end::Input-->
								</div>
								<!--end::Input group-->
								<!--begin::Actions-->
								<div class="text-center">
									<!--begin::Submit button-->

									<button type="submit" id="kt_sign_in_submit" class="btn btn-lg w-100 fw-bolder  my-2" style="background-color: #FFA500">
										<span class="indicator-label">تسجيل دخول</span>

									</button>
									<!--end::Submit button-->
									<div class="text-gray-700 mt-4 fw-bold fs-4" >ليس لديك حساب؟
										<a href="authentication/flows/aside/sign-up.html" class="link-dark fw-bolder" >انشاء حساب جديد</a></div>
								</div>
								<!--end::Actions-->
							</form>
							<!--end::Form-->
						</div>
						<!--end::Wrapper-->
					</div>
					<!--end::Form-->

				</div>
				<!--end::Body-->
				<!--begin::Aside-->
				<div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2" style="background-color:#1E2233 ">
					<!--begin::Content-->
					<div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">

						<!--begin::Image-->
						<img class="d-none d-lg-block mx-auto w-100px w-md-50 w-xl-300px mb-10 mb-lg-20" src="{{asset('assets\images\image_login.png')}}" alt="" />
						<!--end::Image-->


					</div>
					<!--end::Content-->
				</div>
				<!--end::Aside-->
			</div>
			<!--end::Authentication - Sign-in-->
		</div>

        <script src="{{asset('component_assets/js/charts.js')}}"></script>
        <script src="{{asset('component_assets/js/app.js')}}"></script>

        <script src="{{asset('assets/plugins/global/plugins.bundle.js')}}"></script>
        <script src="{{asset('assets/js/scripts.bundle.js')}}"></script>
            </body>

            <script>



            <!--end::Body-->
        </html>
