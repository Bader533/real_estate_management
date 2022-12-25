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
@endsection

@section('pagename', __('site.tenants'))
@section('object', __('site.add_new_tenant'))

@section('content')

<div class="row">
    <div class="col-lg-12">
        <!--begin::Card-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">{{ __('site.tenant_info') }}</h3>
                <div class="card-toolbar">
                    <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                        <a href="{{ route('tenant.edit',$tenant->id) }}" class="btn btn-primary">{{ __('site.edit')
                            }}</a>

                    </div>
                </div>
            </div>

            <!--begin::Form-->
            <form id="create-form">
                <div class="card-body">

                    <!--begin::compound name-->
                    <div class="fv-row mb-10">

                        <label for="name" class="fw-bold fs-6 mb-2">{{ __('site.name') }}</label>
                        <input type="text" name="name" id="name" class="form-control form-control-solid mb-3 mb-lg-0"
                            placeholder="" value="{{$tenant->name}}" disabled />

                    </div>
                    <!--end::compound name-->

                    <!--begin::compound email-->
                    <div class="fv-row mb-10">

                        <label for="email" class="fw-bold fs-6 mb-2">{{ __('site.email') }}</label>
                        <input type="eamil" name="email" id="email" class="form-control form-control-solid mb-3 mb-lg-0"
                            placeholder="" value="{{$tenant->email}}" disabled />

                    </div>
                    <!--end::compound email-->

                    <!--begin::compound address-->
                    <div class="fv-row mb-10">

                        <label for="phone" class="fw-bold fs-6 mb-2">{{ __('site.phone') }}</label>
                        <input type="text" name="phone" id="phone" class="form-control form-control-solid mb-3 mb-lg-0"
                            placeholder="" value="{{$tenant->phone}}" disabled />

                    </div>
                    <!--end::compound address-->

                </div>
            </form>
            <!--End::Form-->
        </div>
    </div>
</div>

@endsection

@section('js')

@endsection
