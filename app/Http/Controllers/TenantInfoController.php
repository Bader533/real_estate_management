<?php

namespace App\Http\Controllers;

use App\Models\TenantInfo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TenantInfoController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'payment' => 'required | numeric | between:1,5',
            'clean' => 'required | numeric | between:1,5',
            'interest' => 'required | numeric | between:1,5',
            'annoyance' => 'required | numeric | between:1,5',
            'description' => 'required | string | max:800',
        ]);
        if (!$validator->fails()) {
            $tenantInfo = new TenantInfo();
            $tenantInfo->payment = $request->input('payment');
            $tenantInfo->apartment_clean = $request->input('clean');
            $tenantInfo->apartment_interest = $request->input('interest');
            $tenantInfo->annoyance = $request->input('annoyance');
            $tenantInfo->description = $request->input('description');
            $tenantInfo->tenant_id = $request->input('tenant_id');
            $isSaved = $tenantInfo->save();
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

    public function update(Request $request, $id)
    {
        $validator = Validator($request->all(), [
            'payment' => 'required | numeric | between:1,5',
            'clean' => 'required | numeric | between:1,5',
            'interest' => 'required | numeric | between:1,5',
            'annoyance' => 'required | numeric | between:1,5',
            'description' => 'required | string | max:800',
        ]);
        if (!$validator->fails()) {
            $tenantInfo = TenantInfo::findOrFail($id);
            $tenantInfo->payment = $request->input('payment');
            $tenantInfo->apartment_clean = $request->input('clean');
            $tenantInfo->apartment_interest = $request->input('interest');
            $tenantInfo->annoyance = $request->input('annoyance');
            $tenantInfo->description = $request->input('description');
            $tenantInfo->tenant_id = $request->input('tenant_id');
            $isSaved = $tenantInfo->save();
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
}
