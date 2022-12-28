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
<style>
    #stretch {
        background-color: #F5F8FA;
    }

    #compound_id,
    #button_compund {
        display: none;
    }

    /* #building_id,
        #button_building {
            display: none;
        } */
</style>
@endsection

@section('pagename', __('site.apartment'))
@section('object', __('site.add_new_apartment'))

@section('content')
<div id="kt_content_container" class="container-xxl">

    <!--begin::Modal - building - Add-->
    <div class="modal fade" id="kt_modal_add_customer" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Form-->
                <form class="form" action="#" id="kt_modal_add_customer_form"
                    data-kt-redirect="../../demo6/dist/apps/customers/list.html">
                    <!--begin::Modal header-->
                    <div class="modal-header" id="kt_modal_add_customer_header">
                        <!--begin::Modal title-->
                        <h2 class="fw-bolder">{{ __('site.add_new_building') }}</h2>
                        <!--end::Modal title-->
                        <!--begin::Close-->
                        <div id="kt_modal_add_customer_close" class="btn btn-icon btn-sm btn-active-icon-primary">
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
                            data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="300px">

                            <div class="d-flex flex-column mb-7 fv-row">
                                <label class="fs-6 fw-bold mb-2">
                                    <span class="">building</span>

                                </label>
                                <select name="building" id="building_id" aria-label="Select a Country"
                                    data-control="select2" data-placeholder="Select a Country..."
                                    data-dropdown-parent="#kt_modal_add_customer"
                                    class="form-select form-select-solid fw-bolder">
                                    @foreach ($buildings as $building)
                                    <option value="{{ $building->id }}">{{ $building->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                    </div>

                    <!--begin::Modal footer-->
                    <div class="modal-footer flex-center">
                        <!--begin::Button-->
                        <button type="reset" id="kt_modal_add_customer_cancel"
                            class="btn btn-light me-3">Discard</button>
                        <!--end::Button-->
                        <!--begin::Button-->
                        <button type="button"
                            onclick="updateApartment('/update/apartment/details/{{$apartment->id}}',document.getElementById('building_id').value,'building')"
                            id="kt_modal_add_customer_submit" class="btn btn-primary">
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
    <!--end::Modal - building - Add-->

    <!--begin::Modal - compound - Add-->
    <div class="modal fade" id="kt_modal_add_compound" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Form-->
                <form class="form" action="#" id="kt_modal_add_compound_form"
                    data-kt-redirect="../../demo6/dist/apps/customers/list.html">
                    <!--begin::Modal header-->
                    <div class="modal-header" id="kt_modal_add_compound_header">
                        <!--begin::Modal title-->
                        <h2 class="fw-bolder">{{ __('site.add_new_compund') }}</h2>
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

                        <div class="scroll-y me-n7 pe-7" id="kt_modal_add_compound_scroll"
                            data-kt-scroll-dependencies="#kt_modal_add_compound_header"
                            data-kt-scroll-wrappers="#kt_modal_add_compound_scroll" data-kt-scroll-offset="300px">

                            <div class="d-flex flex-column mb-7 fv-row">
                                <label class="fs-6 fw-bold mb-2">
                                    <span class="">Compound</span>

                                </label>
                                <select name="compound" id="compound_id" aria-label="" data-control="select2"
                                    data-placeholder="" data-dropdown-parent="#kt_modal_add_compound"
                                    class="form-select form-select-solid fw-bolder">
                                    @foreach ($compounds as $compound)
                                    <option value="{{ $compound->id }}">{{ $compound->name }}</option>
                                    @endforeach
                                </select>

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
                        <button type="button"
                            onclick="updateApartment('/update/apartment/details/{{$apartment->id}}',document.getElementById('compound_id').value,'compound')"
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
    <!--end::Modal - compound - Add-->


    <!--begin::Modal - contract - Add-->
    @if ($contract != null)
    <div class="modal fade" id="kt_modal_add_contract" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Form-->
                <form class="form" action="#" id="kt_modal_add_contract_form"
                    data-kt-redirect="../../demo6/dist/apps/customers/list.html">
                    <!--begin::Modal header-->
                    <div class="modal-header" id="kt_modal_add_contract_header">
                        <!--begin::Modal title-->
                        <h2 class="fw-bolder">{{ __('site.add_new_compund') }}</h2>
                        <!--end::Modal title-->
                        <!--begin::Close-->
                        <div id="kt_modal_add_contract_close" class="btn btn-icon btn-sm btn-active-icon-primary">
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

                        <div class="scroll-y me-n7 pe-7" id="kt_modal_add_contract_scroll"
                            data-kt-scroll-dependencies="#kt_modal_add_contract_header"
                            data-kt-scroll-wrappers="#kt_modal_add_contract_scroll" data-kt-scroll-offset="300px">

                            <div class="d-flex flex-column mb-7 fv-row">
                                <label class="fs-6 fw-bold mb-2">
                                    <span class="">End Date</span>

                                </label>
                                <input type="date" class="form-control form-control-solid" name="endDate" id="endDate"
                                    placeholder="" value="" />

                            </div>
                        </div>

                    </div>

                    <!--begin::Modal footer-->
                    <div class="modal-footer flex-center">
                        <!--begin::Button-->
                        <button type="reset" id="kt_modal_add_contract_cancel"
                            class="btn btn-light me-3">Discard</button>
                        <!--end::Button-->
                        <!--begin::Button-->
                        <button type="button" onclick="endContract('{{$contract->id}}')"
                            id="kt_modal_add_contract_submit" class="btn btn-primary">
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
    @endif
    <!--end::Modal - contract - Add-->

    <div class="row gy-5 gx-xl-10">
        <!--begin::apartment info-->
        <div class="col-xl-6">
            <div class="card card-xl-stretch mb-xl-10">

                <div class="card-header align-items-center border-0 mt-4">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="fw-bolder mb-2 text-dark">{{ __('site.apartment_info') }}</span>
                    </h3>

                </div>

                <div class="card-body pt-5">

                    <!--begin::name-->
                    <div class="row mb-7">

                        <label class="col-lg-4 fw-bold text-muted">{{ __('site.name') }}</label>

                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800">{{ $apartment->apartment_name }}</span>
                        </div>

                    </div>
                    <!--end::name-->

                    <!--begin::city-->
                    <div class="row mb-7">

                        <label class="col-lg-4 fw-bold text-muted">{{ __('site.city') }}</label>

                        <div class="col-lg-8 fv-row">
                            <span class="fw-bold text-gray-800 fs-6">{{ $apartment->city }}</span>
                        </div>

                    </div>
                    <!--end::city-->

                    <!--begin::address-->
                    <div class="row mb-7">

                        <label class="col-lg-4 fw-bold text-muted">{{ __('site.address') }}</label>

                        <div class="col-lg-8">
                            <span class="fw-bold text-gray-800 fs-6">{{ $apartment->address }}</span>
                        </div>

                    </div>
                    <!--end::address-->

                    <!--begin::space-->
                    <div class="row mb-7">

                        <label class="col-lg-4 fw-bold text-muted">{{ __('site.space') }}</label>

                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800">{{ $apartment->space }}</span>
                        </div>

                    </div>
                    <!--end::space-->
                </div>

            </div>
        </div>
        <!--end::apartment info-->

        <!--begin::compound and building-->
        <div class="col-xl-6">
            <div class="card card-xl-stretch" id="stretch">
                <!--begin::compound-->
                <div class="col-xl-12">

                    <div class="card  hoverable card-xl-stretch mb-xl-8">
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder fs-3 mb-1">{{ __('site.compounds') }}</span>
                            </h3>
                            <div class="card-toolbar">
                                <ul class="nav">
                                    <li class="nav-item">
                                        <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px"
                                            id="selector">
                                            @if ($apartment->compound_id == null)
                                            <a class="" data-bs-toggle="modal"
                                                data-bs-target="#kt_modal_add_compound">{{ __('site.add') }}</a>
                                            @else
                                            <a class="" data-bs-toggle="modal"
                                                data-bs-target="#kt_modal_add_compound">{{ __('site.edit') }}</a>
                                            @endif
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body pt-5">

                            <!--begin::contract_number-->
                            <div class="row mb-7">
                                @if ($apartment->compound_id == null)
                                <div class="col-lg-8">
                                    <span class="fw-bolder fs-6 text-gray-800" id="select_new_compound">
                                        {{ __('site.compound_not_selected') }}</span>
                                </div>
                                @else
                                <div class="row mb-7" id="compoundLabel">

                                    <label class="col-lg-4 fw-bold text-muted">{{ __('site.compounds') }}</label>

                                    <div class="col-lg-8" id="compoundName">
                                        <span class="fw-bolder fs-6 text-gray-800">{{ $apartment->compound->name
                                            }}</span>
                                    </div>

                                </div>
                                @endif
                                <div class="input-group" id="divCompound">
                                    <select class="form-control" name="compound_id" id="compound_id">
                                        <option value="">{{ __('site.select_compound') }}</option>
                                        @foreach ($compounds as $compound)
                                        <option value="{{ $compound->id }}">{{ $compound->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" id="button_compund" type="button">{{
                                            __('site.edit') }}</button>
                                    </div>
                                </div>

                            </div>
                            <!--end::contract_number-->
                        </div>
                    </div>

                </div>
                <!--end::compound-->

                <!--begin::building-->
                <div class="col-xl-12">

                    <div class="card  hoverable card-xl-stretch mb-xl-8">
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder fs-3 mb-1">{{ __('site.building') }}</span>
                            </h3>
                            <div class="card-toolbar">
                                <ul class="nav">
                                    <li class="nav-item">
                                        <div
                                            class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px">
                                            @if ($apartment->building_id == null)
                                            <a class="" data-bs-toggle="modal"
                                                data-bs-target="#kt_modal_add_customer">{{ __('site.add') }}</a>
                                            @else
                                            <a class="" data-bs-toggle="modal"
                                                data-bs-target="#kt_modal_add_customer">{{ __('site.edit') }}</a>
                                            @endif
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body pt-5">

                            <div class="row mb-7">
                                @if ($apartment->building_id == null)
                                <div class="col-lg-8">
                                    <span class="fw-bolder fs-6 text-gray-800" id="select_new_building">
                                        {{ __('site.building_not_selected') }}</span>
                                </div>
                                @else
                                <div class="row mb-7" id="buildingLabel">

                                    <label class="col-lg-4 fw-bold text-muted">{{ __('site.buildings') }}</label>

                                    <div class="col-lg-8" id="buildingName">
                                        <span class="fw-bolder fs-6 text-gray-800">{{ $apartment->building->name
                                            }}</span>
                                    </div>

                                </div>
                                @endif
                                <div class="input-group" id="divbuilding" hidden>
                                    <select class="form-control" name="building_id" id="building_id">
                                        <option value="">{{ __('site.select_building') }}</option>
                                        @foreach ($buildings as $building)
                                        <option value="{{ $building->id }}">{{ $building->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" id="button_building" type="button">{{
                                            __('site.edit') }}</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
                <!--end::building-->
            </div>
        </div>
        <!--end::compound and building-->

        <!--begin::Rental details-->
        <div class="col-xl-6">

            <div class="card card-xl-stretch mb-5 mb-xl-10">

                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">{{ __('site.rental_details') }}</span>
                    </h3>
                    <div class="card-toolbar">
                        <ul class="nav">
                            @if ($contract == null)
                            <li class="nav-item">
                                <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px">
                                    <a href="{{ route('rental.create.id',$apartment->id) }}"
                                        class="">{{__('site.designation')}}</a>
                                </div>
                            </li>
                            @else
                            <li class="nav-item">
                                <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px">
                                    <a data-bs-toggle="modal" data-bs-target="#kt_modal_add_contract"
                                        class="">{{__('site.evacuation')}}</a>
                                </div>
                            </li>

                            <li class="nav-item">
                                <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px">
                                    <a href="{{ route('rental.edit', $contract->id) }}"
                                        class="">{{__('site.renewal')}}</a>
                                </div>
                            </li>

                            @endif

                        </ul>
                    </div>
                </div>
                @if ($contract != null)
                <div class="card-body pt-5">


                    <!--begin::contract_starting_date-->
                    <div class="row mb-7">

                        <label class="col-lg-4 fw-bold text-muted">{{ __('site.contract_starting_date') }}</label>

                        <div class="col-lg-8 fv-row">
                            <span class="fw-bold text-gray-800 fs-6">{{$contract->from}}</span>
                        </div>

                    </div>
                    <!--end::contract_starting_date-->

                    <!--begin::contract_end_date-->
                    <div class="row mb-7">

                        <label class="col-lg-4 fw-bold text-muted">{{ __('site.contract_end_date') }}</label>

                        <div class="col-lg-8">
                            <span class="fw-bold text-gray-800 fs-6">{{$contract->to}}</span>
                        </div>

                    </div>
                    <!--end::contract_end_date-->

                    <!--begin::total_rental_amount-->
                    <div class="row mb-7">

                        <label class="col-lg-4 fw-bold text-muted">{{ __('site.total_rental_amount') }}</label>

                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800">{{$contract->total_amount_of_rent}}</span>
                        </div>

                    </div>
                    <!--end::total_rental_amount-->

                    <!--begin::guarantee_amount-->
                    <div class="row mb-7">

                        <label class="col-lg-4 fw-bold text-muted">{{ __('site.guarantee_amount') }}</label>

                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800">{{$contract->guarantee_amount}}</span>
                        </div>

                    </div>
                    <!--end::guarantee_amount-->

                    <!--begin::number_of_batches-->
                    <div class="row mb-7">

                        <label class="col-lg-4 fw-bold text-muted">{{ __('site.number_of_batches') }}</label>

                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800">{{$contract->number_of_batches}}</span>
                        </div>

                    </div>
                    <!--end::number_of_batches-->
                </div>
                @endif
            </div>

        </div>
        <!--end::Rental details-->

        <!--begin::tenant details-->
        <div class="col-xl-6">

            <div class="card card-xl-stretch mb-5 mb-xl-10">

                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">{{ __('site.one_tenant') }}</span>
                    </h3>
                    {{-- <div class="card-toolbar">
                        <ul class="nav">
                            <li class="nav-item">
                                <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px">
                                    <a href="{{ route('apartment.create') }}" class="">تعيين</a>
                                </div>
                            </li>
                        </ul>
                    </div> --}}
                </div>
                @if ($contract != null)
                <div class="card-body pt-5">

                    <!--begin::contract_number-->
                    <div class="row mb-7">

                        <label class="col-lg-4 fw-bold text-muted">{{ __('site.name') }}</label>

                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800">{{$contract->tenant->name}}</span>
                        </div>

                    </div>
                    <!--end::contract_number-->

                    <!--begin::contract_starting_date-->
                    <div class="row mb-7">

                        <label class="col-lg-4 fw-bold text-muted">{{ __('site.phone') }}</label>

                        <div class="col-lg-8 fv-row">
                            <span class="fw-bold text-gray-800 fs-6">{{$contract->tenant->phone}}</span>
                        </div>

                    </div>
                    <!--end::contract_starting_date-->

                    <!--begin::contract_end_date-->
                    <div class="row mb-7">

                        <label class="col-lg-4 fw-bold text-muted">{{ __('site.email') }}</label>

                        <div class="col-lg-8">
                            <span class="fw-bold text-gray-800 fs-6">{{$contract->tenant->email}}</span>
                        </div>

                    </div>
                    <!--end::contract_end_date-->

                    <!--begin::total_rental_amount-->
                    <div class="row mb-7">

                        <label class="col-lg-4 fw-bold text-muted">{{ __('site.SSl') }}</label>

                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800">{{$contract->tenant->ssl}}</span>
                        </div>

                    </div>
                    <!--end::total_rental_amount-->

                    <!--begin::guarantee_amount-->
                    <div class="row mb-7">

                        <label class="col-lg-4 fw-bold text-muted">{{ __('site.nationality') }}</label>

                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800">{{$contract->tenant->nationality}}</span>
                        </div>

                    </div>
                    <!--end::guarantee_amount-->

                </div>
                @endif

            </div>

        </div>
        <!--end::tenant details-->

    </div>


</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>
<script src="https://unpkg.com/axios@1.1.2/dist/axios.min.js"></script>
{{-- <script src="{{ asset('assets/js/app.js') }}"></script>--}}
{{-- <script src="{{ asset('assets/js/crud.js') }}"></script> --}}
<script>
    function endContract(id) {
            // console.log(data);
            axios.post('/rental/delete/'+id, {

            endDate: document.getElementById('endDate').value,

            }).then(function(response) {
                // handle success 2xx
                console.log(response);
                window.location.reload();
                toastr.success(response.data.message);
            }).catch(function(error) {
                // handle error 4xx - 5xx
                console.log(error);
                // toastr.error(error.response.data.message)
            });
        }
</script>
@endsection
