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
<div id="kt_content_container" class="container-xxl">
    <div class="card">
        <div id="add-search" class="card-header border-0 pt-5">

            <div class="card-title">
                <a href="#">
                    <h3>{{__('site.apartment')}}</h3>
                </a>
            </div>

        </div><br>
        <div class="card-body pt-0">
            {{-- /////////////////////// --}}
            <div class="col-lg-6 container text-center">
                <div class="" id="div_tab">
                    <ul class="nav nav-pills nav-fill gap-2 p-1 small bg-white border rounded-5 shadow-sm  "
                        id="pillNav2" role="tablist">
                        <li class="nav-item" role="presentation"><a href="{{route('compound.all')}}">
                                <button class="nav-link rounded-5" id="home-tab2" data-bs-toggle="tab" type="button"
                                    role="tab" aria-selected="false" tabindex="-1">{{__('site.compounds')}}</button>
                            </a> </li>
                        <li class="nav-item" role="presentation"><a href="{{route('building.all')}}">
                                <button class="nav-link rounded-5" id="home-tab2" data-bs-toggle="tab" type="button"
                                    role="tab" aria-selected="false" tabindex="-1">{{__('site.building')}}</button>
                            </a></li>
                        <li class="nav-item" role="presentation"><a href="{{route('apartment.all')}}">
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
                                    <img src="https://via.placeholder.com/200" style="height: 100%;"
                                        class="img-fluid rounded-start" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <div style="display: flex; justify-content: space-between;">
                                            <h5 class="card-title text-start "><a>{{$apartment->apartment_name}}</a>
                                            </h5>
                                        </div>
                                        <ul class="text-start" style="list-style-type: none; padding: 0;">
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
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
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
<script src="{{ asset('assets/js/app.js') }}"></script>
<script src="{{ asset('assets/js/crud.js') }}"></script>
<script>
    $("body").on("keyup", "#search", function() {
            let text = $("#search").val();
                $.ajax({
                    data: {
                        search: text
                    },
                    url: "{{ route('apartment.search.admin') }}",
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#div_content_data').html(data.table_data);
                    }
                }); //end ajax
        }); //end function

        function performDestroy(id, reference) {
            confirmDestroy('/compound', id, reference);
        }//end function

        /* When the user clicks on the button,
        toggle between hiding and showing the dropdown content */
        function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
        }

        // Close the dropdown menu if the user clicks outside of it
        window.onclick = function(event) {
        if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) { var openDropdown=dropdowns[i]; if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show'); } } } }
</script>
@endsection
