<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Building;
use App\Models\Compound;
use App\Models\Contract;
use App\Models\Tenant;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        // $compounds = Compound::count();
        // $buildings = Building::count();
        // $apartments = Apartment::count();
        // $tenants = Tenant::count();
        // $contracts = Contract::get();
        // $contractCount = $contracts->count();

        // $total_amount_of_rent = 0;
        // foreach ($contracts as $contract) {
        //     $total_amount_of_rent = $total_amount_of_rent + $contract->total_amount_of_rent;
        // }

        // return view('dashboard.admin.home_page', [
        //     'compounds' => $compounds,
        //     'buildings' => $buildings,
        //     'apartments' => $apartments,
        //     'tenants' => $tenants,
        //     'contractCount' => $contractCount,
        //     'total_amount_of_rent' => $total_amount_of_rent,
        // ]);
    }
}
