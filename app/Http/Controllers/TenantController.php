<?php

namespace App\Http\Controllers;

use App\Imports\TenantsImport;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tenants = auth('owner')->user()->tenants()->paginate(10);
        $tenants = Tenant::with('contract')
            ->whereHas('contract', function ($query) {
                $query->where('property_owner_id', auth('owner')->user()->id);
            })->paginate(10);

        return view('dashboard.owner.tenant.index', ['tenants' => $tenants]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.owner.tenant.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'name' => 'required | string  |max:50 ',
            'email' => 'required | string | max:50',
            'phone' => 'required | numeric',
            'nationality' => 'required | string | max:50',
            'id_number' => 'required | numeric',
        ]);
        if (!$validator->fails()) {
            $tenant = new Tenant();
            $tenant->name = $request->input('name');
            $tenant->email = $request->input('email');
            $tenant->phone = $request->input('phone');
            $tenant->nationality = $request->input('nationality');
            $tenant->ssl = $request->input('id_number');
            $tenant->property_owner_id = auth('owner')->user()->id;
            $isSaved = $tenant->save();
            return response()->json(
                [
                    'message' => $isSaved ? 'Tenant created successfully' : 'Created failed!'
                ],
                $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
            );
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function show(Tenant $tenant)
    {
        return view('dashboard.owner.tenant.show', ['tenant' => $tenant]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function edit(Tenant $tenant)
    {
        return view('dashboard.owner.tenant.edit', ['tenant' => $tenant]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tenant $tenant)
    {
        $validator = Validator($request->all(), [
            'name' => 'required | string  |max:50 ',
            'email' => 'required | string | max:50',
            'phone' => 'required | numeric',
            'nationality' => 'required | string | max:50',
            'id_number' => 'required | numeric',
        ]);
        if (!$validator->fails()) {
            $tenant->name = $request->input('name');
            $tenant->email = $request->input('email');
            $tenant->phone = $request->input('phone');
            $tenant->nationality = $request->input('nationality');
            $tenant->ssl = $request->input('id_number');
            $tenant->property_owner_id = auth('owner')->user()->id;
            $isSaved = $tenant->save();
            return response()->json(
                [
                    'message' => $isSaved ? 'Tenant Update Successfully' : 'Update failed!'
                ],
                $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
            );
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tenant $tenant)
    {
        //
    }

    public function search(Request $request)
    {
        $query = $request->get('search');
        if ($request->ajax()) {
            $output = "";
            $tenants = Tenant::with('contract')
                ->whereHas('contract', function ($query) {
                    $query->where('property_owner_id', auth('owner')->user()->id);
                })->where(function ($q) use ($query) {
                    $q->where('name', 'like', '%' . $query . '%')
                        ->orWhere('email', 'like', '%' . $query . '%')
                        ->orWhere('phone', 'like', '%' . $query . '%')
                        ->orderBy('id', 'desc');
                })->get();
            // ->where('name', 'like', '%' . $query . '%')
            // ->orWhere('email', 'like', '%' . $query . '%')
            // ->orWhere('phone', 'like', '%' . $query . '%')
            // ->orderBy('id', 'desc')


            $total_row = $tenants->count();

            if ($total_row > 0) {

                foreach ($tenants as $tenant) {
                    $output .= '<tr>
                                        <td>
                                            ' . $tenant->name . '
                                        </td>

                                        <td>
                                            ' . $tenant->email . '
                                        </td>

                                        <td>
                                            ' . $tenant->phone . '
                                        </td>

                                        <td>
                                            ' . $tenant->ssl . '
                                        </td>

                                        <td>
                                            ' . $tenant->nationality . '
                                        </td>

                                        <td>
                                    <div class="d-flex justify-content-center flex-shrink-0">
                                        <a href="#"
                                            class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
                                            <span class="svg-icon svg-icon-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
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
                                        <a href="' . route('tenant.edit', $tenant->id) . '"
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

                                    </tr>';
                }
            } else {
                $output = '<tr><td align="center" colspan="6">No Data Found</td></tr>';
            }

            return response($output);
            // $data = array(
            //     'table_data'  => $output,
            //     'total_data'  => $total_row
            // );

            // echo json_encode($data);
        }
    }

    function viewImport()
    {
        return view('dashboard.owner.tenant.import');
    }

    function importTenants(Request $request)
    {
        $validator = Validator($request->all(), [
            'file' => 'required|mimes:xlsx,xls',
        ]);
        if (!$validator->fails()) {
            $file = $request->file('file')->path();
            $import = new TenantsImport;
            $import->import($file);
            return response()->json(
                [
                    'message' => 'File Added successfully'
                ]
            );
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function advancedSearch(Request $request)
    {
        $query = $request->input('search');
        $tenants = Tenant::where('name', 'like', '%' . $query . '%')
            ->orWhere('email', 'like', '%' . $query . '%')
            ->orWhere('phone', 'like', '%' . $query . '%')
            ->orWhere('ssl', 'like', '%' . $query . '%')
            ->first();
        if (!is_null($tenants->tenantInfos)) {

            $info = $tenants->tenantInfos;
            $payment = 0;
            $apartment_clean = 0;
            $apartment_interest = 0;
            $annoyance = 0;
            foreach ($info as $details) {
                $payment += $details->payment;
                $apartment_clean += $details->apartment_clean;
                $apartment_interest += $details->apartment_interest;
                $annoyance += $details->annoyance;
            }
            $totalCount = $info->count() * 5;
            $totalPayment = $payment / $totalCount * 5;
            $totalApartmentClean = $apartment_clean / $totalCount * 5;
            $totalApartmentInterest = $apartment_interest / $totalCount * 5;
            $totalAnnoyance = $annoyance / $totalCount * 5;
        }
        return view('dashboard.owner.tenant.advanced_search', [
            'tenant' => $tenants,
            'infos' => $info,
            'totalPayment' => $totalPayment,
            'totalApartmentClean' => $totalApartmentClean,
            'totalApartmentInterest' => $totalApartmentInterest,
            'totalAnnoyance' => $totalAnnoyance,
        ]);
    }
}
