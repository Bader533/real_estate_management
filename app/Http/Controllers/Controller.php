<?php

namespace App\Http\Controllers;

use App\Models\Compound;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;


use function PHPUnit\Framework\isEmpty;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function homeController()
    {

        $compounds = auth('owner')->user()->compounds()->count();
        $buildings = auth('owner')->user()->buildings()->count();
        $apartments = auth('owner')->user()->apartments()->count();
        $tenants = auth('owner')->user()->tenants()->count();
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
