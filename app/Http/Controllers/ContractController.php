<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Models\Image as Images;
use App\Traits\image;
use Symfony\Component\HttpFoundation\Response;

class ContractController extends Controller
{
    use image;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $tenants = Tenant::get();
        return view('dashboard.owner.rentals.create', ['apartment_id' => $id, 'tenants' => $tenants]);
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
            'from' => 'required ',
            'to' => 'required ',
            'number_of_batches' => 'required ',
            'total_amount_of_rent' => 'required',
            'guarantee_amount' => 'required',
            'payment_method' => 'required',
            'tenant_id' => 'required ',
        ]);
        if ($request->input('tenant_id') == null) {
            $validatorTenant = Validator($request->all(), [
                'name' => 'required ',
                'nationality' => 'required ',
                'ssl' => 'required ',
                'phone' => 'required',
                'email' => 'required',
            ]);
            if (!$validatorTenant->fails()) {
                $tenant = new Tenant();
                $tenant->name = $request->input('name');
                $tenant->nationality = $request->input('nationality');
                $tenant->ssl = $request->input('ssl');
                $tenant->phone = $request->input('phone');
                $tenant->email = $request->input('email');
                $isTenantSaved = $tenant->save();
            } else {
                return response()->json(['message' => $validatorTenant->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
            }
        }
        if (!$validator->fails()) {
            $contract = new Contract();
            $contract->from = $request->input('from');
            $contract->to = $request->input('to');
            $contract->number_of_batches = $request->input('number_of_batches');
            $contract->total_amount_of_rent = $request->input('total_amount_of_rent');
            $contract->guarantee_amount = $request->input('guarantee_amount');
            $contract->payment_method = $request->input('payment_method');
            $contract->property_owner_id = auth('owner')->user()->id;
            $contract->apartment_id = $request->input('apartment_id');
            if ($request->input('tenant_id') == null) {
                $contract->tenant_id = $tenant->id;
            } else {
                $contract->tenant_id = $request->input('tenant_id');
            }

            $isSaved = $contract->save();
            if ($request->images != null) {
                foreach ($request->images as $image) {
                    $images = new Images();
                    $this->saveImage($image, 'images/rental', $images, $contract);
                }
            }

            return response()->json(
                [
                    'message' => $isSaved ? 'tenant created successfully' : 'tenant failed!'
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
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function show(Contract $contract)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function edit(Contract $contract)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contract $contract)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contract $contract)
    {
        //
    }
}
