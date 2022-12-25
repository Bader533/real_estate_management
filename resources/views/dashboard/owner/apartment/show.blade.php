@extends('dashboard.index')

@section('css')
{{--
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
--}}
{{--
<link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}"> --}}
@if (app()->getLocale() == 'ar')
<style>
    .row {
        direction: rtl;
    }
</style>
@endif

@endsection

@section('pagename', __('site.apartment'))
@section('object', __('site.add_new_apartment'))

@section('content')
<div id="kt_content_container" class="container-xxl">

    <div class="row gy-5 gx-xl-10">
        <!--begin::apartment info-->
        <div class="col-xl-6">
            <div class="card card-xl-stretch mb-xl-10">

                <div class="card-header align-items-center border-0 mt-4">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="fw-bolder mb-2 text-dark">{{__('site.apartment_info')}}</span>
                    </h3>

                </div>

                <div class="card-body pt-5">

                    <!--begin::name-->
                    <div class="row mb-7">

                        <label class="col-lg-4 fw-bold text-muted">{{__('site.name')}}</label>

                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800">{{$apartment->apartment_name}}</span>
                        </div>

                    </div>
                    <!--end::name-->

                    <!--begin::city-->
                    <div class="row mb-7">

                        <label class="col-lg-4 fw-bold text-muted">{{__('site.city')}}</label>

                        <div class="col-lg-8 fv-row">
                            <span class="fw-bold text-gray-800 fs-6">{{$apartment->city}}</span>
                        </div>

                    </div>
                    <!--end::city-->

                    <!--begin::address-->
                    <div class="row mb-7">

                        <label class="col-lg-4 fw-bold text-muted">{{__('site.address')}}</label>

                        <div class="col-lg-8">
                            <span class="fw-bold text-gray-800 fs-6">{{$apartment->address}}</span>
                        </div>

                    </div>
                    <!--end::address-->

                    <!--begin::space-->
                    <div class="row mb-7">

                        <label class="col-lg-4 fw-bold text-muted">{{__('site.space')}}</label>

                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800">{{$apartment->space}}</span>
                        </div>

                    </div>
                    <!--end::space-->
                </div>

            </div>
        </div>
        <!--end::apartment info-->

        <!--begin::Rental details-->
        <div class="col-xl-6">

            <div class="card card-xl-stretch mb-5 mb-xl-10">

                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">{{__('site.rental_details')}}</span>
                    </h3>
                    <div class="card-toolbar">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-dark active fw-bolder px-4 me-1"
                                    data-bs-toggle="tab" href="#kt_table_widget_5_tab_1">{{__('site.add')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-dark active fw-bolder px-4 me-1"
                                    data-bs-toggle="tab" href="#kt_table_widget_5_tab_1">{{__('site.add')}}</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="card-body pt-5">

                    <!--begin::contract_number-->
                    <div class="row mb-7">

                        <label class="col-lg-4 fw-bold text-muted">{{__('site.contract_number')}}</label>

                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800">---</span>
                        </div>

                    </div>
                    <!--end::contract_number-->

                    <!--begin::contract_starting_date-->
                    <div class="row mb-7">

                        <label class="col-lg-4 fw-bold text-muted">{{__('site.contract_starting_date')}}</label>

                        <div class="col-lg-8 fv-row">
                            <span class="fw-bold text-gray-800 fs-6">---</span>
                        </div>

                    </div>
                    <!--end::contract_starting_date-->

                    <!--begin::contract_end_date-->
                    <div class="row mb-7">

                        <label class="col-lg-4 fw-bold text-muted">{{__('site.contract_end_date')}}</label>

                        <div class="col-lg-8">
                            <span class="fw-bold text-gray-800 fs-6">---</span>
                        </div>

                    </div>
                    <!--end::contract_end_date-->

                    <!--begin::total_rental_amount-->
                    <div class="row mb-7">

                        <label class="col-lg-4 fw-bold text-muted">{{__('site.total_rental_amount')}}</label>

                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800">---</span>
                        </div>

                    </div>
                    <!--end::total_rental_amount-->

                    <!--begin::guarantee_amount-->
                    <div class="row mb-7">

                        <label class="col-lg-4 fw-bold text-muted">{{__('site.guarantee_amount')}}</label>

                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800">---</span>
                        </div>

                    </div>
                    <!--end::guarantee_amount-->

                    <!--begin::number_of_batches-->
                    <div class="row mb-7">

                        <label class="col-lg-4 fw-bold text-muted">{{__('site.number_of_batches')}}</label>

                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800">---</span>
                        </div>

                    </div>
                    <!--end::number_of_batches-->
                </div>

            </div>

        </div>
        <!--end::Rental details-->

        <!--begin::tenant details-->
        <div class="col-xl-6">

            <div class="card card-xl-stretch mb-5 mb-xl-10">

                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">{{__('site.one_tenant')}}</span>
                    </h3>
                    <div class="card-toolbar">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-dark active fw-bolder px-4 me-1"
                                    data-bs-toggle="tab" href="#kt_table_widget_5_tab_1">{{__('site.add')}}</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="card-body pt-5">

                    <!--begin::contract_number-->
                    <div class="row mb-7">

                        <label class="col-lg-4 fw-bold text-muted">{{__('site.name')}}</label>

                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800">---</span>
                        </div>

                    </div>
                    <!--end::contract_number-->

                    <!--begin::contract_starting_date-->
                    <div class="row mb-7">

                        <label class="col-lg-4 fw-bold text-muted">{{__('site.phone')}}</label>

                        <div class="col-lg-8 fv-row">
                            <span class="fw-bold text-gray-800 fs-6">---</span>
                        </div>

                    </div>
                    <!--end::contract_starting_date-->

                    <!--begin::contract_end_date-->
                    <div class="row mb-7">

                        <label class="col-lg-4 fw-bold text-muted">{{__('site.email')}}</label>

                        <div class="col-lg-8">
                            <span class="fw-bold text-gray-800 fs-6">---</span>
                        </div>

                    </div>
                    <!--end::contract_end_date-->

                    <!--begin::total_rental_amount-->
                    <div class="row mb-7">

                        <label class="col-lg-4 fw-bold text-muted">{{__('site.SSl')}}</label>

                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800">---</span>
                        </div>

                    </div>
                    <!--end::total_rental_amount-->

                    <!--begin::guarantee_amount-->
                    <div class="row mb-7">

                        <label class="col-lg-4 fw-bold text-muted">{{__('site.gender')}}</label>

                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800">---</span>
                        </div>

                    </div>
                    <!--end::guarantee_amount-->

                </div>

            </div>

        </div>
        <!--end::tenant details-->
    </div>

</div>

@endsection

@section('js')
@endsection
