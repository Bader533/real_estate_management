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
            </div>
            <!--begin::Form-->
            <form id="create-form">
                <div class="card-body">

                    <!--begin:: name-->
                    <div class="fv-row mb-10">

                        <label for="name" class="fw-bold fs-6 mb-2">{{ __('site.name') }}</label>
                        <input type="text" name="name" id="name" class="form-control form-control-solid mb-3 mb-lg-0"
                            placeholder="" value="{{$tenant->name}}" required />

                    </div>
                    <!--end:: name-->

                    <!--begin:: email-->
                    <div class="fv-row mb-10">

                        <label for="email" class="fw-bold fs-6 mb-2">{{ __('site.email') }}</label>
                        <input type="eamil" name="email" id="email" class="form-control form-control-solid mb-3 mb-lg-0"
                            placeholder="" value="{{$tenant->email}}" required />

                    </div>
                    <!--end:: email-->

                    <!--begin:: phone-->
                    <div class="fv-row mb-10">

                        <label for="phone" class="fw-bold fs-6 mb-2">{{ __('site.phone') }}</label>
                        <input type="text" name="phone" id="phone" class="form-control form-control-solid mb-3 mb-lg-0"
                            placeholder="" value="{{$tenant->phone}}" required />

                    </div>
                    <!--end:: phone-->

                    <!--begin:: nationality-->
                    <div class="fv-row mb-10">

                        <label for="nationality" class="fw-bold fs-6 mb-2">{{ __('site.nationality') }}</label>
                        <input type="text" name="nationality" id="nationality"
                            class="form-control form-control-solid mb-3 mb-lg-0" placeholder=""
                            value="{{$tenant->nationality}}" required />

                    </div>
                    <!--end:: nationality-->

                    <!--begin:: id_number-->
                    <div class="fv-row mb-10">

                        <label for="id_number" class="fw-bold fs-6 mb-2">{{ __('site.id_number') }}</label>
                        <input type="text" name="id_number" id="id_number"
                            class="form-control form-control-solid mb-3 mb-lg-0" placeholder="" value="{{$tenant->ssl}}"
                            required />

                    </div>
                    <!--end:: id_number-->

                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-9">
                            <button type="button" onclick="editTenant('{{ $tenant->id }}')" id="button"
                                class="btn btn-primary mr-2">{{
                                __('site.edit') }}</button>
                            <button type="reset" class="btn btn-secondary">{{ __('site.cancel') }}</button>
                        </div>
                    </div>
                </div>
            </form>
            <!--end::Form-->
        </div>
        <!--end::Card-->
    </div>
</div>

@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>
<script src="https://unpkg.com/axios@1.1.2/dist/axios.min.js"></script>
<script>
    function editTenant(id) {
            axios.put('/tenant/'+ id , {
                    name: document.getElementById('name').value,
                    email: document.getElementById('email').value,
                    phone: document.getElementById('phone').value,
                    nationality: document.getElementById('nationality').value,
                    id_number: document.getElementById('id_number').value,
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
