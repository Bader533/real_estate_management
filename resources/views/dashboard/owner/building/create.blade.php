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
    #citydiv {
        display: none;
    }

    #addressdiv {
        display: none;
    }
</style>

@endsection

@section('pagename', __('site.buildings'))
@section('object', __('site.add_new_building'))

@section('content')

<div class="row">
    <div class="col-lg-12">
        <!--begin::Card-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">{{ __('site.building_info') }}</h3>
            </div>
            <!--begin::Form-->
            <form id="create-form">
                <div class="card-body">

                    <!--begin::building kind-->
                    <div class="fv-row mb-10">
                        <label for="name" class="fw-bold fs-6 mb-2">{{__('site.in_a_community')}} OR
                            {{__('site.standalone')}}</label>
                        <select name="kind" id="kind" onchange="changeOption()"
                            class="form-select form-select-solid mb-3 mb-lg-0" placeholder="" value="" required>
                            <option value="0">{{__('site.in_a_community')}}</option>
                            <option value="1">{{__('site.standalone')}}</option>
                        </select>
                    </div>
                    <!--end::building kind-->

                    <!--begin::building name-->
                    <div class="fv-row mb-10">

                        <label for="name" class="fw-bold fs-6 mb-2">{{ __('site.name') }}</label>
                        <input type="text" name="name" id="name" class="form-control form-control-solid mb-3 mb-lg-0"
                            placeholder="" value="" required />
                        @error('name')
                        <p class="text-danger">{{ $errors->first('name') }}</p>
                        @enderror

                    </div>
                    <!--end::building name-->

                    <!--begin::building compounds-->
                    <div class="fv-row mb-10" id="compounddiv">
                        <label for="name" class="fw-bold fs-6 mb-2">{{ __('site.compounds') }}</label>
                        <select name="compound_id" id="compound_id" class="form-select form-select-solid mb-3 mb-lg-0"
                            placeholder="" value="" required>
                            @foreach ($compounds as $compound)
                            <option value="{{ $compound->id }}">{{ $compound->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!--end::building compounds-->

                    <!--begin::building city-->
                    <div class="fv-row mb-10" id="citydiv">

                        <label for="city" class="fw-bold fs-6 mb-2">{{ __('site.city') }}</label>
                        <input type="text" name="city" id="city" class="form-control form-control-solid mb-3 mb-lg-0"
                            placeholder="" value="" required />
                        @error('city')
                        <p class="text-danger">{{ $errors->first('city') }}</p>
                        @enderror

                    </div>
                    <!--end::building city-->

                    <!--begin::building address-->
                    <div class="fv-row mb-10" id="addressdiv">

                        <label for="address" class="fw-bold fs-6 mb-2">{{ __('site.address') }}</label>
                        <input type="text" name="address" id="address"
                            class="form-control form-control-solid mb-3 mb-lg-0" placeholder="" value="" required />
                        @error('address')
                        <p class="text-danger">{{ $errors->first('address') }}</p>
                        @enderror
                    </div>
                    <!--end::building address-->

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
                            <button type="button" onclick="addBuilding()" id="button"
                                class="btn btn-primary mr-2">{{__('site.submit')}}</button>
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
<script>
    function changeOption() {
            var e = document.getElementById("kind");
            var kind = e.options[e.selectedIndex].value;
            console.log(kind);
            if (kind == 0) {
                document.getElementById("citydiv").style.display = 'none';
                document.getElementById("addressdiv").style.display = 'none';
                document.getElementById("compounddiv").style.display = 'block';

            } else {
                document.getElementById("citydiv").style.display = 'block';
                document.getElementById("addressdiv").style.display = 'block';
                document.getElementById("compounddiv").style.display = 'none';
            }
        } //end changeOption

</script>
@endsection
