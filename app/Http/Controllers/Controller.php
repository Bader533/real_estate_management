<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Building;
use App\Models\Compound;
use App\Models\Contract;
use App\Models\Tenant;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function homeController()
    {
        if (Auth::guard('admin')->check()) {


            $compounds = Compound::count();
            $buildings = Building::count();
            $apartments = Apartment::count();
            $tenants = Tenant::count();
            $contracts = Contract::get();
            $contractCount = $contracts->count();

            $total_amount_of_rent = 0;
            foreach ($contracts as $contract) {
                $total_amount_of_rent = $total_amount_of_rent + $contract->total_amount_of_rent;
            }

            return view('dashboard.admin.home_page', [
                'compounds' => $compounds,
                'buildings' => $buildings,
                'apartments' => $apartments,
                'tenants' => $tenants,
                'contractCount' => $contractCount,
                'total_amount_of_rent' => $total_amount_of_rent,
            ]);
        } else if (Auth::guard('owner')->check()) {
            $compounds = auth('owner')->user()->compounds()->count();
            $buildings = auth('owner')->user()->buildings()->count();
            $apartments = auth('owner')->user()->apartments()->count();
            $tenants = Tenant::with('contract')->whereHas('contract', function ($query) {
                $query->where('property_owner_id', auth('owner')->user()->id);
            })->count();
            $contracts = auth('owner')->user()->contracts()->count();
            $allContracts = auth('owner')->user()->contracts()->get();

            $total_amount_of_rent = 0;
            foreach ($allContracts as $oneContract) {
                $total_amount_of_rent = $total_amount_of_rent + $oneContract->total_amount_of_rent;
            }

            return view('dashboard.owner.home_page', [
                'compounds' => $compounds,
                'buildings' => $buildings,
                'apartments' => $apartments,
                'tenants' => $tenants,
                'contracts' => $contracts,
                'total_amount_of_rent' => $total_amount_of_rent,
            ]);
        }
    }
}
