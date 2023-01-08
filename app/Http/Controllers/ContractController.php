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
        ]);
        if ($request->input('tenant_id') == null) {
            $tenant_id = $this->newTenant($request);
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
            $contract->is_active = 1;

            if ($request->input('tenant_id') == null) {
                $contract->tenant_id = $tenant_id;
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
    public function edit($id)
    {

        $contract = auth('owner')->user()->contracts()->where('id', $id)->where('is_active', 1)->first();
        return view('dashboard.owner.rentals.edit', ['contract' => $contract]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator($request->all(), [
            'from' => 'required ',
            'to' => 'required ',
            'number_of_batches' => 'required | numeric',
            'total_amount_of_rent' => 'required | numeric',
            'guarantee_amount' => 'required | numeric',
            'payment_method' => 'required | numeric',
        ]);
        if (!$validator->fails()) {
            $contract = auth('owner')->user()->contracts()->where('id', $id)->where('is_active', 1)->first();
            $contract->from = $request->input('from');
            $contract->to = $request->input('to');
            $contract->number_of_batches = $request->input('number_of_batches');
            $contract->total_amount_of_rent = $request->input('total_amount_of_rent');
            $contract->guarantee_amount = $request->input('guarantee_amount');
            $contract->payment_method = $request->input('payment_method');
            $isSaved = $contract->save();
            return response()->json(
                [
                    'message' => $isSaved ? 'Contract updated successfully' : 'updated failed!'
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
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $contract = auth('owner')->user()->contracts()->where('id', $id)->where('is_active', 1)->first();

        $contract->to = $request->input('endDate');
        $contract->is_active = 0;
        $isDeleled = $contract->save();
        return response()->json(
            [
                'message' => $isDeleled ? 'Contract Deleted successfully' : 'Deleted failed!'
            ],
            $isDeleled ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
        );
    }

    // add new tenant in create contract
    public function newTenant($request)
    {
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
            $tenant->property_owner_id = auth('owner')->user()->id;
            $isTenantSaved = $tenant->save();
            return $tenant->id;
        } else {
            return response()->json(['message' => $validatorTenant->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }
}
