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

@section('pagename', __('site.all_operations'))
@section('object', __('site.all_operations'))

@section('content')

<div id="kt_content_container" class="container-xxl">

    <!--begin::Modal - contract - Add-->
    <div class="modal fade" id="kt_customers_export_modal" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Form-->
                <form class="form" action="{{route('finance.search')}}" method="post"
                    id="kt_customers_export_modal_form" data-kt-redirect="../../demo6/dist/apps/customers/list.html">
                    @csrf
                    <!--begin::Modal header-->
                    <div class="modal-header" id="kt_customers_export_modal_header">
                        <!--begin::Modal title-->
                        <h2 class="fw-bolder">{{ __('site.add_date') }}</h2>
                        <!--end::Modal title-->
                        <!--begin::Close-->
                        <div id="kt_customers_export_modal_close" class="btn btn-icon btn-sm btn-active-icon-primary">
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

                        <div class="scroll-y me-n7 pe-7" id="kt_customers_export_modal_scroll"
                            data-kt-scroll-dependencies="#kt_customers_export_modal_header"
                            data-kt-scroll-wrappers="#kt_customers_export_modal_scroll" data-kt-scroll-offset="300px">

                            <div class="d-flex flex-column mb-7 fv-row">
                                <label class="fs-6 fw-bold mb-2">
                                    <span class="">{{__('site.from')}}</span>

                                </label>
                                <input type="date" class="form-control form-control-solid" name="from" id="from"
                                    placeholder="" value="" />

                            </div>

                            <div class="d-flex flex-column mb-7 fv-row">
                                <label class="fs-6 fw-bold mb-2">
                                    <span class="">{{__('site.to')}}</span>

                                </label>
                                <input type="date" class="form-control form-control-solid" name="to" id="to"
                                    placeholder="" value="" />

                            </div>
                        </div>

                    </div>

                    <!--begin::Modal footer-->
                    <div class="modal-footer flex-center">
                        <!--begin::Button-->
                        <button type="reset" id="kt_customers_export_modal_cancel"
                            class="btn btn-light me-3">Discard</button>
                        <!--end::Button-->
                        <!--begin::Button-->
                        <button type="submit" onclick="" id="kt_customers_export_modal_submit" class="btn btn-primary">
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
    <!--end::Modal - contract - Add-->


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
                    <input type="text" data-kt-customer-table-filter="search" id="search"
                        class="form-control form-control-solid w-250px ps-15"
                        placeholder="{{ __('site.search_tenants') }}" />
                </div>
            </div>

            <div class="card-toolbar">
                <a data-bs-toggle="modal" class="btn btn-light-primary me-3"
                    data-bs-target="#kt_customers_export_modal">
                    Search
                </a>
            </div>
        </div><br>

        <div class="card-body pt-0">
            <div class="container text-center">
                <div class="row row-cols-2" id="div_content_data">
                    <div class="card-body pt-0">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table">
                            <!--begin::Table head-->
                            <thead>
                                <!--begin::Table row-->
                                <tr class="text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                    <th class="min-w-125px"> {{__('site.one_tenant')}}</th>
                                    <th class="min-w-125px">{{__('site.number_of_batches')}}</th>
                                    <th class="min-w-125px">{{__('site.total_amount_of_rent')}}</th>
                                    <th class="min-w-125px">{{__('site.guarantee_amount')}}</th>
                                    <th class="min-w-125px">{{__('site.payment_method')}}</th>
                                </tr>
                                <!--end::Table row-->
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody class="fw-bold text-gray-600" id="div_table_data">
                                @isset($contracts)
                                @foreach ($contracts as $contract)
                                <tr>
                                    <td>
                                        {{$contract->tenant->name}}
                                    </td>

                                    <td>
                                        {{$contract->number_of_batches}}
                                    </td>

                                    <td>
                                        {{$contract->total_amount_of_rent}}
                                    </td>

                                    <td>
                                        {{$contract->guarantee_amount}}
                                    </td>

                                    <td>
                                        {{$contract->payment_method}}
                                    </td>

                                </tr>
                                @endforeach

                                @endisset


                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-sm">
                        <div style="float: right">
                            @isset($contracts)
                            {{ $contracts->links('pagination::bootstrap-4') }}
                            @endisset
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
            if (text != null) {
                $.ajax({
                    data: {
                        search: text
                    },
                    url: "{{ route('finance.live.search') }}",
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#div_table_data').html(data.table_data);
                    }
                }); //end ajax
            }
        }); //end function

        function performDestroy(id, reference) {
            confirmDestroy('/compound', id, reference);
        } //end function
</script>
@endsection
