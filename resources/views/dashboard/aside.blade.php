<!--begin::Aside-->
<div id="kt_aside" class="aside pb-5 pt-5 pt-lg-0" data-kt-drawer="true" data-kt-drawer-name="aside"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
    data-kt-drawer-width="{default:'80px', '300px': '100px'}" data-kt-drawer-direction="start"
    data-kt-drawer-toggle="#kt_aside_mobile_toggle">
    <!--begin::Brand-->
    <div class="aside-logo py-8" id="kt_aside_logo">
        <!--begin::Logo-->
        <a href="{{route('page.home')}}" class="d-flex align-items-center">
            <img alt="Logo" src="{{asset('assets/media/logos/logo-demo-6.svg')}}" class="h-45px logo" />
        </a>
        <!--end::Logo-->
    </div>
    <!--end::Brand-->

    @if(Auth::guard('admin')->check())
    <!--begin::Aside menu-->
    <div class="aside-menu flex-column-fluid" id="kt_aside_menu">
        <!--begin::Aside Menu-->
        <div class="hover-scroll-overlay-y my-2 my-lg-5 pe-lg-n1" id="kt_aside_menu_wrapper" data-kt-scroll="true"
            data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer"
            data-kt-scroll-wrappers="#kt_aside, #kt_aside_menu" data-kt-scroll-offset="5px">
            <!--begin::Menu-->
            <div class="menu menu-column menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500 fw-bold"
                id="#kt_aside_menu" data-kt-menu="true">
                <div class="menu-item py-2">
                    <a class="menu-link active menu-center" href="{{route('page.home')}}" data-bs-trigger="hover"
                        data-bs-dismiss="click" data-bs-placement="right">
                        <span class="menu-icon me-0">
                            <i class="bi bi-house fs-2"></i>
                        </span>
                        <span class="menu-title">{{__("site.home")}}</span>
                    </a>
                </div>

                <div class="menu-item py-2">
                    <a class="menu-link menu-center" href="{{route('compound.all')}}" data-bs-trigger="hover"
                        data-bs-dismiss="click" data-bs-placement="right">
                        <span class="menu-icon me-0">
                            <i class="bi bi-shield-check fs-2"></i>
                        </span>
                        <span class="menu-title">{{__("site.estates")}}</span>
                    </a>
                </div>

                <div class="menu-item py-2">
                    <a class="menu-link menu-center" href="{{route('tenant.all')}}" data-bs-trigger="hover"
                        data-bs-dismiss="click" data-bs-placement="right">
                        <span class="menu-icon me-0">
                            <i class="bi bi-people fs-2"></i>
                        </span>
                        <span class="menu-title">{{__("site.tenants")}}</span>
                    </a>
                </div>

                <div class="menu-item py-2">
                    <a class="menu-link menu-center" href="{{route('finance.index')}}" data-bs-trigger="hover"
                        data-bs-dismiss="click" data-bs-placement="right">
                        <span class="menu-icon me-0">
                            <i class="bi bi-cash-coin"></i>
                        </span>
                        <span class="menu-title">{{__("site.finance")}}</span>
                    </a>
                </div>

            </div>
            <!--end::Menu-->
        </div>
        <!--end::Aside Menu-->
    </div>
    <!--end::Aside menu-->


    @elseif(Auth::guard('owner')->check())


    <!--begin::Aside menu-->
    <div class="aside-menu flex-column-fluid" id="kt_aside_menu">
        <!--begin::Aside Menu-->
        <div class="hover-scroll-overlay-y my-2 my-lg-5 pe-lg-n1" id="kt_aside_menu_wrapper" data-kt-scroll="true"
            data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer"
            data-kt-scroll-wrappers="#kt_aside, #kt_aside_menu" data-kt-scroll-offset="5px">
            <!--begin::Menu-->
            <div class="menu menu-column menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500 fw-bold"
                id="#kt_aside_menu" data-kt-menu="true">
                <div class="menu-item py-2">
                    <a class="menu-link active menu-center" href="{{route('page.home')}}" data-bs-trigger="hover"
                        data-bs-dismiss="click" data-bs-placement="right">
                        <span class="menu-icon me-0">
                            <i class="bi bi-house fs-2"></i>
                        </span>
                        <span class="menu-title">{{__("site.home")}}</span>
                    </a>
                </div>

                <div class="menu-item py-2">
                    <a class="menu-link menu-center" href="{{route('compound.index')}}" data-bs-trigger="hover"
                        data-bs-dismiss="click" data-bs-placement="right">
                        <span class="menu-icon me-0">
                            <i class="bi bi-shield-check fs-2"></i>
                        </span>
                        <span class="menu-title">{{__("site.estates")}}</span>
                    </a>
                </div>

                <div class="menu-item py-2">
                    <a class="menu-link menu-center" href="{{route('tenant.index')}}" data-bs-trigger="hover"
                        data-bs-dismiss="click" data-bs-placement="right">
                        <span class="menu-icon me-0">
                            <i class="bi bi-people fs-2"></i>
                        </span>
                        <span class="menu-title">{{__("site.tenants")}}</span>
                    </a>
                </div>

                <div class="menu-item py-2">
                    <a class="menu-link menu-center" href="{{route('finance.index')}}" data-bs-trigger="hover"
                        data-bs-dismiss="click" data-bs-placement="right">
                        <span class="menu-icon me-0">
                            <i class="bi bi-cash-coin"></i>
                        </span>
                        <span class="menu-title">{{__("site.finance")}}</span>
                    </a>
                </div>

                {{-- <div data-kt-menu-trigger="click" data-kt-menu-placement="right-start" class="menu-item py-2">
                    <span class="menu-link menu-center" data-bs-trigger="hover" data-bs-dismiss="click"
                        data-bs-placement="right">
                        <span class="menu-icon me-0">
                            <i class="bi bi-shield-check fs-2"></i>
                        </span>
                        <span class="menu-title">{{__("site.estates")}}</span>
                    </span>
                    <div class="menu-sub menu-sub-dropdown w-225px px-1 py-4">
                        <div class="menu-item">
                            <a class="menu-link" href="{{route('compound.index')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{__('site.compounds')}}</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link" href="{{route('building.index')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{__('site.building')}}</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link" href="{{route('compound.index')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{__('site.apartments')}}</span>
                            </a>
                        </div>

                    </div>
                </div> --}}
            </div>
            <!--end::Menu-->
        </div>
        <!--end::Aside Menu-->
    </div>
    <!--end::Aside menu-->

    @endif
</div>
<!--end::Aside-->
