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
    #apartmentId {
        display: none;
    }

    #addNewTenant {
        color: #009ef6;
        font-size: 18px;
        text-align: center;
        padding-top: 8px;
    }
</style>
@endsection

@section('pagename', __('site.compounds'))
@section('object', __('site.add_new_compund'))

@section('content')

<div class="row">
    <div class="col-lg-12">
        <!--begin::Card-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">{{ __('site.compound_info') }}</h3>
            </div>

            <!--begin::Stepper-->
            <div class="stepper stepper-pills" id="kt_stepper_example_basic">
                <!--begin::Nav-->
                <div class="stepper-nav flex-center flex-wrap mb-10">
                    <!--begin::Step 1-->
                    <div class="stepper-item mx-2 my-4 current" data-kt-stepper-element="nav">
                        <!--begin::Line-->
                        <div class="stepper-line w-40px"></div>
                        <!--end::Line-->

                        <!--begin::Icon-->
                        <div class="stepper-icon w-40px h-40px">
                            <i class="stepper-check fas fa-check"></i>
                            <span class="stepper-number">1</span>
                        </div>
                        <!--end::Icon-->

                        <!--begin::Label-->
                        <div class="stepper-label">
                            {{-- <h3 class="stepper-title">
                                Step 1
                            </h3> --}}

                            <div class="stepper-desc">
                                {{__('site.tenant_data')}}
                            </div>
                        </div>
                        <!--end::Label-->
                    </div>
                    <!--end::Step 1-->

                    <!--begin::Step 2-->
                    <div class="stepper-item mx-2 my-4" data-kt-stepper-element="nav">
                        <!--begin::Line-->
                        <div class="stepper-line w-40px"></div>
                        <!--end::Line-->

                        <!--begin::Icon-->
                        <div class="stepper-icon w-40px h-40px">
                            <i class="stepper-check fas fa-check"></i>
                            <span class="stepper-number">2</span>
                        </div>
                        <!--begin::Icon-->

                        <!--begin::Label-->
                        <div class="stepper-label">
                            {{-- <h3 class="stepper-title">
                                Step 2
                            </h3> --}}

                            <div class="stepper-desc">
                                {{__('site.lease_contract_data')}}
                            </div>
                        </div>
                        <!--end::Label-->
                    </div>
                    <!--end::Step 2-->

                </div>
                <!--end::Nav-->

                <!--begin::Form-->
                <form class="form w-lg-550px mx-auto" novalidate="novalidate" id="kt_stepper_example_basic_form">
                    <!--begin::Group-->
                    <div class="mb-5">
                        <!--begin::Step 1-->
                        <div class="flex-column current" data-kt-stepper-element="content">
                            <!--begin:: name-->
                            <div class="fv-row mb-1">
                                <label class="form-label">{{__('site.name')}}</label>

                                <select name="tenant_id" id="tenant_id"
                                    class="form-select form-select-lg form-select-solid" data-control="select2"
                                    data-placeholder="{{__('site.select')}}" data-allow-clear="true"
                                    data-hide-search="true">
                                    <option></option>
                                    @foreach ($tenants as $tenant)
                                    <option value="{{$tenant->id}}">{{$tenant->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!--end:: name-->
                            <p id="addNewTenant">{{__('site.or_add_new_tenant')}}</p>

                            <!--begin::tenant name-->
                            <div class="fv-row mb-10">

                                <label class="form-label">{{__('site.name')}}</label>

                                <input type="text" class="form-control form-control-solid" name="name" id="name"
                                    placeholder="" value="" />

                            </div>
                            <!--end::tenant name-->

                            <!--begin::nationality-->
                            <div class="fv-row mb-10">

                                <label class="form-label">{{__('site.nationality')}}</label>

                                <input type="text" class="form-control form-control-solid" name="nationality"
                                    id="nationality" placeholder="" value="" />

                            </div>
                            <!--end::nationality-->

                            <!--begin::ssl-->
                            <div class="fv-row mb-10">

                                <label class="form-label">{{__('site.id_number')}}</label>

                                <input type="text" class="form-control form-control-solid" name="ssl" id="ssl"
                                    placeholder="" value="" />

                            </div>
                            <!--end::ssl-->

                            <!--begin::phone-->
                            <div class="fv-row mb-10">

                                <label class="form-label">{{__('site.phone')}}</label>

                                <input type="text" class="form-control form-control-solid" name="phone" id="phone"
                                    placeholder="" value="" />

                            </div>
                            <!--end::phone-->

                            <!--begin::email-->
                            <div class="fv-row mb-10">

                                <label class="form-label">{{__('site.email')}}</label>

                                <input type="text" class="form-control form-control-solid" name="email" id="email"
                                    placeholder="" value="" />

                            </div>
                            <!--end::email-->

                        </div>
                        <!--begin::Step 1-->

                        <!--begin::Step 2-->
                        <div class="flex-column" data-kt-stepper-element="content">
                            <div class="row" id="apartmentId">
                                <div class="col-6">
                                    <label class="form-label">{{__('site.to')}}</label>

                                    <input type="text" class="form-control form-control-solid" name="" id="apartment_id"
                                        placeholder="" value="{{$apartment_id}}" />
                                </div>
                            </div>
                            <!--begin:: from & to-->
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label">{{__('site.from')}}</label>

                                    <input type="date" class="form-control form-control-solid" name="from" id="from"
                                        placeholder="" value="" />
                                </div>
                                <div class="col-6">
                                    <label class="form-label">{{__('site.to')}}</label>

                                    <input type="date" class="form-control form-control-solid" name="to" id="to"
                                        placeholder="" value="" />
                                </div>
                            </div><br>
                            <!--end:: from & to-->

                            <!--begin:: number_of_batches & total_amount_of_rent-->
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label">{{__('site.number_of_batches')}}</label>

                                    <select name="number_of_batches" id="number_of_batches"
                                        class="form-select form-select-lg form-select-solid" data-control="select2"
                                        data-placeholder="{{__('site.select')}}" data-allow-clear="true"
                                        data-hide-search="true">
                                        <option></option>
                                        @for ($i =1 ; $i<=10;$i++) <option value="{{$i}}">{{$i}}</option>
                                            @endfor

                                    </select>
                                </div>
                                <div class="col-6">
                                    <label class="form-label">{{__('site.total_amount_of_rent')}}</label>

                                    <input type="text" class="form-control form-control-solid"
                                        name="total_amount_of_rent" id="total_amount_of_rent" placeholder="" value="" />
                                </div>
                            </div><br>
                            <!--end:: number_of_batches & total_amount_of_rent-->

                            <!--begin:: guarantee_amount $ payment_method-->
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label">{{__('site.guarantee_amount')}}</label>

                                    <input type="text" class="form-control form-control-solid" name="guarantee_amount"
                                        id="guarantee_amount" placeholder="" value="" />
                                </div>
                                <div class="col-6">
                                    <label class="form-label">{{__('site.payment_method')}}</label>

                                    <select name="payment_method" id="payment_method"
                                        class="form-select form-select-lg form-select-solid" data-control="select2"
                                        data-placeholder="{{__('site.select')}}" data-allow-clear="true"
                                        data-hide-search="true">
                                        <option></option>
                                        <option value="0">{{__('site.payment_at_the_beginning_of_the_contract')}}
                                        </option>
                                        <option value="1">{{__('site.pay_with_rent_payments')}}</option>
                                    </select>
                                </div>
                            </div><br>

                            <!--end:: payment_method-->

                            {{-- building images --}}
                            <div class="dragover">
                                <span class="inner">
                                    {{ __('site.upload_images') }}
                                    <span class="select" role="button">{{ __('site.browse') }}</span>
                                </span>

                                <input name="images[]" type="file" class="file" multiple />
                            </div>
                            {{-- end building images --}}
                            <div class="container">
                            </div>
                        </div>
                        <!--begin::Step 2-->

                    </div>
                    <!--end::Group-->

                    <!--begin::Actions-->
                    <div class="d-flex flex-stack">
                        <!--begin::Wrapper-->
                        <div class="me-2">
                            <button type="button" class="btn btn-light btn-active-light-primary"
                                data-kt-stepper-action="previous">
                                Back
                            </button>
                        </div>
                        <!--end::Wrapper-->

                        <!--begin::Wrapper-->
                        <div>
                            <button type="button" class="btn btn-primary" onclick="addRental()"
                                data-kt-stepper-action="submit" id="submit">

                                Submit

                            </button>

                            <button type="button" class="btn btn-primary" data-kt-stepper-action="next" id="continue">
                                Continue
                            </button>
                        </div>
                        <!--end::Wrapper-->
                    </div><br>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Stepper-->
        </div>
        <!--end::Card-->
    </div>
</div>

@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>
<script src="https://unpkg.com/axios@1.1.2/dist/axios.min.js"></script>
<script src="{{ asset('assets/js/app.js') }}"></script>
<script src="{{ asset('assets/js/crud.js') }}"></script>
<script>
    // Stepper lement
    var element = document.querySelector("#kt_stepper_example_basic");

    // Initialize Stepper
    var stepper = new KTStepper(element);

    // Handle next step
    stepper.on("kt.stepper.next", function (stepper) {
    stepper.goNext(); // go next step
    if(stepper.currentStepIndex == '2'){
        document.getElementById("continue").style.display = 'none';
        document.getElementById("submit").style.display = 'block';
    }
    });

    // Handle previous step
    stepper.on("kt.stepper.previous", function (stepper) {
    stepper.goPrevious(); // go previous step
    if(stepper.currentStepIndex == '1'){
    document.getElementById("continue").style.display = 'block';
    document.getElementById("submit").style.display = 'none';
    }
    });
</script>
@endsection
