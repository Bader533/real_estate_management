@extends('dashboard.index')

@section('css')

{{--
<link href="netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet"> --}}

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@if (app()->getLocale() == 'ar')
<style>
    #kt_content_container {
        direction: rtl;
    }
</style>
@endif

@endsection

@section('pagename', __('site.tenants'))
@section('object', __('site.tenant_info'))

@section('content')
<div id="kt_content_container" class="container-xxl">

    <!--begin::Modal - tenant --->
    <div class="modal fade" id="kt_modal_add_customer" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Form-->
                <form class="form" action="{{ route('advanced.search') }}" method="get" id="kt_modal_add_customer_form"
                    data-kt-redirect="../../demo6/dist/apps/customers/list.html">
                    @csrf
                    <!--begin::Modal header-->
                    <div class="modal-header" id="kt_modal_add_customer_header">
                        <!--begin::Modal title-->
                        <h2 class="fw-bolder">{{ __('site.search_tenants') }}</h2>
                        <!--end::Modal title-->
                        <!--begin::Close-->
                        <div id="kt_modal_add_customer_close" class="btn btn-icon btn-sm btn-active-icon-primary">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                            <span class="svg-icon svg-icon-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                        transform="rotate(-45 6 17.3137)" fill="black" />
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                        transform="rotate(45 7.41422 6)" fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </div>
                        <!--end::Close-->
                    </div>
                    <div class="modal-body py-10 px-lg-17">

                        <div class="scroll-y me-n7 pe-7" id="kt_modal_add_customer_scroll" data-kt-scroll="true"
                            data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                            data-kt-scroll-dependencies="#kt_modal_add_customer_header"
                            data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="300px">

                            <div class="d-flex flex-column mb-7 fv-row">
                                <label class="fs-6 fw-bold mb-2">
                                    <span class="">{{ __('site.one_tenant') }}</span>

                                </label>
                                <input type="text" class="form-control form-control-solid" name="search" id="search"
                                    placeholder="" value="" />

                            </div>
                        </div>

                    </div>

                    <!--begin::Modal footer-->
                    <div class="modal-footer flex-center">
                        <!--begin::Button-->
                        <button type="reset" id="kt_modal_add_customer_cancel"
                            class="btn btn-light me-3">Discard</button>
                        <!--end::Button-->
                        <!--begin::Button-->
                        <button type="submit" id="kt_modal_add_customer_submit" class="btn btn-primary">
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
    <!--end::Modal - tenant --->

    <div class="card">
        <div id="add-search" class="card-header border-0 pt-5">

            <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1">
                    <span class="svg-icon svg-icon-1 position-absolute ms-6">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                                transform="rotate(45 17.0365 15.1223)" fill="black" />
                            <path
                                d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                fill="black" />
                        </svg>
                    </span>
                    <input type="text" data-kt-customer-table-filter="search" id="searchtenant"
                        class="form-control form-control-solid w-250px ps-15"
                        placeholder="{{ __('site.search_tenants') }}" />
                </div>
            </div>

            <div class="card-toolbar">
                <a href="{{ route('tenant.import') }}" class="btn btn-light-primary me-3"
                    data-bs-target="#kt_customers_export_modal">
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
                    Import
                </a>
                <a class="btn btn-light-primary me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_add_customer">
                    Search
                </a>
                <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                    <a href="{{ route('tenant.create') }}" class="btn btn-primary">{{ __('site.add_tenant') }}</a>

                </div>
            </div>
        </div><br>

        <div class="card-body pt-0">
            <div class="container text-center">
                <div class="row row-cols-2">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table">
                        <!--begin::Table head-->
                        <thead>
                            <!--begin::Table row-->
                            <tr class="text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                <th class="min-w-125px"> {{ __('site.name') }}</th>
                                <th class="min-w-125px">{{ __('site.email') }}</th>
                                <th class="min-w-125px">{{ __('site.phone') }}</th>
                                <th class="min-w-125px">{{ __('site.id_number') }}</th>
                                <th class="min-w-125px">{{ __('site.nationality') }}</th>
                                <th class="min-w-125px">{{ __('site.action') }}</th>
                            </tr>
                            <!--end::Table row-->
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody class="fw-bold text-gray-600" id="div_content_data">
                            @foreach ($tenants as $tenant)
                            <tr>
                                <td>
                                    {{ $tenant->name }}
                                </td>

                                <td>
                                    {{ $tenant->email }}
                                </td>

                                <td>
                                    {{ $tenant->phone }}
                                </td>

                                <td>
                                    {{ $tenant->ssl }}
                                </td>

                                <td>
                                    {{ $tenant->nationality }}
                                </td>

                                <td>
                                    <div class="d-flex justify-content-center flex-shrink-0">
                                        <a href="{{route('tenant.show', $tenant->id)}}"
                                            class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
                                            <span class="svg-icon svg-icon-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3"
                                                        d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z"
                                                        fill="black" />
                                                    <path
                                                        d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z"
                                                        fill="black" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </a>
                                        <a href="{{route('tenant.edit', $tenant->id)}}"
                                            class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                            <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                            <span class="svg-icon svg-icon-2x">
                                                <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo4/dist/../src/media/svg/icons/General/Settings-2.svg--><svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                    height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24" />
                                                        <path
                                                            d="M5,8.6862915 L5,5 L8.6862915,5 L11.5857864,2.10050506 L14.4852814,5 L19,5 L19,9.51471863 L21.4852814,12 L19,14.4852814 L19,19 L14.4852814,19 L11.5857864,21.8994949 L8.6862915,19 L5,19 L5,15.3137085 L1.6862915,12 L5,8.6862915 Z M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z"
                                                            fill="#000000" />
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                            <!--end::Svg Icon-->
                                        </a>
                                    </div>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                        <tbody class="fw-bold text-gray-600" id="div_content_data_2">

                        </tbody>
                        <!--end::Table body-->
                    </table>
                    {{-- @foreach ($tenants as $tenant)
                    <div id="tenant-container">

                        <div class="tenantHeader">
                            <h4> <a href="{{ route('tenant.show',$tenant->id) }}">{{ $tenant->name }} </a></h4>
                            <a href="{{ route('tenant.edit',$tenant->id) }}">edit</a>
                        </div>
                        <div class="product-details">

                            <div class="details">
                                <ul>
                                    <li><span class=""><svg xmlns="http://www.w3.org/2000/svg" width="13"
                                                viewBox="0 0 512 512">
                                                <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                                <path
                                                    d="M256 64C150 64 64 150 64 256s86 192 192 192c17.7 0 32 14.3 32 32s-14.3 32-32 32C114.6 512 0 397.4 0 256S114.6 0 256 0S512 114.6 512 256v32c0 53-43 96-96 96c-29.3 0-55.6-13.2-73.2-33.9C320 371.1 289.5 384 256 384c-70.7 0-128-57.3-128-128s57.3-128 128-128c27.9 0 53.7 8.9 74.7 24.1c5.7-5 13.1-8.1 21.3-8.1c17.7 0 32 14.3 32 32v80 32c0 17.7 14.3 32 32 32s32-14.3 32-32V256c0-106-86-192-192-192zm64 192c0-35.3-28.7-64-64-64s-64 28.7-64 64s28.7 64 64 64s64-28.7 64-64z" />
                                            </svg>&nbsp;</span>{{ $tenant->email }}
                                    </li>

                                    <li><span class=""><svg xmlns="http://www.w3.org/2000/svg" width="13"
                                                viewBox="0 0 512 512">
                                                <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                                <path
                                                    d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z" />
                                            </svg>&nbsp;</span>{{ $tenant->phone }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endforeach --}}
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-sm">
                        <div style="float: right">
                            {{ $tenants->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
{{-- <script src="{{ asset('assets/js/app.js') }}"></script>
<script src="{{ asset('assets/js/crud.js') }}"></script> --}}
<script>
    $('#searchtenant').on('keyup',function(){
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
                url:"{{ route('tenant.search') }}",
                data: {
                    'search': $value
                },
                success:function(data){
                    console.log(data);
                    $('#div_content_data_2').html(data);
                },
            });
    });

    // $("body").on("keyup", "#search", function() {
    //         let text = $("#search").val();
    //         if (text != null) {
    //             $.ajax({
    //                 data: {
    //                     search: text
    //                 },
    //                 url: "{{ route('tenant.search') }}",
    //                 method: 'GET',
    //                 dataType: 'json',
    //                 success: function(data) {
    //                     $('#div_content_data').html(data.table_data);
    //                 }
    //             }); //end ajax
    //         }
    // }); //end function

        // function performDestroy(id, reference) {
        //     confirmDestroy('/compound', id, reference);
        // } //end function
</script>
@endsection
