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
                <div class="card-body">

                    <!--begin::compound name-->
                    <div class="fv-row mb-10">

                        <label for="name" class="fw-bold fs-6 mb-2">{{ __('site.name') }}</label>
                        <input type="text" name="name" id="name" class="form-control form-control-solid mb-3 mb-lg-0"
                            placeholder="" value="{{ $compound->name }}" required />

                    </div>
                    <!--end::compound name-->

                    <!--begin::compound city-->
                    <div class="fv-row mb-10">

                        <label for="city" class="fw-bold fs-6 mb-2">{{ __('site.city') }}</label>
                        <input type="text" name="city" id="city" class="form-control form-control-solid mb-3 mb-lg-0"
                            placeholder="" value="{{ $compound->city }}" required />

                    </div>
                    <!--end::compound city-->

                    <!--begin::compound address-->
                    <div class="fv-row mb-10">

                        <label for="address" class="fw-bold fs-6 mb-2">{{ __('site.address') }}</label>
                        <input type="text" name="address" id="address"
                            class="form-control form-control-solid mb-3 mb-lg-0" placeholder=""
                            value="{{ $compound->address }}" required />

                    </div>
                    <!--end::compound address-->

                    {{-- compound images --}}
                    <div class="dragover">
                        <span class="inner">
                            {{ __('site.upload_images') }}
                            <span class="select" role="button">{{ __('site.browse') }}</span>
                        </span>

                        <input name="images[]" type="file" class="file" multiple />
                    </div>
                    {{-- end compound images --}}
                    <div class="container">
                        @if (count($compound->images) != 0)
                        @foreach ($compound->images as $key => $image)
                        <div class="image" id="imageDiv">
                            <img src="{{ asset($image->url) }}" alt="image">
                            <span onclick="performDelete('/compound/image/','{{ $image->id }}')">&times;</span>
                        </div>
                        @endforeach
                        @endif
                    </div>

                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-9" id="button-group">
                            <button type="button" onclick="addCompound('{{ $compound->id }}')" id="button"
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
<script src="{{ asset('assets/js/app.js') }}"></script>
<script src="{{ asset('assets/js/crud.js') }}"></script>
@endsection
