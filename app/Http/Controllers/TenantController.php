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
        $tenants = auth('owner')->user()->tenants()->paginate(10);
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
            $tenants = Tenant::where('name', 'like', '%' . $query . '%')
                ->orWhere('email', 'like', '%' . $query . '%')
                ->orWhere('phone', 'like', '%' . $query . '%')
                ->orderBy('id', 'desc')
                ->get();

            $total_row = $tenants->count();

            if ($total_row > 0) {

                foreach ($tenants as $tenant) {
                    $output .= '<div id="tenant-container"><div class="tenantHeader">
                            <h4> <a href="' . route('tenant.show', $tenant->id) . '">' . $tenant->name . ' </a></h4>
                            <a href="' . route('tenant.edit', $tenant->id) . '">edit</a>
                        </div><div class="product-details"> <div class="details"><ul>
                                    <li><span class=""><svg xmlns="http://www.w3.org/2000/svg" width="13"
                                                viewBox="0 0 512 512">
                                                <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                                <path
                                                    d="M256 64C150 64 64 150 64 256s86 192 192 192c17.7 0 32 14.3 32 32s-14.3 32-32 32C114.6 512 0 397.4 0 256S114.6 0 256 0S512 114.6 512 256v32c0 53-43 96-96 96c-29.3 0-55.6-13.2-73.2-33.9C320 371.1 289.5 384 256 384c-70.7 0-128-57.3-128-128s57.3-128 128-128c27.9 0 53.7 8.9 74.7 24.1c5.7-5 13.1-8.1 21.3-8.1c17.7 0 32 14.3 32 32v80 32c0 17.7 14.3 32 32 32s32-14.3 32-32V256c0-106-86-192-192-192zm64 192c0-35.3-28.7-64-64-64s-64 28.7-64 64s28.7 64 64 64s64-28.7 64-64z" />
                                            </svg>&nbsp;</span>' . $tenant->email . '
                                    </li>

                                    <li><span class=""><svg xmlns="http://www.w3.org/2000/svg" width="13"
                                                viewBox="0 0 512 512">
                                                <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                                <path
                                                    d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z" />
                                            </svg>&nbsp;</span>' . $tenant->phone . '
                                    </li>
                                </ul> </div> </div></div>';
                }
            } else {
                $output = '<h4 style="margin: 0;margin-left: auto;margin-right: auto;">No Data Found</h4>';
            }
            $data = array(
                'table_data'  => $output,
                'total_data'  => $total_row
            );

            echo json_encode($data);
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
}
