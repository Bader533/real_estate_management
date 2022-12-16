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
    #a_tag_right {
        border-top-right-radius: 0px;
        border-bottom-right-radius: 0px;
    }

    #a_tag_left {
        border-top-left-radius: 0px;
        border-bottom-left-radius: 0px;
    }

    #div_radio {
        width: 100%;
    }

    @media only screen and (max-width: 667px) {
        #div_radio {
            width: 100%;
        }
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
                    <div class="fv-row mb-10" id="">

                        <label for="date" class="fw-bold fs-6 mb-2">{{ __('site.date') }}</label>
                        <input type="date" name="date" id="date" class="form-control form-control-solid mb-3 mb-lg-0"
                            placeholder="" value="" required />
                        @error('city')
                        <p class="text-danger">{{ $errors->first('city') }}</p>
                        @enderror

                    </div>
                    <!--end::apartment city-->

                    <!--begin::apartment city-->
                    <div class="fv-row mb-10" id="">

                        <label for="city" class="fw-bold fs-6 mb-2">{{ __('site.city') }}</label>
                        <input type="text" name="city" id="city" class="form-control form-control-solid mb-3 mb-lg-0"
                            placeholder="" value="" required />
                        @error('city')
                        <p class="text-danger">{{ $errors->first('city') }}</p>
                        @enderror

                    </div>
                    <!--end::apartment city-->

                    <!--begin::apartment address-->
                    <div class="fv-row mb-10" id="">

                        <label for="address" class="fw-bold fs-6 mb-2">{{ __('site.address') }}</label>
                        <input type="text" name="address" id="address"
                            class="form-control form-control-solid mb-3 mb-lg-0" placeholder="" value="" required />
                        @error('address')
                        <p class="text-danger">{{ $errors->first('address') }}</p>
                        @enderror
                    </div>
                    <!--end::apartment address-->

                    <!--begin::apartment space-->
                    <div class="fv-row mb-10" id="">

                        <label for="space" class="fw-bold fs-6 mb-2">{{ __('site.space') }}</label>
                        <input type="text" name="space" id="space" class="form-control form-control-solid mb-3 mb-lg-0"
                            placeholder="" value="" required />
                        @error('space')
                        <p class="text-danger">{{ $errors->first('space') }}</p>
                        @enderror
                    </div>
                    <!--end::apartment space -->

                    <!--begin::apartment air conditioning -->
                    <div class="fv-row mb-10" id="">
                        <label for="space" class="fw-bold fs-6 mb-2">{{ __('site.type_of_air_conditioning') }}</label>
                        <div class="btn-group" id="div_radio">
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

                        </div>

                    </div>
                    <!--end::apartment air conditioning -->

                    <!--begin::apartment floor and bedroon number-->
                    <div class="row">
                        <div class="col-lg-6 fv-row">
                            <label for="space" class="fw-bold fs-6 mb-2">{{ __('site.floor') }}</label>
                            <div class="input-group mb-3">

                                <div class="input-group-prepend">
                                    <span id="a_tag_right" class="input-group-text">
                                        <a onclick="decreaseValue(this)">-</a>
                                    </span>
                                </div>

                                <input type="text" class="form-control" name="floor" id="floor"
                                    aria-label="Amount (to the nearest dollar)">
                                <div class="input-group-append">
                                    <span id="a_tag_left" class="input-group-text">
                                        <a onclick="increaseValue(this, 5)">+
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 fv-row">
                            <label for="space" class="fw-bold fs-6 mb-2">{{ __('site.bedroom') }}</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span id="a_tag_right" class="input-group-text"><a
                                            onclick="decreaseValue(this)">-</a></span>
                                </div>
                                <input type="text" class="form-control" name="bedroom" id="bedroom"
                                    aria-label="Amount (to the nearest dollar)">
                                <div class="input-group-append">
                                    <span id="a_tag_left" class="input-group-text"><a onclick="increaseValue(this, 5)">+
                                        </a></span>
                                </div>
                            </div>
                        </div>
                    </div><br>
                    <!--end::apartment floor and bedroon number-->

                    <!--begin::apartment councils and bathroom number-->
                    <div class="row">
                        <div class="col-lg-6 fv-row">
                            <label for="space" class="fw-bold fs-6 mb-2">{{ __('site.bathroom') }}</label>
                            <div class="input-group mb-3">

                                <div class="input-group-prepend">
                                    <span id="a_tag_right" class="input-group-text">
                                        <a onclick="decreaseValue(this)">-</a>
                                    </span>
                                </div>

                                <input type="text" class="form-control" name="bathroom" id="bathroom"
                                    aria-label="Amount (to the nearest dollar)">
                                <div class="input-group-append">
                                    <span id="a_tag_left" class="input-group-text">
                                        <a onclick="increaseValue(this, 5)">+
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 fv-row">
                            <label for="space" class="fw-bold fs-6 mb-2">{{ __('site.councils') }}</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span id="a_tag_right" class="input-group-text"><a
                                            onclick="decreaseValue(this)">-</a></span>
                                </div>
                                <input type="text" class="form-control" name="councils" id="councils"
                                    aria-label="Amount (to the nearest dollar)">
                                <div class="input-group-append">
                                    <span id="a_tag_left" class="input-group-text"><a onclick="increaseValue(this, 5)">+
                                        </a></span>
                                </div>
                            </div>
                        </div>
                    </div><br>
                    <!--end::apartment councils and bathroom number-->
{{-- // --}}
                    <!--begin::apartment lounges and Furnishing condition -->
                    <div class="row">
                        <div class="col-lg-6 fv-row">
                            <label for="space" class="fw-bold fs-6 mb-2">{{ __('site.lounges') }}</label>
                            <div class="input-group mb-3">

                                <div class="input-group-prepend">
                                    <span id="a_tag_right" class="input-group-text">
                                        <a onclick="decreaseValue(this)">-</a>
                                    </span>
                                </div>

                                <input type="text" class="form-control" name="lounges" id="lounges"
                                    aria-label="Amount (to the nearest dollar)">
                                <div class="input-group-append">
                                    <span id="a_tag_left" class="input-group-text">
                                        <a onclick="increaseValue(this, 5)">+
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 fv-row">
                            <label for="space" class="fw-bold fs-6 mb-2">{{ __('site.furnishing_condition') }}</label>
                            <div class="input-group">
                                <div class="btn-group" id="div_radio">
                                    <input type="radio" class="btn-check" name="options" value="yes" id="option1"
                                        autocomplete="off" />
                                    <label class="btn btn-secondary" for="option1">{{__('site.yes')}}</label>

                                    <input type="radio" class="btn-check" name="options" value="no" id="option2"
                                        autocomplete="off" />
                                    <label class="btn btn-secondary" for="option2">{{__('site.no')}}</label>


                                </div>
                            </div>
                        </div>
                    </div><br>
                    <!--end::apartment lounges and Furnishing condition -->

                    <!--begin::apartment parking and kitchen type -->
                    <div class="row">
                        <div class="col-lg-6 fv-row">
                            <label for="space" class="fw-bold fs-6 mb-2">{{ __('site.parking') }}</label>
                            <div class="input-group">
                                <div class="btn-group" id="div_radio">
                                    <input type="radio" class="btn-check" name="parking" value="yes" id="yes"
                                        autocomplete="off" />
                                    <label class="btn btn-secondary" for="yes">{{__('site.yes')}}</label>

                                    <input type="radio" class="btn-check" name="parking" value="no" id="no"
                                        autocomplete="off" />
                                    <label class="btn btn-secondary" for="no">{{__('site.no')}}</label>


                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 fv-row">
                            <label for="space" class="fw-bold fs-6 mb-2">{{ __('site.type_of_kitchen') }}</label>
                            <div class="input-group">
                                <div class="btn-group" id="div_radio">
                                    <input type="radio" class="btn-check" name="kitchen" value="open" id="open"
                                        autocomplete="off" />
                                    <label class="btn btn-secondary" for="open">{{__('site.open')}}</label>

                                    <input type="radio" class="btn-check" name="kitchen" value="closed" id="closed"
                                        autocomplete="off" />
                                    <label class="btn btn-secondary" for="closed">{{__('site.closed')}}</label>


                                </div>
                            </div>
                        </div>
                    </div><br>
                    <!--end::apartment lounges and Furnishing condition -->

                    <!--begin::apartment electricity_meter_number-->
                    <div class="fv-row mb-10" id="">

                        <label for="space" class="fw-bold fs-6 mb-2">{{ __('site.electricity_meter_number') }}</label>
                        <input type="text" name="space" id="space" class="form-control form-control-solid mb-3 mb-lg-0"
                            placeholder="" value="" required />
                        @error('space')
                        <p class="text-danger">{{ $errors->first('space') }}</p>
                        @enderror
                    </div>
                    <!--end::apartment electricity_meter_number -->

                    <!--begin::apartment water_meter_number-->
                    <div class="fv-row mb-10" id="">

                        <label for="space" class="fw-bold fs-6 mb-2">{{ __('site.water_meter_number') }}</label>
                        <input type="text" name="space" id="space" class="form-control form-control-solid mb-3 mb-lg-0"
                            placeholder="" value="" required />
                        @error('space')
                        <p class="text-danger">{{ $errors->first('space') }}</p>
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
                            <button type="button" onclick="addBuilding()" id="button" class="btn btn-primary mr-2">{{
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
    function increaseValue() {
        var value = parseInt(document.getElementById('number').value, 10);
        value = isNaN(value) ? 0 : value;
        value++;
        document.getElementById('number').value = value;
    }

    function decreaseValue() {
        var value = parseInt(document.getElementById('number').value, 10);
        value = isNaN(value) ? 0 : value;
        value < 1 ? value = 1 : '';
        value--;
        document.getElementById('number').value = value;
    }
</script>
@endsection
