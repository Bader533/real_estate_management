@extends('dashboard.index')

@section('css')

<link href="netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

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
                <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                    <a href="{{ route('tenant.create') }}" class="btn btn-primary">{{ __('site.add_tenant') }}</a>

                </div>
            </div>
        </div><br>

        <div class="card-body pt-0">
            <div class="container text-center">
                <div class="row row-cols-2" id="div_content_data">
                    @foreach ($tenants as $tenant)
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
                    @endforeach
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
                    url: "{{ route('tenant.search') }}",
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#div_content_data').html(data.table_data);
                    }
                }); //end ajax
            }
        }); //end function

        function performDestroy(id, reference) {
            confirmDestroy('/compound', id, reference);
        } //end function
</script>
@endsection