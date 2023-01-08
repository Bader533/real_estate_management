@extends('dashboard.index')

@section('css')
@if (app()->getLocale() == 'ar')
<style>
    .row {
        direction: rtl;
    }
</style>
@endif
<style>
    #stretch {
        background-color: #F5F8FA;
    }

    #compound_id,
    #button_compund {
        display: none;
    }

    .data {
        font-size: 22px;
        text-align: center;
    }
</style>
@endsection

@section('pagename', __('site.one_tenant'))
@section('object', __('site.tenant_info'))

@section('content')
<div id="kt_content_container" class="container-xxl">

    <div class="row gy-5 gx-xl-10">

        <!--begin::Rental details-->
        <div class="col-xl-6">

            <div class="card card-xl-stretch mb-5 mb-xl-10">

                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">{{ __('site.tenant_data') }}</span>
                    </h3>
                </div>
                <div class="card-body pt-5">


                    <!--begin::contract_starting_date-->
                    <div class="row mb-7">

                        <label class="col-lg-4 fw-bold text-muted">{{ __('site.name') }}</label>

                        <div class="col-lg-8 fv-row">
                            <span class="fw-bold text-gray-800 fs-6">{{$tenant->name}}</span>
                        </div>

                    </div>
                    <!--end::contract_starting_date-->

                    <!--begin::contract_end_date-->
                    <div class="row mb-7">

                        <label class="col-lg-4 fw-bold text-muted">{{ __('site.phone') }}</label>

                        <div class="col-lg-8">
                            <span class="fw-bold text-gray-800 fs-6">{{$tenant->phone}}</span>
                        </div>

                    </div>
                    <!--end::contract_end_date-->

                    <!--begin::total_rental_amount-->
                    <div class="row mb-7">

                        <label class="col-lg-4 fw-bold text-muted">{{ __('site.email') }}</label>

                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800">{{$tenant->email}}</span>
                        </div>

                    </div>
                    <!--end::total_rental_amount-->

                </div>
            </div>

        </div>
        <!--end::Rental details-->

        <!--begin::tenant details-->
        <div class="col-xl-6">

            <div class="card card-xl-stretch mb-5 mb-xl-10">

                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">{{ __('site.details') }}</span>
                    </h3>
                </div>
                @if ($tenant->tenantInfos != null)
                <div class="card-body pt-5">


                    <!--begin::contract_starting_date-->
                    <div class="row mb-7">

                        <label class="col-lg-4 fw-bold text-muted">{{__('site.payment')}}</label>

                        <div class="col-lg-8 fv-row">
                            <span class="fw-bold text-gray-800 fs-6">{{ $totalPayment }}</span>
                        </div>

                    </div>
                    <!--end::contract_starting_date-->

                    <!--begin::contract_end_date-->
                    <div class="row mb-7">

                        <label class="col-lg-4 fw-bold text-muted">{{__('site.cleanliness')}}</label>

                        <div class="col-lg-8">
                            <span class="fw-bold text-gray-800 fs-6">{{ $totalApartmentClean }}</span>
                        </div>

                    </div>
                    <!--end::contract_end_date-->

                    <!--begin::total_rental_amount-->
                    <div class="row mb-7">

                        <label class="col-lg-4 fw-bold text-muted">{{__('site.attention_at_home')}}</label>

                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800">{{ $totalApartmentInterest }}</span>
                        </div>

                    </div>
                    <!--end::total_rental_amount-->

                    <!--begin::total_rental_amount-->
                    <div class="row mb-7">

                        <label class="col-lg-4 fw-bold text-muted">{{__('site.annoyance')}}</label>

                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800">{{ $totalAnnoyance }}</span>
                        </div>

                    </div>
                    <!--end::total_rental_amount-->

                </div>
                @else
                <div class="card-body pt-5">

                    <p class="data"> {{__('site.no_rating')}}</p>

                </div>
                @endif

            </div>

        </div>
        <!--end::tenant details-->

        <!--begin::tenant details-->
        <div class="col-xl-12">

            <div class="card card-xl-stretch mb-5 mb-xl-10">

                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">{{ __('site.details') }}</span>
                    </h3>
                </div>
                @if ($tenant->tenantInfos != null)
                <div class="card-body pt-0">
                    <div class="container text-center">
                        <div class="row row-cols-2">
                            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table">
                                <!--begin::Table head-->
                                <thead>
                                    <!--begin::Table row-->
                                    <tr class="text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                        <th class="min-w-125px"> {{ __('site.description') }}</th>
                                        <th class="min-w-125px"> {{ __('site.date') }}</th>
                                    </tr>
                                    <!--end::Table row-->
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody class="fw-bold text-gray-600" id="div_content_data">
                                    @foreach ($infos as $info)
                                    <tr>
                                        <td>
                                            {{ $info->description }}
                                        </td>
                                        <td>
                                            {{ $info->created_at }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <!--end::Table body-->
                            </table>
                        </div>
                    </div>
                </div>
                @else
                <div class="card-body pt-5">

                    <p class="data"> {{__('site.no_rating')}}</p>

                </div>
                @endif

            </div>

        </div>
        <!--end::tenant details-->


    </div>

</div>
@endsection

@section('js')
{{-- <script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>
<script src="https://unpkg.com/axios@1.1.2/dist/axios.min.js"></script>

<script>
    function endContract(id) {
            // console.log(data);
            axios.post('/rental/delete/'+id, {

            endDate: document.getElementById('endDate').value,

            }).then(function(response) {
                // handle success 2xx
                console.log(response);
                window.location.reload();
                toastr.success(response.data.message);
            }).catch(function(error) {
                // handle error 4xx - 5xx
                console.log(error);
                // toastr.error(error.response.data.message)
            });
        }
</script> --}}
@endsection
