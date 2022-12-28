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

@section('pagename', __('site.compounds'))
@section('object', __('site.edit_compund_info'))

@section('content')

<div class="row">
    <div class="col-lg-12">
        <!--begin::Card-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">{{ __('site.compound_info') }}</h3>
            </div>
            <!--begin::Form-->
            <form id="create-form">
                {{-- @csrf
                @method('PUT') --}}
                <div class="card-body">

                    @if ($propertyOwner->name != null && $propertyOwner->company_name == null)

                    <!--begin:: name-->
                    <div class="fv-row mb-10">

                        <label for="name" class="fw-bold fs-6 mb-2">{{ __('site.name') }}</label>
                        <input type="text" name="name" id="name" class="form-control form-control-solid mb-3 mb-lg-0"
                            placeholder="" value="{{$propertyOwner->name}}" required />

                    </div>
                    <!--end:: name-->

                    @elseif ($propertyOwner->name == null && $propertyOwner->company_name != null)

                    <!--begin::company name-->
                    <div class="fv-row mb-10">

                        <label for="name" class="fw-bold fs-6 mb-2">{{ __('site.name') }}</label>
                        <input type="text" name="name" id="name" class="form-control form-control-solid mb-3 mb-lg-0"
                            placeholder="" value="{{$propertyOwner->company_name}}" required />

                    </div>

                    <!--end::company name-->

                    @endif


                    <!--begin::email-->
                    <div class="fv-row mb-10">

                        <label for="email" class="fw-bold fs-6 mb-2">{{ __('site.email') }}</label>
                        <input type="text" name="email" id="email" class="form-control form-control-solid mb-3 mb-lg-0"
                            placeholder="" value="{{$propertyOwner->email}}" required />

                    </div>
                    <!--end::email-->

                    <!--begin:: phone-->
                    <div class="fv-row mb-10">

                        <label for="phone" class="fw-bold fs-6 mb-2">{{ __('site.phone') }}</label>
                        <input type="text" name="phone" id="phone" class="form-control form-control-solid mb-3 mb-lg-0"
                            placeholder="" value="{{$propertyOwner->phone}}" required />

                    </div>
                    <!--end:: phone-->

                    <!--begin:: password-->
                    <div class="fv-row mb-10">

                        <label for="password" class="fw-bold fs-6 mb-2">{{ __('site.password') }}</label>
                        <input type="password" name="password" id="password"
                            class="form-control form-control-solid mb-3 mb-lg-0" placeholder="" value="" />

                    </div>
                    <!--end:: password-->

                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-9" id="button-group">
                            <button type="button" onclick="editOnwer('{{$propertyOwner->id}}')" id="button"
                                class="btn btn-primary mr-2">{{__('site.edit')}}</button>
                            <button type="reset" class="btn btn-secondary">{{__('site.cancel')}}</button>
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
    function editOnwer(id) {
            axios.put('/owner/' + id, {

                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
                phone: document.getElementById('phone').value,
                password: document.getElementById('password').value,

            })
            .then(function (response) {
                //2xx
                console.log(response);
                toastr.success(response.data.message);
                window.location.href = "/";

            })
            .catch(function (error) {
                //4xx - 5xx
                console.log(error.response.data.message);
                toastr.error(error.response.data.message)

            });
        }
</script>
@endsection
