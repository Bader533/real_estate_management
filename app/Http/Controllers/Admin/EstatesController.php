<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Building;
use App\Models\Compound;
use Illuminate\Http\Request;

class EstatesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function compoundIndex()
    {
        $compounds = Compound::paginate(10);
        return view('dashboard.admin.compound.index', ['compounds' => $compounds]);
    }

    public function compoundSearch(Request $request)
    {
        $query = $request->get('search');
        if ($request->ajax()) {
            $output = "";
            $compounds = Compound::where('name', 'like', '%' . $query . '%')
                ->orWhere('city', 'like', '%' . $query . '%')
                ->orWhere('address', 'like', '%' . $query . '%')
                ->orderBy('id', 'desc')
                ->get();

            $total_row = $compounds->count();

            if ($total_row > 0) {

                foreach ($compounds as $compound) {
                    $output .= '<div class="col" id="div_content" style=" padding: 0;">' .
                        ' <div class="card mb-3" id="div_card" style="">' .
                        ' <div class="row g-0">' .
                        ' <div class="col-md-4">' .
                        '<img src="https://via.placeholder.com/200" style="height: 100%;" class="img-fluid rounded-start" alt="...">' .
                        '</div>' .
                        '<div class="col-md-8">' .
                        '<div class="card-body">' .
                        '<div style="display: flex; justify-content: space-between;">' .
                        ' <h5 class="card-title text-start ">' . $compound->name . '</h5>' .
                        '</div>' .
                        '<ul class="text-start" style="list-style-type: none; padding: 0;">
                                            <li style="margin-bottom: 5px;">
                                                <p class="card-text text-start">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        viewBox="0 0 384 512">
                                                        <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                                        <path
                                                            d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 256c-35.3 0-64-28.7-64-64s28.7-64 64-64s64 28.7 64 64s-28.7 64-64 64z" />
                                                    </svg>
                                                   ' . $compound->city . ' , ' . $compound->address . '
                                                </p>
                                            </li>
                                            <li style="margin-bottom: 5px;">
                                                <p class="card-text text-start">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        viewBox="0 0 640 512">
                                                        <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                                        <path
                                                            d="M480 48c0-26.5-21.5-48-48-48H336c-26.5 0-48 21.5-48 48V96H224V24c0-13.3-10.7-24-24-24s-24 10.7-24 24V96H112V24c0-13.3-10.7-24-24-24S64 10.7 64 24V96H48C21.5 96 0 117.5 0 144v96V464c0 26.5 21.5 48 48 48H304h32 96H592c26.5 0 48-21.5 48-48V240c0-26.5-21.5-48-48-48H480V48zm96 320v32c0 8.8-7.2 16-16 16H528c-8.8 0-16-7.2-16-16V368c0-8.8 7.2-16 16-16h32c8.8 0 16 7.2 16 16zM240 416H208c-8.8 0-16-7.2-16-16V368c0-8.8 7.2-16 16-16h32c8.8 0 16 7.2 16 16v32c0 8.8-7.2 16-16 16zM128 400c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16V368c0-8.8 7.2-16 16-16h32c8.8 0 16 7.2 16 16v32zM560 256c8.8 0 16 7.2 16 16v32c0 8.8-7.2 16-16 16H528c-8.8 0-16-7.2-16-16V272c0-8.8 7.2-16 16-16h32zM256 176v32c0 8.8-7.2 16-16 16H208c-8.8 0-16-7.2-16-16V176c0-8.8 7.2-16 16-16h32c8.8 0 16 7.2 16 16zM112 160c8.8 0 16 7.2 16 16v32c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16V176c0-8.8 7.2-16 16-16h32zM256 304c0 8.8-7.2 16-16 16H208c-8.8 0-16-7.2-16-16V272c0-8.8 7.2-16 16-16h32c8.8 0 16 7.2 16 16v32zM112 320H80c-8.8 0-16-7.2-16-16V272c0-8.8 7.2-16 16-16h32c8.8 0 16 7.2 16 16v32c0 8.8-7.2 16-16 16zm304-48v32c0 8.8-7.2 16-16 16H368c-8.8 0-16-7.2-16-16V272c0-8.8 7.2-16 16-16h32c8.8 0 16 7.2 16 16zM400 64c8.8 0 16 7.2 16 16v32c0 8.8-7.2 16-16 16H368c-8.8 0-16-7.2-16-16V80c0-8.8 7.2-16 16-16h32zm16 112v32c0 8.8-7.2 16-16 16H368c-8.8 0-16-7.2-16-16V176c0-8.8 7.2-16 16-16h32c8.8 0 16 7.2 16 16z" />
                                                    </svg>
                                                    ' . $compound->buildings->count() . '
                                                </p>
                                            </li>
                                            <li style="margin-bottom: 5px;">
                                                <p class="card-text text-start">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        viewBox="0 0 384 512">
                                                        <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                                        <path
                                                            d="M88 104C88 95.16 95.16 88 104 88H152C160.8 88 168 95.16 168 104V152C168 160.8 160.8 168 152 168H104C95.16 168 88 160.8 88 152V104zM280 88C288.8 88 296 95.16 296 104V152C296 160.8 288.8 168 280 168H232C223.2 168 216 160.8 216 152V104C216 95.16 223.2 88 232 88H280zM88 232C88 223.2 95.16 216 104 216H152C160.8 216 168 223.2 168 232V280C168 288.8 160.8 296 152 296H104C95.16 296 88 288.8 88 280V232zM280 216C288.8 216 296 223.2 296 232V280C296 288.8 288.8 296 280 296H232C223.2 296 216 288.8 216 280V232C216 223.2 223.2 216 232 216H280zM0 64C0 28.65 28.65 0 64 0H320C355.3 0 384 28.65 384 64V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM48 64V448C48 456.8 55.16 464 64 464H144V400C144 373.5 165.5 352 192 352C218.5 352 240 373.5 240 400V464H320C328.8 464 336 456.8 336 448V64C336 55.16 328.8 48 320 48H64C55.16 48 48 55.16 48 64z" />
                                                    </svg>
                                                    ' . $compound->apartments->count() . '
                                                </p>
                                            </li>
                                        </ul>' . '</div>' . '</div>' . '</div>' . '</div>' . '</div>';
                }
            } else {
                $output = '<p style="margin-left:auto;margin-right:auto;" >No Data Found</p>';
            }
            $data = array(
                'table_data'  => $output,
                'total_data'  => $total_row
            );

            echo json_encode($data);
        }
    }

    public function buildingIndex()
    {
        $buildings = Building::paginate(10);
        return view('dashboard.admin.building.index', ['buildings' => $buildings]);
    }

    public function buildingSearch(Request $request)
    {
        $query = $request->get('search');
        if ($request->ajax()) {
            $output = "";
            $buildings = Building::where('name', 'like', '%' . $query . '%')
                ->orWhere('city', 'like', '%' . $query . '%')
                ->orWhere('address', 'like', '%' . $query . '%')
                ->orderBy('id', 'desc')
                ->get();

            $total_row = $buildings->count();

            if ($total_row > 0) {

                foreach ($buildings as $building) {
                    $output .= '<div class="col" id="div_content" style=" padding: 0;">' .
                        ' <div class="card mb-3" id="div_card" style="">' .
                        ' <div class="row g-0">' .
                        ' <div class="col-md-4">' .
                        '<img src="https://via.placeholder.com/200" style="height: 100%;" class="img-fluid rounded-start" alt="...">' .
                        '</div>' .
                        '<div class="col-md-8">' .
                        '<div class="card-body">' .
                        '<div style="display: flex; justify-content: space-between;">' .
                        ' <h5 class="card-title text-start ">' . $building->name . '</h5>' .
                        '</div>' .
                        '<ul class="text-start" style="list-style-type: none; padding: 0;">
                                            <li style="margin-bottom: 5px;">
                                                <p class="card-text text-start">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        viewBox="0 0 384 512">
                                                        <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                                        <path
                                                            d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 256c-35.3 0-64-28.7-64-64s28.7-64 64-64s64 28.7 64 64s-28.7 64-64 64z" />
                                                    </svg>
                                                   ' . $building->city . ' , ' . $building->address . '
                                                </p>
                                            </li>
                                            <li style="margin-bottom: 5px;">
                                                <p class="card-text text-start">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        viewBox="0 0 640 512">
                                                        <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                                        <path
                                                            d="M480 48c0-26.5-21.5-48-48-48H336c-26.5 0-48 21.5-48 48V96H224V24c0-13.3-10.7-24-24-24s-24 10.7-24 24V96H112V24c0-13.3-10.7-24-24-24S64 10.7 64 24V96H48C21.5 96 0 117.5 0 144v96V464c0 26.5 21.5 48 48 48H304h32 96H592c26.5 0 48-21.5 48-48V240c0-26.5-21.5-48-48-48H480V48zm96 320v32c0 8.8-7.2 16-16 16H528c-8.8 0-16-7.2-16-16V368c0-8.8 7.2-16 16-16h32c8.8 0 16 7.2 16 16zM240 416H208c-8.8 0-16-7.2-16-16V368c0-8.8 7.2-16 16-16h32c8.8 0 16 7.2 16 16v32c0 8.8-7.2 16-16 16zM128 400c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16V368c0-8.8 7.2-16 16-16h32c8.8 0 16 7.2 16 16v32zM560 256c8.8 0 16 7.2 16 16v32c0 8.8-7.2 16-16 16H528c-8.8 0-16-7.2-16-16V272c0-8.8 7.2-16 16-16h32zM256 176v32c0 8.8-7.2 16-16 16H208c-8.8 0-16-7.2-16-16V176c0-8.8 7.2-16 16-16h32c8.8 0 16 7.2 16 16zM112 160c8.8 0 16 7.2 16 16v32c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16V176c0-8.8 7.2-16 16-16h32zM256 304c0 8.8-7.2 16-16 16H208c-8.8 0-16-7.2-16-16V272c0-8.8 7.2-16 16-16h32c8.8 0 16 7.2 16 16v32zM112 320H80c-8.8 0-16-7.2-16-16V272c0-8.8 7.2-16 16-16h32c8.8 0 16 7.2 16 16v32c0 8.8-7.2 16-16 16zm304-48v32c0 8.8-7.2 16-16 16H368c-8.8 0-16-7.2-16-16V272c0-8.8 7.2-16 16-16h32c8.8 0 16 7.2 16 16zM400 64c8.8 0 16 7.2 16 16v32c0 8.8-7.2 16-16 16H368c-8.8 0-16-7.2-16-16V80c0-8.8 7.2-16 16-16h32zm16 112v32c0 8.8-7.2 16-16 16H368c-8.8 0-16-7.2-16-16V176c0-8.8 7.2-16 16-16h32c8.8 0 16 7.2 16 16z" />
                                                    </svg>
                                                    ' . $building->apartments->count() . '
                                                </p>
                                            </li>
                                        </ul>' . '</div>' . '</div>' . '</div>' . '</div>' . '</div>';
                }
            } else {
                $output = '<p style="margin-left:auto;margin-right:auto;" >No Data Found</p>';
            }
            $data = array(
                'table_data'  => $output,
                'total_data'  => $total_row
            );

            echo json_encode($data);
        }
    }

    public function apartmentIndex()
    {
        $apartments = Apartment::paginate(10);
        return view('dashboard.admin.apartment.index', ['apartments' => $apartments]);
    }

    public function apartmentSearch(Request $request)
    {
        $query = $request->get('search');
        if ($request->ajax()) {
            $output = "";
            $apartments = Apartment::where('apartment_name', 'like', '%' . $query . '%')
                ->orWhere('city', 'like', '%' . $query . '%')
                ->orWhere('address', 'like', '%' . $query . '%')
                ->orWhere('space', 'like', '%' . $query . '%')
                ->orWhere('ac_type', 'like', '%' . $query . '%')
                ->orWhere('floor_number', 'like', '%' . $query . '%')
                ->orWhere('number_of_bedrooms', 'like', '%' . $query . '%')
                ->orWhere('type_of_kitchen', 'like', '%' . $query . '%')
                ->orWhere('electricity_meter_number', 'like', '%' . $query . '%')
                ->orWhere('water_meter_number', 'like', '%' . $query . '%')
                ->orderBy('id', 'desc')
                ->get();

            $total_row = $apartments->count();

            if ($total_row > 0) {

                foreach ($apartments as $apartment) {
                    $output .= '<div class="col" id="div_content" style=" padding: 0;">' .
                        ' <div class="card mb-3" id="div_card" style="">' .
                        ' <div class="row g-0">' .
                        ' <div class="col-md-4">' .
                        '<img src="https://via.placeholder.com/200" style="height: 100%;" class="img-fluid rounded-start" alt="...">' .
                        '</div>' .
                        '<div class="col-md-8">' .
                        '<div class="card-body">' .
                        '<div style="display: flex; justify-content: space-between;">' .
                        ' <h5 class="card-title text-start ">' . $apartment->name . '</h5>' .
                        '</div>' .
                        '<ul class="text-start" style="list-style-type: none; padding: 0;">
                                            <li style="margin-bottom: 5px;">
                                                <p class="card-text text-start">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        viewBox="0 0 384 512">
                                                        <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                                        <path
                                                            d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 256c-35.3 0-64-28.7-64-64s28.7-64 64-64s64 28.7 64 64s-28.7 64-64 64z" />
                                                    </svg>
                                                   ' . $apartment->city . ' , ' . $apartment->address . '
                                                </p>
                                            </li>
                                        </ul>' . '</div>' . '</div>' . '</div>' . '</div>' . '</div>';
                }
            } else {
                $output = '<p style="margin-left:auto;margin-right:auto;" >No Data Found</p>';
            }
            $data = array(
                'table_data'  => $output,
                'total_data'  => $total_row
            );

            echo json_encode($data);
        }
    }
}
