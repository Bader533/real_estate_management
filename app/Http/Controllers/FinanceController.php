<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FinanceController extends Controller
{
    public function index()
    {
        return view('dashboard.owner.finance.index');
    }

    public function search(Request $request)
    {
        $contracts = auth('owner')->user()->contracts()
            ->where('from', '>=', Carbon::parse($request->input('from')))
            ->where('to', '<=', Carbon::parse($request->input('to')))->get();
        return view('dashboard.owner.finance.index', ['contracts' => $contracts]);
    }

    public function liveSearch(Request $request)
    {
        $query = $request->get('search');
        if ($request->ajax()) {
            $output = "";
            $contracts = Contract::where('number_of_batches', 'like', '%' . $query . '%')
                ->orWhere('total_amount_of_rent', 'like', '%' . $query . '%')
                ->orWhere('guarantee_amount', 'like', '%' . $query . '%')
                ->orWhere('payment_method', 'like', '%' . $query . '%')
                ->orderBy('id', 'desc')
                ->get();

            $total_row = $contracts->count();

            if ($total_row > 0) {

                foreach ($contracts as $contract) {
                    $output .= '<tr>
                                    <td>
                                        ' . $contract->tenant->name . '
                                    </td>

                                    <td>
                                        ' . $contract->number_of_batches . '
                                    </td>

                                    <td>
                                        ' . $contract->total_amount_of_rent . '
                                    </td>

                                    <td>
                                        ' . $contract->guarantee_amount . '
                                    </td>

                                    <td>
                                        ' . $contract->payment_method . '
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
