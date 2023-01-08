@extends('dashboard.index')

@section('css')

<link href="netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
@if (app()->getLocale() == 'ar')
<style>
    #kt_content_container {
        direction: rtl;
    }
</style>
@endif
<style>
    #home-tab2 {
        font-size: 14px;
    }
</style>
@endsection

@section('pagename', __('site.apartment'))
@section('object', __('site.apartment_info'))

@section('content')
<!--begin::Modal - compound - Add-->
<div class="modal fade" id="kt_modal_add_compound" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Form-->
            <form class="form" action="{{route('apartment.create.type')}}" method="get" id="kt_modal_add_compound_form"
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
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)"
                                    fill="black" />
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
                            <div id="condition" class="col-lg-12 fv-row">
                                <div style="direction: ltr" id="div_radio_2">

                                    <input type="radio" name="apartment-type" class="input_radio_2" value="commercial"
                                        id="commercial" checked>
                                    <label for="commercial" class="radio_label_2" style="border-radius: 8px;">{{
                                        __('site.commercial') }}</label>&nbsp; &nbsp;

                                    <input type="radio" name="apartment-type" class="input_radio_2" value="residential"
                                        id="residential">
                                    <label for="residential" class="radio_label_2" style="border-radius: 8px;">{{
                                        __('site.residential') }}</label>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!--begin::Modal footer-->
                <div class="modal-footer flex-center">
                    <!--begin::Button-->
                    <button type="reset" id="kt_modal_add_compound_cancel" class="btn btn-light me-3">Discard</button>
                    <!--end::Button-->
                    <!--begin::Button-->
                    <button type="submit" id="kt_modal_add_compound_submit" class="btn btn-primary">
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
<div id="kt_content_container" class="container-xxl">
    <div class="card">
        <div id="add-search" class="card-header border-0 pt-5">

            <div class="card-title">
                <a href="#">
                    <h3>{{__('site.apartment')}}</h3>
                </a>
            </div>

            <div class="card-toolbar">
                <a href="{{route('apartment.import')}}" class="btn btn-light-primary me-3"
                    data-bs-target="#kt_customers_export_modal">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr078.svg-->
                    <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.3" x="12.75" y="4.25" width="12" height="2" rx="1"
                                transform="rotate(90 12.75 4.25)" fill="black" />
                            <path
                                d="M12.0573 6.11875L13.5203 7.87435C13.9121 8.34457 14.6232 8.37683 15.056 7.94401C15.4457 7.5543 15.4641 6.92836 15.0979 6.51643L12.4974 3.59084C12.0996 3.14332 11.4004 3.14332 11.0026 3.59084L8.40206 6.51643C8.0359 6.92836 8.0543 7.5543 8.44401 7.94401C8.87683 8.37683 9.58785 8.34458 9.9797 7.87435L11.4427 6.11875C11.6026 5.92684 11.8974 5.92684 12.0573 6.11875Z"
                                fill="black" />
                            <path
                                d="M18.75 8.25H17.75C17.1977 8.25 16.75 8.69772 16.75 9.25C16.75 9.80228 17.1977 10.25 17.75 10.25C18.3023 10.25 18.75 10.6977 18.75 11.25V18.25C18.75 18.8023 18.3023 19.25 17.75 19.25H5.75C5.19772 19.25 4.75 18.8023 4.75 18.25V11.25C4.75 10.6977 5.19771 10.25 5.75 10.25C6.30229 10.25 6.75 9.80228 6.75 9.25C6.75 8.69772 6.30229 8.25 5.75 8.25H4.75C3.64543 8.25 2.75 9.14543 2.75 10.25V19.25C2.75 20.3546 3.64543 21.25 4.75 21.25H18.75C19.8546 21.25 20.75 20.3546 20.75 19.25V10.25C20.75 9.14543 19.8546 8.25 18.75 8.25Z"
                                fill="#C4C4C4" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->Import
                </a>
                <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                    <a href="" data-bs-toggle="modal" data-bs-target="#kt_modal_add_compound"
                        class="btn btn-primary">{{__('site.add_apartment')}}</a>

                </div>
            </div>
        </div><br>
        <div class="card-body pt-0">
            {{-- /////////////////////// --}}
            <div class="col-lg-6 container text-center">
                <div class="" id="div_tab">
                    <ul class="nav nav-pills nav-fill gap-2 p-1 small bg-white border rounded-5 shadow-sm  "
                        id="pillNav2" role="tablist">
                        <li class="nav-item" role="presentation"><a href="{{route('compound.index')}}">
                                <button class="nav-link rounded-5" id="home-tab2" data-bs-toggle="tab" type="button"
                                    role="tab" aria-selected="false" tabindex="-1">{{__('site.compounds')}}</button>
                            </a> </li>
                        <li class="nav-item" role="presentation"><a href="{{route('building.index')}}">
                                <button class="nav-link rounded-5" id="home-tab2" data-bs-toggle="tab" type="button"
                                    role="tab" aria-selected="false" tabindex="-1">{{__('site.building')}}</button>
                            </a></li>
                        <li class="nav-item" role="presentation"><a href="{{route('apartment.index')}}">
                                <button class="nav-link rounded-5 active" id="home-tab2" data-bs-toggle="tab"
                                    type="button" role="tab" aria-selected="true"> {{__('site.one_apartment')}}
                                </button>
                            </a></li>
                    </ul>
                </div>
            </div><br>
            {{-- /////////////////////// --}}
            <div id="add-search" class="card-header border-0 pt-5">

                <div class="card-title">
                    <small class="text-muted">{{__('site.count')}} : {{$apartments->count()}}</small>
                </div>

                <div class="card-toolbar">
                    <div class="d-flex align-items-center position-relative my-1">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                        <span class="svg-icon svg-icon-1 position-absolute ms-6">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                                    transform="rotate(45 17.0365 15.1223)" fill="black" />
                                <path
                                    d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                    fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                        <input type="text" data-kt-customer-table-filter="search" id="search"
                            class="form-control form-control-solid w-250px ps-15"
                            placeholder="{{__('site.search_apartments')}}" />
                    </div>
                </div>
            </div><br>
            <div class="container text-center">
                <div class="row row-cols-2" id="div_content_data">
                    @foreach ($apartments as $apartment)
                    <div class="col" id="div_content" style=" padding: 0;">
                        <div class="card mb-3" id="div_card" style="">
                            <div class="row g-0">
                                <div class="col-md-4">

                                    @if ($apartment->images->isNotEmpty())

                                    @foreach ($apartment->images as $image)
                                    <img src="{{asset($image->url)}}" style="height: 100%;"
                                        class="img-fluid rounded-start" alt="...">
                                    @break
                                    @endforeach

                                    @else

                                    <img src="https://via.placeholder.com/200" style="height: 100%;"
                                        class="img-fluid rounded-start" alt="...">

                                    @endif
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <div style="display: flex; justify-content: space-between;">
                                            <h5 class="card-title text-start "><a
                                                    href="{{route('apartment.show',$apartment->id)}}">{{$apartment->apartment_name}}</a>
                                            </h5>
                                            <a href="{{route('apartment.edit',$apartment->id)}}"
                                                style="text-decoration: none; color: #17191b;">Edit</a>
                                        </div>
                                        <ul class="text-start" style="list-style-type: none; padding: 0;">
                                            @if ($apartment->kind == 'apartment' || $apartment->kind == 'villa')
                                            <li style="margin-bottom: 5px;">
                                                <p class="card-text text-start">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        viewBox="0 0 384 512">
                                                        <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                                        <path
                                                            d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 256c-35.3 0-64-28.7-64-64s28.7-64 64-64s64 28.7 64 64s-28.7 64-64 64z" />
                                                    </svg>
                                                    {{$apartment->city}} , {{$apartment->address}}
                                                </p>
                                            </li>
                                            @endif
                                            <li style="margin-bottom: 5px;">
                                                <p class="card-text text-start">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        viewBox="0 0 384 512">
                                                        <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                                        <path
                                                            d="M88 104C88 95.16 95.16 88 104 88H152C160.8 88 168 95.16 168 104V152C168 160.8 160.8 168 152 168H104C95.16 168 88 160.8 88 152V104zM280 88C288.8 88 296 95.16 296 104V152C296 160.8 288.8 168 280 168H232C223.2 168 216 160.8 216 152V104C216 95.16 223.2 88 232 88H280zM88 232C88 223.2 95.16 216 104 216H152C160.8 216 168 223.2 168 232V280C168 288.8 160.8 296 152 296H104C95.16 296 88 288.8 88 280V232zM280 216C288.8 216 296 223.2 296 232V280C296 288.8 288.8 296 280 296H232C223.2 296 216 288.8 216 280V232C216 223.2 223.2 216 232 216H280zM0 64C0 28.65 28.65 0 64 0H320C355.3 0 384 28.65 384 64V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM48 64V448C48 456.8 55.16 464 64 464H144V400C144 373.5 165.5 352 192 352C218.5 352 240 373.5 240 400V464H320C328.8 464 336 456.8 336 448V64C336 55.16 328.8 48 320 48H64C55.16 48 48 55.16 48 64z" />
                                                    </svg>
                                                    {{$apartment->building->name ?? 0}}

                                                </p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="row row-cols-2" id="div_content_data_2">
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-sm">
                        <div style="float: right">
                            {{ $apartments->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
    $('#search').on('keyup',function(){

        $value = $(this).val();
        if($value){
            $('#div_content_data').hide();
            $('#div_content_data_2').show();
        }else{
            $('#div_content_data').show();
            $('#div_content_data_2').hide();
        }
        $.ajax({
            type:'get',
            url:"{{ route('apartment.search') }}",
            data: {
                'search': $value
            },
            success:function(data){
                console.log(data);
                $('#div_content_data_2').html(data);
            },
        });

    });
        // function performDestroy(id, reference) {
        //     confirmDestroy('/compound', id, reference);
        // }//end function

        /* When the user clicks on the button,
        toggle between hiding and showing the dropdown content */
        // function myFunction() {
        // document.getElementById("myDropdown").classList.toggle("show");
        // }

        // Close the dropdown menu if the user clicks outside of it
        // window.onclick = function(event) {
        // if (!event.target.matches('.dropbtn')) {
        // var dropdowns = document.getElementsByClassName("dropdown-content");
        // var i;
        // for (i = 0; i < dropdowns.length; i++) { var openDropdown=dropdowns[i]; if (openDropdown.classList.contains('show')) {
        //     openDropdown.classList.remove('show'); } } } }
</script>
@endsection
