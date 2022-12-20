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
                            <input type="radio" name="kind" onclick="changeOption('apartment')" class="input_radio"
                                value="apartment" id="option1" checked>
                            <label for="option1" class="radio_label">{{ __('site.one_apartment') }}</label>
                            {{-- // --}}
                            <input type="radio" name="kind" onclick="changeOption('villa')" class="input_radio"
                                value="villa" id="option2">
                            <label for="option2" class="radio_label">{{ __('site.villa') }}</label>
                            {{-- // --}}
                            <input type="radio" name="kind" onclick="changeOption('a_land')" class="input_radio"
                                value="a_land" id="option3">
                            <label for="option3" class="radio_label">{{ __('site.a_land') }}</label>
                        </div>

                    </div>
                    <!--end:: kind apartment -->

                    <!--begin::apartment name-->
                    <div class="fv-row mb-10">

                        <label for="name" class="fw-bold fs-6 mb-2">{{ __('site.name_of_apartment') }}</label>
                        <input type="text" name="name" id="name" class="form-control form-control-solid mb-3 mb-lg-0"
                            placeholder="" value="" required />
                        @error('name')
                        <p class="text-danger">{{ $errors->first('name') }}</p>
                        @enderror

                    </div>
                    <!--end::apartment name-->

                    <!--begin::apartment date-->
                    <div id="date" class="fv-row mb-10">

                        <label for="date" class="fw-bold fs-6 mb-2">{{ __('site.date') }}</label>
                        <input type="date" name="date" id="dateId" class="form-control form-control-solid mb-3 mb-lg-0"
                            placeholder="" value="" required />
                        @error('date')
                        <p class="text-danger">{{ $errors->first('date') }}</p>
                        @enderror

                    </div>
                    <!--end::apartment city-->

                    <!--begin::apartment city-->
                    <div class="fv-row mb-10">

                        <label for="city" class="fw-bold fs-6 mb-2">{{ __('site.city') }}</label>
                        <input type="text" name="city" id="city" class="form-control form-control-solid mb-3 mb-lg-0"
                            placeholder="" value="" required />
                        @error('city')
                        <p class="text-danger">{{ $errors->first('city') }}</p>
                        @enderror

                    </div>
                    <!--end::apartment city-->

                    <!--begin::apartment address-->
                    <div class="fv-row mb-10">

                        <label for="address" class="fw-bold fs-6 mb-2">{{ __('site.address') }}</label>
                        <input type="text" name="address" id="address"
                            class="form-control form-control-solid mb-3 mb-lg-0" placeholder="" value="" required />
                        @error('address')
                        <p class="text-danger">{{ $errors->first('address') }}</p>
                        @enderror
                    </div>
                    <!--end::apartment address-->

                    <!--begin::apartment space-->
                    <div class="fv-row mb-10">

                        <label for="space" class="fw-bold fs-6 mb-2">{{ __('site.space') }}</label>
                        <input type="text" name="space" id="space" class="form-control form-control-solid mb-3 mb-lg-0"
                            placeholder="" value="" required />
                        @error('space')
                        <p class="text-danger">{{ $errors->first('space') }}</p>
                        @enderror
                    </div>
                    <!--end::apartment space -->

                    <!--begin::apartment air conditioning -->
                    <div id="air_conditioning" class="fv-row mb-10">
                        <label for="space" class="fw-bold fs-6 mb-2">{{ __('site.type_of_air_conditioning') }}</label>
                        {{-- <div class="btn-group" id="div_radio">
                            <input type="radio" class="btn-check" name="Conditioning" value="window" id="window"
                                autocomplete="off" />
                            <label class="btn btn-secondary" for="window">{{__('site.window')}}</label>

                            <input type="radio" class="btn-check" name="Conditioning" value="split" id="split"
                                autocomplete="off" />
                            <label class="btn btn-secondary" for="split">{{__('site.split')}}</label>

                            <input type="radio" class="btn-check" name="Conditioning" value="central" id="central"
                                autocomplete="off" />
                            <label class="btn btn-secondary" for="central">{{__('site.central')}}</label>

                            <input type="radio" class="btn-check" name="Conditioning" value="not available"
                                id="not_available" autocomplete="off" />
                            <label class="btn btn-secondary" for="not_available">{{__('site.not_available')}}</label>

                        </div> --}}
                        <div id="div_radio1">
                            <input type="radio" name="conditioning" class="input_radio" value="window" id="window">
                            <label for="window" class="radio_label">{{ __('site.window') }}</label>

                            <input type="radio" name="conditioning" class="input_radio" value="split" id="split">
                            <label for="split" class="radio_label">{{ __('site.split') }}</label>

                            <input type="radio" name="conditioning" class="input_radio" value="central" id="central">
                            <label for="central" class="radio_label">{{ __('site.central') }}</label>

                            <input type="radio" name="conditioning" class="input_radio" value="not available"
                                id="not_available">
                            <label for="not_available" class="radio_label">{{ __('site.not_available') }}</label>
                        </div>

                    </div>
                    <!--end::apartment air conditioning -->

                    <!--begin::apartment floor and bedroon number-->
                    <div class="row">
                        <div id="floor" class="col-lg-6 fv-row">
                            <label for="floorid" class="fw-bold fs-6 mb-2">{{ __('site.floor') }}</label>
                            <div style="direction: ltr" class="input-group mb-3">

                                <div class="input-group-prepend">
                                    <span id="a_tag_right" class="input-group-text">
                                        <a onclick="decreaseValue(this,'floorid')">-</a>
                                    </span>
                                </div>

                                <input type="text" class="form-control" name="floor" id="floorid"
                                    aria-label="Amount (to the nearest dollar)">
                                <div class="input-group-append">
                                    <span id="a_tag_left" class="input-group-text">
                                        <a onclick="increaseValue(this, 5,'floorid')">+
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div id="bedroom" class="col-lg-6 fv-row">
                            <label for="space" class="fw-bold fs-6 mb-2">{{ __('site.bedroom') }}</label>
                            <div style="direction: ltr" class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span id="a_tag_right" class="input-group-text"><a
                                            onclick="decreaseValue(this,'bedroomId')">-</a></span>
                                </div>
                                <input type="text" class="form-control" name="bedroom" id="bedroomId"
                                    aria-label="Amount (to the nearest dollar)">
                                <div class="input-group-append">
                                    <span id="a_tag_left" class="input-group-text"><a
                                            onclick="increaseValue(this, 5,'bedroomId')">+
                                        </a></span>
                                </div>
                            </div>
                        </div>
                    </div><br>
                    <!--end::apartment floor and bedroon number-->

                    <!--begin::apartment councils and bathroom number-->
                    <div class="row">
                        <div id="bathroom" class="col-lg-6 fv-row">
                            <label for="space" class="fw-bold fs-6 mb-2">{{ __('site.bathroom') }}</label>
                            <div style="direction: ltr" class="input-group mb-3">

                                <div class="input-group-prepend">
                                    <span id="a_tag_right" class="input-group-text">
                                        <a onclick="decreaseValue(this,'bathroomId')">-</a>
                                    </span>
                                </div>

                                <input type="text" class="form-control" name="bathroom" id="bathroomId"
                                    aria-label="Amount (to the nearest dollar)">
                                <div class="input-group-append">
                                    <span id="a_tag_left" class="input-group-text">
                                        <a onclick="increaseValue(this, 5,'bathroomId')">+
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div id="councils_1" class="col-lg-6 fv-row">
                            <label for="space" class="fw-bold fs-6 mb-2">{{ __('site.councils') }}</label>
                            <div style="direction: ltr" class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span id="a_tag_right" class="input-group-text"><a
                                            onclick="decreaseValue(this,'councils')">-</a></span>
                                </div>
                                <input type="text" class="form-control" name="councils" id="councils"
                                    aria-label="Amount (to the nearest dollar)">
                                <div class="input-group-append">
                                    <span id="a_tag_left" class="input-group-text"><a
                                            onclick="increaseValue(this, 5,'councils')">+
                                        </a></span>
                                </div>
                            </div>

                        </div>
                    </div><br>
                    <!--end::apartment councils and bathroom number-->

                    <!--begin::apartment lounges and Furnishing condition -->
                    <div class="row">
                        <div id="lounge" class="col-lg-6 fv-row">
                            <label for="space" class="fw-bold fs-6 mb-2">{{ __('site.lounges') }}</label>
                            <div style="direction: ltr" class="input-group mb-3">

                                <div class="input-group-prepend">
                                    <span id="a_tag_right" class="input-group-text">
                                        <a onclick="decreaseValue(this,'lounges')">-</a>
                                    </span>
                                </div>

                                <input type="text" class="form-control" name="lounges" id="lounges"
                                    aria-label="Amount (to the nearest dollar)">
                                <div class="input-group-append">
                                    <span id="a_tag_left" class="input-group-text">
                                        <a onclick="increaseValue(this, 5,'lounges')">+
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div id="condition" class="col-lg-6 fv-row">
                            <label for="space" class="fw-bold fs-6 mb-2">{{ __('site.furnishing_condition') }}</label>
                            {{-- <div class="input-group">
                                <div class="btn-group" id="div_radio">
                                    <input type="radio" class="btn-check" name="options" value="yes" id="option1"
                                        autocomplete="off" />
                                    <label class="btn btn-secondary" for="option1">{{__('site.yes')}}</label>

                                    <input type="radio" class="btn-check" name="options" value="no" id="option2"
                                        autocomplete="off" />
                                    <label class="btn btn-secondary" for="option2">{{__('site.no')}}</label>


                                </div> --}}

                                {{--
                            </div> --}}
                            <div style="direction: ltr" id="div_radio_2">
                                <input type="radio" name="furnishing_condition" class="input_radio_2" value="yes"
                                    id="yes" checked>
                                <label for="yes" class="radio_label_2"
                                    style="border-top-left-radius: 8px;border-bottom-left-radius: 8px;">{{
                                    __('site.yes') }}</label>

                                <input type="radio" name="furnishing_condition" class="input_radio_2" value="no"
                                    id="no">
                                <label for="no" class="radio_label_2"
                                    style="border-top-right-radius: 8px;border-bottom-right-radius: 8px;">{{
                                    __('site.no') }}</label>
                            </div>
                        </div>
                    </div><br>
                    <!--end::apartment lounges and Furnishing condition -->

                    <!--begin::apartment parking and kitchen type -->
                    <div class="row">
                        <div id="parking" class="col-lg-6 fv-row">
                            <label for="space" class="fw-bold fs-6 mb-2">{{ __('site.parking') }}</label>
                            {{-- <div class="input-group">
                                <div class="btn-group" id="div_radio">
                                    <input type="radio" class="btn-check" name="parking" value="yes" id="yes"
                                        autocomplete="off" />
                                    <label class="btn btn-secondary" for="yes">{{__('site.yes')}}</label>

                                    <input type="radio" class="btn-check" name="parking" value="no" id="no"
                                        autocomplete="off" />
                                    <label class="btn btn-secondary" for="no">{{__('site.no')}}</label>


                                </div>
                            </div> --}}
                            <div style="direction: ltr" id="div_radio_2">
                                <input type="radio" name="parking" class="input_radio_2" value="yes" id="yes_2" checked>
                                <label for="yes_2" class="radio_label_2"
                                    style="border-top-left-radius: 8px;border-bottom-left-radius: 8px;">{{
                                    __('site.yes') }}</label>

                                <input type="radio" name="parking" class="input_radio_2" value="no" id="no_2">
                                <label for="no_2" class="radio_label_2"
                                    style="border-top-right-radius: 8px;border-bottom-right-radius: 8px;">{{
                                    __('site.no') }}</label>
                            </div>
                        </div>
                        <div id="kitchen" class="col-lg-6 fv-row">
                            <label for="space" class="fw-bold fs-6 mb-2">{{ __('site.type_of_kitchen') }}</label>
                            {{-- <div class="input-group">
                                <div class="btn-group" id="div_radio">
                                    <input type="radio" class="btn-check" name="kitchen" value="open" id="open"
                                        autocomplete="off" />
                                    <label class="btn btn-secondary" for="open">{{__('site.open')}}</label>

                                    <input type="radio" class="btn-check" name="kitchen" value="closed" id="closed"
                                        autocomplete="off" />
                                    <label class="btn btn-secondary" for="closed">{{__('site.closed')}}</label>


                                </div>
                            </div> --}}
                            <div style="direction: ltr" id="div_radio_2">
                                <input type="radio" name="kitchen" class="input_radio_2" value="open" id="open" checked>
                                <label for="open" class="radio_label_2"
                                    style="border-top-left-radius: 8px;border-bottom-left-radius: 8px;">{{
                                    __('site.open') }}</label>

                                <input type="radio" name="kitchen" class="input_radio_2" value="closed" id="closed">
                                <label for="closed" class="radio_label_2"
                                    style="border-top-right-radius: 8px;border-bottom-right-radius: 8px;">{{
                                    __('site.closed') }}</label>
                            </div>
                        </div>
                    </div><br>
                    <!--end::apartment lounges and Furnishing condition -->

                    <!--begin::apartment electricity_meter_number-->
                    <div class="fv-row mb-10" id="electricity">

                        <label for="space" class="fw-bold fs-6 mb-2">{{ __('site.electricity_meter_number') }}</label>
                        <input type="text" name="electricity_meter_number" id="electricity_meter_number"
                            class="form-control form-control-solid mb-3 mb-lg-0" placeholder="" value="" required />
                        @error('electricity_meter_number')
                        <p class="text-danger">{{ $errors->first('electricity_meter_number') }}</p>
                        @enderror
                    </div>
                    <!--end::apartment electricity_meter_number -->

                    <!--begin::apartment water_meter_number-->
                    <div class="fv-row mb-10" id="water_meter">

                        <label for="space" class="fw-bold fs-6 mb-2">{{ __('site.water_meter_number') }}</label>
                        <input type="text" name="water_meter_number" id="water_meter_number"
                            class="form-control form-control-solid mb-3 mb-lg-0" placeholder="" value="" required />
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
                    </div>

                </div>
                <div class="card-footer">
                    <div class="row">

                        <div class="col-9">
                            <button type="button" onclick="addApartment()" id="button" class="btn btn-primary mr-2">{{
                                __('site.submit') }}</button>
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
<script>
    function increaseValue(button, limit, inputid) {
            var value = parseInt(document.getElementById(inputid).value, 10);
            value = isNaN(value) ? 0 : value;
            value++;
            document.getElementById(inputid).value = value;
        } //end increaseValue

        function decreaseValue(button, inputid) {
            var value = parseInt(document.getElementById(inputid).value, 10);
            value = isNaN(value) ? 0 : value;
            value < 1 ? value = 1 : '';
            value--;
            document.getElementById(inputid).value = value;
        } //end decreaseValue

        function changeOption(inputValue) {
            // console.log(inputValue);
            if (inputValue == 'villa') {
                document.getElementById("floor").style.display = 'none';
                document.getElementById("bedroom").style.display = 'block';
                document.getElementById("councils_1").style.display = 'block';
                document.getElementById("bathroom").style.display = 'block';
                document.getElementById("lounge").style.display = 'block';
                document.getElementById("condition").style.display = 'block';

                document.getElementById("parking").style.display = 'block';
                document.getElementById("kitchen").style.display = 'block';

                document.getElementById("electricity").style.display = 'block';
                document.getElementById("water_meter").style.display = 'block';
                document.getElementById("air_conditioning").style.display = 'block';
                document.getElementById("date").style.display = 'block';


            } else if(inputValue == 'apartment'){
                document.getElementById("floor").style.display = 'block';
                document.getElementById("bedroom").style.display = 'block';
                document.getElementById("councils_1").style.display = 'block';
                document.getElementById("bathroom").style.display = 'block';
                document.getElementById("lounge").style.display = 'block';
                document.getElementById("condition").style.display = 'block';

                document.getElementById("parking").style.display = 'block';
                document.getElementById("kitchen").style.display = 'block';

                document.getElementById("electricity").style.display = 'block';
                document.getElementById("water_meter").style.display = 'block';
                document.getElementById("air_conditioning").style.display = 'block';
                document.getElementById("date").style.display = 'block';

            }else {
                document.getElementById("floor").style.display = 'none';
                document.getElementById("bedroom").style.display = 'none';
                document.getElementById("councils_1").style.display = 'none';
                document.getElementById("bathroom").style.display = 'none';
                document.getElementById("lounge").style.display = 'none';
                document.getElementById("condition").style.display = 'none';

                document.getElementById("parking").style.display = 'none';
                document.getElementById("kitchen").style.display = 'none';

                document.getElementById("electricity").style.display = 'none';
                document.getElementById("water_meter").style.display = 'none';
                document.getElementById("air_conditioning").style.display = 'none';
                document.getElementById("date").style.display = 'none';
            }
        } //end changeOption
</script>
@endsection
