@extends('dashboard.index')

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
@if (app()->getLocale() == 'ar')
<style>
    .row {
        direction: rtl;
    }
</style>
@endif
<style>
    .no_data {
        font-size: 22px;
        text-align: center;
    }
</style>
@endsection

@section('pagename', __('site.tenants'))
@section('object', __('site.add_new_tenant'))

@section('content')

<div id="kt_content_container" class="container-xxl">

    <!--begin::Modal - rating - Add-->
    <div class="modal fade" id="kt_modal_add_compound" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Form-->
                <form class="form" id="kt_modal_add_compound_form"
                    data-kt-redirect="../../demo6/dist/apps/customers/list.html">
                    <!--begin::Modal header-->
                    <div class="modal-header" id="kt_modal_add_compound_header">
                        <!--begin::Modal title-->
                        <h2 class="fw-bolder">{{ __('site.tenant_data') }}</h2>
                        <!--end::Modal title-->
                        <!--begin::Close-->
                        <div id="kt_modal_add_compound_close" class="btn btn-icon btn-sm btn-active-icon-primary">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                            <span class="svg-icon svg-icon-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                        transform="rotate(-45 6 17.3137)" fill="black" />
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                        transform="rotate(45 7.41422 6)" fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </div>
                        <!--end::Close-->
                    </div>
                    <div class="modal-body py-10 px-lg-17">

                        <div class="scroll-y me-n7 pe-7" id="kt_modal_add_customer_scroll" data-kt-scroll="true"
                            data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                            data-kt-scroll-dependencies="#kt_modal_add_customer_header"
                            data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="350px">

                            <div class="d-flex flex-column mb-7 fv-row">
                                <label class="fs-6 fw-bold mb-2">
                                    <span class="">payment</span>

                                </label>
                                <input type="text" name="payment" id="payment"
                                    class="form-control form-control-solid mb-3 mb-lg-0" placeholder="" value=""
                                    required />

                            </div>
                            <div class="d-flex flex-column mb-7 fv-row">
                                <label class="fs-6 fw-bold mb-2">
                                    <span class="">clean</span>

                                </label>
                                <input type="text" name="clean" id="clean"
                                    class="form-control form-control-solid mb-3 mb-lg-0" placeholder="" value=""
                                    required />

                            </div>

                            <div class="d-flex flex-column mb-7 fv-row">
                                <label class="fs-6 fw-bold mb-2">
                                    <span class="">apartment interest</span>

                                </label>
                                <input type="text" name="interest" id="interest"
                                    class="form-control form-control-solid mb-3 mb-lg-0" placeholder="" value=""
                                    required />

                            </div>

                            <div class="d-flex flex-column mb-7 fv-row">
                                <label class="fs-6 fw-bold mb-2">
                                    <span class="">annoyance</span>

                                </label>
                                <input type="text" name="annoyance" id="annoyance"
                                    class="form-control form-control-solid mb-3 mb-lg-0" placeholder="" value=""
                                    required />

                            </div>

                            <div class="d-flex flex-column mb-7 fv-row">
                                <label class="fs-6 fw-bold mb-2">
                                    <span class="">description</span>

                                </label>
                                <input type="text" name="description" id="description"
                                    class="form-control form-control-solid mb-3 mb-lg-0" placeholder="" value=""
                                    required />

                            </div>
                        </div>

                    </div>

                    <!--begin::Modal footer-->
                    <div class="modal-footer flex-center">
                        <!--begin::Button-->
                        <button type="reset" id="kt_modal_add_compound_cancel"
                            class="btn btn-light me-3">Discard</button>
                        <!--end::Button-->
                        <!--begin::Button-->
                        <button type="button" onclick="addRateTenant('{{ $tenant->id }}')"
                            id="kt_modal_add_compound_submit" class="btn btn-primary">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                        <!--end::Button-->
                    </div>
                    <!--end::Modal footer-->
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
    <!--end::Modal - rating - Add-->

    <!--begin::Modal - edit rating --->
    @if ($tenant->tenantInfo != null)
    <div class="modal fade" id="kt_modal_edit_tenant" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Form-->
                <form class="form" id="kt_modal_edit_tenant_form"
                    data-kt-redirect="../../demo6/dist/apps/customers/list.html">
                    <!--begin::Modal header-->
                    <div class="modal-header" id="kt_modal_edit_tenant_header">
                        <!--begin::Modal title-->
                        <h2 class="fw-bolder">{{ __('site.tenant_data') }}</h2>
                        <!--end::Modal title-->
                        <!--begin::Close-->
                        <div id="kt_modal_edit_tenant_close" class="btn btn-icon btn-sm btn-active-icon-primary">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                            <span class="svg-icon svg-icon-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                        transform="rotate(-45 6 17.3137)" fill="black" />
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                        transform="rotate(45 7.41422 6)" fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </div>
                        <!--end::Close-->
                    </div>
                    <div class="modal-body py-10 px-lg-17">

                        <div class="scroll-y me-n7 pe-7" id="kt_modal_add_customer_scroll" data-kt-scroll="true"
                            data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                            data-kt-scroll-dependencies="#kt_modal_add_customer_header"
                            data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="350px">

                            <div class="d-flex flex-column mb-7 fv-row">
                                <label class="fs-6 fw-bold mb-2">
                                    <span class="">payment</span>

                                </label>
                                <input type="text" name="edit_payment" id="edit_payment"
                                    class="form-control form-control-solid mb-3 mb-lg-0" placeholder=""
                                    value="{{$tenant->tenantInfo->payment}}" required />

                            </div>
                            <div class="d-flex flex-column mb-7 fv-row">
                                <label class="fs-6 fw-bold mb-2">
                                    <span class="">clean</span>

                                </label>
                                <input type="text" name="edit_clean" id="edit_clean"
                                    class="form-control form-control-solid mb-3 mb-lg-0" placeholder=""
                                    value="{{$tenant->tenantInfo->apartment_clean}}" required />

                            </div>

                            <div class="d-flex flex-column mb-7 fv-row">
                                <label class="fs-6 fw-bold mb-2">
                                    <span class="">apartment interest</span>

                                </label>
                                <input type="text" name="edit_interest" id="edit_interest"
                                    class="form-control form-control-solid mb-3 mb-lg-0" placeholder=""
                                    value="{{$tenant->tenantInfo->apartment_interest}}" required />

                            </div>

                            <div class="d-flex flex-column mb-7 fv-row">
                                <label class="fs-6 fw-bold mb-2">
                                    <span class="">annoyance</span>

                                </label>
                                <input type="text" name="edit_annoyance" id="edit_annoyance"
                                    class="form-control form-control-solid mb-3 mb-lg-0" placeholder=""
                                    value="{{$tenant->tenantInfo->annoyance}}" required />

                            </div>
                            <div class="d-flex flex-column mb-7 fv-row">
                                <label class="fs-6 fw-bold mb-2">
                                    <span class="">description</span>

                                </label>
                                <input type="text" name="edit_description" id="edit_description"
                                    class="form-control form-control-solid mb-3 mb-lg-0" placeholder=""
                                    value="{{$tenant->tenantInfo->description}}" required />

                            </div>
                        </div>

                    </div>

                    <!--begin::Modal footer-->
                    <div class="modal-footer flex-center">
                        <!--begin::Button-->
                        <button type="reset" id="kt_modal_edit_tenant_cancel"
                            class="btn btn-light me-3">Discard</button>
                        <!--end::Button-->
                        <!--begin::Button-->
                        <button type="button"
                            onclick="editRateTenant('{{$tenant->tenantInfo->id}}','{{ $tenant->id }}')"
                            id="kt_modal_edit_tenant_submit" class="btn btn-primary">
                            <span class="indicator-label">Edit</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                        <!--end::Button-->
                    </div>
                    <!--end::Modal footer-->
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
    @endif
    <!--end::Modal - edit rating --->

    <div class="row gy-5 gx-xl-10">

        <!--begin::Rental details-->
        <div class="col-xl-6">

            <div class="card card-xl-stretch mb-5 mb-xl-10">

                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">{{ __('site.tenant_data') }}</span>
                    </h3>
                    {{-- <div class="card-toolbar">
                        <ul class="nav">
                            <li class="nav-item">
                                <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px"
                                    id="selector">
                                    <a class="" data-bs-toggle="modal" data-bs-target="#kt_modal_add_compound">{{
                                        __('site.add') }}</a>
                                </div>
                            </li>
                        </ul>
                    </div> --}}
                </div>
                <div class="card-body pt-5">


                    <!--begin::contract_starting_date-->
                    <div class="row mb-7">

                        <label class="col-lg-4 fw-bold text-muted">{{ __('site.name') }}</label>

                        <div class="col-lg-8 fv-row">
                            <span class="fw-bold text-gray-800 fs-6">{{ $tenant->name }}</span>
                        </div>

                    </div>
                    <!--end::contract_starting_date-->

                    <!--begin::contract_end_date-->
                    <div class="row mb-7">

                        <label class="col-lg-4 fw-bold text-muted">{{ __('site.phone') }}</label>

                        <div class="col-lg-8">
                            <span class="fw-bold text-gray-800 fs-6">{{ $tenant->phone }}</span>
                        </div>

                    </div>
                    <!--end::contract_end_date-->

                    <!--begin::total_rental_amount-->
                    <div class="row mb-7">

                        <label class="col-lg-4 fw-bold text-muted">{{ __('site.email') }}</label>

                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800">{{ $tenant->email }}</span>
                        </div>

                    </div>
                    <!--end::total_rental_amount-->

                </div>
            </div>

        </div>
        <!--end::Rental details-->

        <!--begin::contract details-->
        <div class="col-xl-6">

            <div class="card card-xl-stretch mb-5 mb-xl-10">

                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">{{ __('site.details') }}</span>
                    </h3>
                </div>

                @if ($tenant->contract != null)
                <div class="card-body pt-5">

                    <div class="row mb-7">

                        <label class="col-lg-4 fw-bold text-muted">{{ __('site.building') }}</label>

                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800">
                                {{$tenant->contract->apartment->building->name ?? '---'}}</span>
                        </div>

                    </div>

                    <!--begin::apartment-->
                    <div class="row mb-7">

                        <label class="col-lg-4 fw-bold text-muted">{{ __('site.apartment') }}</label>

                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800">
                                {{$tenant->contract->apartment->apartment_name}}</span>
                        </div>

                    </div>
                    <!--end::apartment-->

                    <!--begin::from-->
                    <div class="row mb-7">

                        <label class="col-lg-4 fw-bold text-muted">{{ __('site.from') }}</label>

                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800">
                                {{$tenant->contract->from}}</span>
                        </div>

                    </div>
                    <!--end::from-->

                    <!--begin::from-->
                    <div class="row mb-7">

                        <label class="col-lg-4 fw-bold text-muted">{{ __('site.to') }}</label>

                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800">
                                {{$tenant->contract->to}}</span>
                        </div>

                    </div>
                    <!--end::from-->

                </div>
                @else
                <div class="card-body pt-5">

                    <div class="row mb-7">

                        <p class="no_data">{{__('site.no_contracts')}}</p>


                    </div>

                </div>
                @endif
            </div>

        </div>
        <!--end::contract details-->

        <!--begin::Rental details-->
        <div class="col-xl-6">
            <div class="card card-xl-stretch mb-5 mb-xl-10">

                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">{{ __('site.tenant_data') }}</span>
                    </h3>
                    <div class="card-toolbar">
                        <ul class="nav">
                            <li class="nav-item">
                                <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px"
                                    id="selector">
                                    @if ($tenant->tenantInfo !=null)
                                    <a class="" data-bs-toggle="modal" data-bs-target="#kt_modal_edit_tenant">{{
                                        __('site.edit') }}</a>

                                    @else
                                    <a class="" data-bs-toggle="modal" data-bs-target="#kt_modal_add_compound">{{
                                        __('site.add') }}</a>
                                    @endif


                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                @if ($tenant->tenantInfo !=null)
                <div class="card-body pt-5">


                    <!--begin::contract_starting_date-->
                    <div class="row mb-7">

                        <label class="col-lg-4 fw-bold text-muted">payment</label>

                        <div class="col-lg-8 fv-row">
                            <span class="fw-bold text-gray-800 fs-6">{{ $tenant->tenantInfo->payment }}</span>
                        </div>

                    </div>
                    <!--end::contract_starting_date-->

                    <!--begin::contract_end_date-->
                    <div class="row mb-7">

                        <label class="col-lg-4 fw-bold text-muted">clean</label>

                        <div class="col-lg-8">
                            <span class="fw-bold text-gray-800 fs-6">{{ $tenant->tenantInfo->apartment_clean }}</span>
                        </div>

                    </div>
                    <!--end::contract_end_date-->

                    <!--begin::total_rental_amount-->
                    <div class="row mb-7">

                        <label class="col-lg-4 fw-bold text-muted">interest</label>

                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800">{{ $tenant->tenantInfo->apartment_interest
                                }}</span>
                        </div>

                    </div>
                    <!--end::total_rental_amount-->

                    <!--begin::total_rental_amount-->
                    <div class="row mb-7">

                        <label class="col-lg-4 fw-bold text-muted">annoyance</label>

                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800">{{ $tenant->tenantInfo->annoyance
                                }}</span>
                        </div>

                    </div>
                    <!--end::total_rental_amount-->

                </div>
                @endif
            </div>

        </div>
        <!--end::Rental details-->



    </div>

</div>

@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>
<script src="https://unpkg.com/axios@1.1.2/dist/axios.min.js"></script>
<script>
    function addRateTenant(id) {
            axios.post('/tenant-info', {
                    payment: document.getElementById('payment').value,
                    clean: document.getElementById('clean').value,
                    interest: document.getElementById('interest').value,
                    annoyance: document.getElementById('annoyance').value,
                    description: document.getElementById('description').value,
                    tenant_id:id
                })
                .then(function(response) {
                    //2xx
                    toastr.success(response.data.message);
                    window.location.href = "/tenant";

                })
                .catch(function(error) {
                    //4xx - 5xx
                    toastr.error(error.response.data.message)

                });

    }

    function editRateTenant(idTenant,id) {
        axios.put('/tenant-info/' + idTenant , {
            payment: document.getElementById('edit_payment').value,
            clean: document.getElementById('edit_clean').value,
            interest: document.getElementById('edit_interest').value,
            annoyance: document.getElementById('edit_annoyance').value,
            description: document.getElementById('edit_description').value,
            tenant_id:id
            })
            .then(function(response) {
            //2xx
            toastr.success(response.data.message);
            window.location.href = "/tenant";

            })
            .catch(function(error) {
            //4xx - 5xx
            toastr.error(error.response.data.message)

        });

    }
</script>

@endsection
