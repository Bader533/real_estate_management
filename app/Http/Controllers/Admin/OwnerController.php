<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PropertyOwner;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function ownerIndex()
    {
        $owners = PropertyOwner::paginate(10);
        return view('dashboard.admin.owner.index', ['owners' => $owners]);
    }

    public function ownerSearch(Request $request)
    {
        $query = $request->get('search');
        if ($request->ajax()) {
            $output = "";
            $owners = PropertyOwner::where('name', 'like', '%' . $query . '%')
                ->orWhere('company_name', 'like', '%' . $query . '%')
                ->orWhere('email', 'like', '%' . $query . '%')
                ->orWhere('phone', 'like', '%' . $query . '%')
                ->orderBy('id', 'desc')
                ->get();

            $total_row = $owners->count();

            if ($total_row > 0) {

                foreach ($owners as $owner) {
                    $output .= ' <tr>

                                <td>
                                    ' . ($owner->name != null ? $owner->name : $owner->company_name) . '
                                </td>

                                <td>
                                   ' . $owner->email . '
                                </td>

                                <td>
                                    ' . $owner->phone . '
                                </td>

                                <td>
                                   ' . $owner->compounds->count() . '
                                </td>

                                <td>
                                    ' . $owner->buildings->count() . '
                                </td>

                                <td>
                                    ' . $owner->apartments->count() . '
                                </td>

                            </tr>';
                }
            } else {
                $output = '<tr><td align="center" colspan="5">No Data Found</td></tr>';
            }
            $data = array(
                'table_data'  => $output,
                'total_data'  => $total_row
            );

            echo json_encode($data);
        }
    }
}
