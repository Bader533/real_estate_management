@extends('dashboard.index')

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@if (app()->getLocale() == 'ar')
<style>
    .row {
        direction: rtl;
    }
</style>
@endif
<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>
@endsection

@section('pagename', __('site.apartment'))
@section('object', __('site.add_new_apartment'))

@section('content')

<div class="row">
    <div class="col-lg-12">

        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">{{ __('site.apartment_info') }}</h3>
            </div>
            <!--begin::Form-->
            <form id="create-form">
                <div class="card-body">

                    <!--begin:: kind apartment  -->
                    <div class="fv-row mb-10">
                        <div id="div_radio1">
                            <input type="radio" name="kind" class="input_radio" value="office" id="option1"
                                @if($apartment->kind == 'office') checked @endif>
                            <label for="option1" class="radio_label">{{ __('site.office') }}</label>
                            {{-- // --}}
                            <input type="radio" name="kind" class="input_radio" value="showroom" id="option2"
                                @if($apartment->kind == 'showroom') checked @endif>
                            <label for="option2" class="radio_label">{{ __('site.showroom') }}</label>
                            {{-- // --}}
                            <input type="radio" name="kind" class="input_radio" value="commercial_station" id="option3"
                                @if($apartment->kind == 'commercial_station') checked @endif>
                            <label for="option3" class="radio_label">{{ __('site.commercial_station') }}</label>
                            {{-- // --}}
                            <input type="radio" name="kind" class="input_radio" value="storehouse" id="option4"
                                @if($apartment->kind == 'storehouse') checked @endif>
                            <label for="option4" class="radio_label">{{ __('site.storehouse') }}</label>
                        </div>

                    </div>
                    <!--end:: kind apartment -->

                    <!--begin::apartment name-->
                    <div class="fv-row mb-10">

                        <label for="name" class="fw-bold fs-6 mb-2">{{ __('site.name_of_apartment') }}</label>
                        <input type="text" name="name" id="name" class="form-control form-control-solid mb-3 mb-lg-0"
                            placeholder="" value="{{$apartment->apartment_name}}" required />
                        @error('name')
                        <p class="text-danger">{{ $errors->first('name') }}</p>
                        @enderror

                    </div>
                    <!--end::apartment name-->
                    <!--begin::apartment date-->
                    <div id="date" class="fv-row mb-10">

                        <label for="date" class="fw-bold fs-6 mb-2">{{ __('site.date') }}</label>
                        <input type="date" name="date" id="dateId" class="form-control form-control-solid mb-3 mb-lg-0"
                            placeholder="" value="{{$apartment->apartment_date_added}}" required />
                        @error('date')
                        <p class="text-danger">{{ $errors->first('date') }}</p>
                        @enderror

                    </div>
                    <!--end::apartment city-->

                    <!--begin::apartment city-->
                    <div class="fv-row mb-10">

                        <label for="city" class="fw-bold fs-6 mb-2">{{ __('site.city') }}</label>
                        <input type="text" name="city" id="city" class="form-control form-control-solid mb-3 mb-lg-0"
                            placeholder="" value="{{$apartment->city}}" required />
                        @error('city')
                        <p class="text-danger">{{ $errors->first('city') }}</p>
                        @enderror

                    </div>
                    <!--end::apartment city-->

                    <!--begin::apartment address-->
                    <div class="fv-row mb-10">

                        <label for="address" class="fw-bold fs-6 mb-2">{{ __('site.address') }}</label>
                        <input type="text" name="address" id="address"
                            class="form-control form-control-solid mb-3 mb-lg-0" placeholder=""
                            value="{{$apartment->address}}" required />
                        @error('address')
                        <p class="text-danger">{{ $errors->first('address') }}</p>
                        @enderror
                    </div>
                    <!--end::apartment address-->

                    <!--begin::apartment space-->
                    <div class="fv-row mb-10">

                        <label for="space" class="fw-bold fs-6 mb-2">{{ __('site.space') }}</label>
                        <input type="text" name="space" id="space" class="form-control form-control-solid mb-3 mb-lg-0"
                            placeholder="" value="{{$apartment->space}}" required />
                        @error('space')
                        <p class="text-danger">{{ $errors->first('space') }}</p>
                        @enderror
                    </div>
                    <!--end::apartment space -->

                    <!--begin::apartment air conditioning -->
                    <div id="air_conditioning" class="fv-row mb-10">
                        <label for="space" class="fw-bold fs-6 mb-2">{{ __('site.type_of_air_conditioning') }}</label>
                        <div id="div_radio1">
                            <input type="radio" name="conditioning" class="input_radio" value="window" id="window"
                                @if($apartment->ac_type =='window') checked @endif>
                            <label for="window" class="radio_label">{{ __('site.window') }}</label>

                            <input type="radio" name="conditioning" class="input_radio" value="split" id="split"
                                @if($apartment->ac_type =='split') checked @endif>
                            <label for="split" class="radio_label">{{ __('site.split') }}</label>

                            <input type="radio" name="conditioning" class="input_radio" value="central" id="central"
                                @if($apartment->ac_type =='central') checked @endif>
                            <label for="central" class="radio_label">{{ __('site.central') }}</label>

                            <input type="radio" name="conditioning" class="input_radio" value="not available"
                                id="not_available" @if($apartment->ac_type =='not available') checked @endif>
                            <label for="not_available" class="radio_label">{{ __('site.not_available') }}</label>
                        </div>
                    </div>
                    <!--end::apartment air conditioning -->

                    <!--begin::apartment electricity_meter_number-->
                    <div class="fv-row mb-10" id="electricity">

                        <label for="space" class="fw-bold fs-6 mb-2">{{ __('site.electricity_meter_number') }}</label>
                        <input type="text" name="electricity_meter_number" id="electricity_meter_number"
                            class="form-control form-control-solid mb-3 mb-lg-0" placeholder=""
                            value="{{$apartment->electricity_meter_number}}" required />
                        @error('electricity_meter_number')
                        <p class="text-danger">{{ $errors->first('electricity_meter_number') }}</p>
                        @enderror
                    </div>
                    <!--end::apartment electricity_meter_number -->

                    <!--begin::apartment water_meter_number-->
                    <div class="fv-row mb-10" id="water_meter">

                        <label for="space" class="fw-bold fs-6 mb-2">{{ __('site.water_meter_number') }}</label>
                        <input type="text" name="water_meter_number" id="water_meter_number"
                            class="form-control form-control-solid mb-3 mb-lg-0" placeholder=""
                            value="{{$apartment->water_meter_number}}" required />
                        @error('water_meter_number')
                        <p class="text-danger">{{ $errors->first('water_meter_number') }}</p>
                        @enderror
                    </div>
                    <!--end::apartment water_meter_number -->

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
                        @if (count($apartment->images) != 0)
                        @foreach ($apartment->images as $key => $image)
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

                        <div class="col-9">
                            <button type="button" onclick="addApartment('{{ $apartment->id }}')" id="button"
                                class="btn btn-primary mr-2">{{
                                __('site.edit') }}</button>
                            <button type="reset" class="btn btn-secondary">{{ __('site.cancel') }}</button>
                        </div>
                    </div>
                </div>
            </form>
            <!--end::Form-->
        </div>

    </div>
</div>

@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>
<script src="https://unpkg.com/axios@1.1.2/dist/axios.min.js"></script>
<script src="{{ asset('assets/js/app.js') }}"></script>
<script src="{{ asset('assets/js/crud.js') }}"></script>

@endsection
