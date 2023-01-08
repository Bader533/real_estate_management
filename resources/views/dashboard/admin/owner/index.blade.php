@extends('dashboard.index')

@section('css')

{{--
<link href="netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet"> --}}

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
{{--
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> --}}
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@if (app()->getLocale() == 'ar')
<style>
    #kt_content_container {
        direction: rtl;
    }
</style>
@endif

@endsection

@section('pagename', __('site.owners'))
@section('object', __('site.owner_info'))

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

        </div><br>

        <div class="card-body pt-0">
            <div class="container text-center">
                <div class="row row-cols-2">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table">

                        <thead>

                            <tr class="text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                <th class="">{{ __('site.name') }}</th>
                                <th class="">{{ __('site.email') }}</th>
                                <th class="">{{ __('site.phone') }}</th>
                                <th class="">{{ __('site.compounds') }}</th>
                                <th class="">{{ __('site.buildings') }}</th>
                                <th class="">{{ __('site.apartments') }}</th>
                            </tr>

                        </thead>

                        <tbody class="" id="div_content_data">
                            @foreach ($owners as $owner)
                            <tr>

                                <td>
                                    @if ($owner->name == null)
                                    {{ $owner->company_name }}
                                    @else
                                    {{ $owner->name }}
                                    @endif

                                </td>

                                <td>
                                    {{ $owner->email }}
                                </td>

                                <td>
                                    {{ $owner->phone }}
                                </td>

                                <td>
                                    {{ $owner->compounds->count() }}
                                </td>

                                <td>
                                    {{ $owner->buildings->count() }}
                                </td>

                                <td>
                                    {{ $owner->apartments->count() }}
                                </td>

                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-sm">
                        <div style="float: right">
                            {{ $owners->links('pagination::bootstrap-4') }}
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
                    url: "{{ route('owner.search.admin') }}",
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#div_content_data').html(data.table_data);
                    }
                }); //end ajax
            }
        }); //end function
</script>
@endsection
