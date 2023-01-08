<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function tenantIndex()
    {
        $tenants = Tenant::paginate(10);
        return view('dashboard.admin.tenant.index', ['tenants' => $tenants]);
    }

    public function tenantSearch(Request $request)
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
                    $output .= ' <tr>

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
