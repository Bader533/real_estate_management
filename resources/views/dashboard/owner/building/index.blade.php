@extends('dashboard.index')

@section('css')
@if (app()->getLocale() == 'ar')
<style>
    .card {
        direction: rtl;
    }
</style>

@endif
@endsection

@section('pagename', __('site.buildings'))
@section('object', __('site.building_info'))

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
                        placeholder="{{__('site.search_buildings')}}" />
                </div>
            </div>

            <div class="card-toolbar">
                <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                    <a href="{{ route('building.create') }}" class="btn btn-primary">{{__('site.add_building')}}</a>

                </div>
            </div>
        </div>

        <div class="card-body pt-0">

            <table class="table table-striped table-row-bordered gy-5 gs-7 border rounded w-100"
                id="kt_customers_table">

                <thead>

                    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                        <th class="min-w-125px">{{__('site.name')}}</th>
                        <th class="min-w-125px">{{__('site.city')}}</th>
                        <th class="min-w-125px">{{__('site.address')}}</th>
                        <th class="text-end min-w-70px">{{__('site.actions')}}</th>
                    </tr>

                </thead>

                <tbody class="fw-bold text-gray-600">
                    @foreach ($buildings as $building)
                    <tr>

                        <td>
                            <a href="{{ route('building.edit', $building->id) }}"
                                class="text-gray-800 text-hover-primary mb-1">{{ $building->name }}</a><br>
                            @if ($building->kind == '0')
                            <p class="text-gray-600 mb-1">{{$building->compound->name}}</p>
                            @endif
                        </td>

                        <td>
                            @if ($building->kind == '0')
                            {{ $building->compound->city }}
                            @else
                            {{ $building->city }}
                            @endif
                        </td>

                        <td>

                            @if ($building->kind == '0')
                            {{ $building->compound->address }}
                            @else
                            {{ $building->address }}
                            @endif
                        </td>


                        <td class="text-end">
                            <a href={{ route('building.edit', $building->id) }}
                                class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                <span class="svg-icon svg-icon-md svg-icon-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z"
                                                fill="#000000" fill-rule="nonzero"
                                                transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)" />
                                            <path
                                                d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z"
                                                fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                        </g>
                                    </svg>
                                </span>
                            </a>

                            {{-- <a href="#" onclick="performDestroy($building->id, this)"
                                class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                <span class="svg-icon svg-icon-md svg-icon-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                                                fill="#000000" fill-rule="nonzero" />
                                            <path
                                                d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                                fill="#000000" opacity="0.3" />
                                        </g>
                                    </svg>
                                </span>
                            </a> --}}

                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- /// --}}
            <div class="container">
                <div class="row">
                    <div class="col-sm">
                        <div style="float: right">
                            {{ $buildings->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
            {{-- /// --}}
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
            console.log(text);
            // if (text !== null) {
                $.ajax({
                    data: {
                        search: text
                    },
                    url: "{{ route('building.search') }}",
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('tbody').html(data.table_data);
                    }
                }); //end ajax
            // }
    }); //end function

        // function performDestroy(id, reference) {
        //     confirmDestroy('/compound', id, reference);
        // }//end function
</script>
@endsection
