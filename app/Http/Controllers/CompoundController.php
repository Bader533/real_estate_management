<?php

namespace App\Http\Controllers;

use App\Models\Compound;
use App\Models\Image as Images;
use App\Traits\image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\Response;

class CompoundController extends Controller
{
    use image;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $compounds = auth('owner')->user()->compounds()->paginate(10);
        return view('dashboard.owner.compound.index', ['compounds' => $compounds]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.owner.compound.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required | max:100',
            'city' => 'required | max:100',
            'address' => 'required | max:100',
            'images' => 'required | array',
        ]);
        $compound = new  Compound();
        $compound->name = $request->name;
        $compound->city = $request->city;
        $compound->address = $request->address;
        $compound->property_owner_id = auth('owner')->user()->id;
        $isSaved = $compound->save();
        if ($request->images != null) {
            foreach ($request->images as $image) {
                $images = new Images();
                $this->saveImage($image, 'images/compound', $images, $compound);
            }
        }
        if ($isSaved) {
            return response()->json(
                [
                    'status' => true,
                    'message' => $isSaved ? __('site.compounds') : 'Create failed!'
                ],
                $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
            );
        } else {
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Compound  $compound
     * @return \Illuminate\Http\Response
     */
    public function show(Compound $compound)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Compound  $compound
     * @return \Illuminate\Http\Response
     */
    public function edit(Compound $compound)
    {
        return view('dashboard.owner.compound.edit', ['compound' => $compound]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Compound  $compound
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Compound $compound)
    {
        $request->validate([
            'name' => 'required | max:100',
            'city' => 'required | max:100',
            'address' => 'required | max:100',
        ]);
        $compound->name = $request->name;
        $compound->city = $request->city;
        $compound->address = $request->address;
        $isSaved = $compound->save();
        if ($request->images != null) {
            foreach ($request->images as $image) {
                $images = new Images();
                $this->saveImage($image, 'images/compound', $images, $compound);
            }
        }
        if ($isSaved) {
            return response()->json(
                [
                    'status' => true,
                    'message' => $isSaved ? trans('site.compound_update') : 'Create failed!'
                ],
                $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
            );
        } else {
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Compound  $compound
     * @return \Illuminate\Http\Response
     */
    public function destroy(Compound $compound)
    {
        // if ($compound->images) {
        //     foreach ($compound->images as $image) {
        //         File::delete($image->image_url);
        //         $image->delete();
        //     }
        // }

        // $isDeleted = $compound->delete();
        // if ($isDeleted) {
        //     return response()->json(
        //         [
        //             'status' => true,
        //             'message' => $isDeleted ? 'deleted success' : 'Deleted failed!'
        //         ],
        //         $isDeleted ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
        //     );
        // } else {
        //     return redirect()->back();
        // }
    }

    public function search(Request $request)
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
                    $output .= '<tr>' .
                        '<td>' . $compound->name . '</td>' .
                        '<td>' . $compound->city . '</td>' .
                        '<td>' . $compound->address . '</td>' .
                        '<td class="text-end"> <a href="' . route('compound.edit', $compound->id) . '"
                                class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                <span class="svg-icon svg-icon-md svg-icon-primary">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Write.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z"
                                                fill="#000000" fill-rule="nonzero"
                                                transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)" />
                                            <path
                                                d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z"
                                                fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </a><a href="#" onclick="performDestroy(' . $compound->id . ', this)"
                                 class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                 <span class="svg-icon svg-icon-md svg-icon-primary">
                                     <!--begin::Svg Icon | path:assets/media/svg/icons/General/Trash.svg-->
                                     <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                         width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                         <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                             <rect x="0" y="0" width="24" height="24" />
                                             <path
                                                 d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                                                 fill="#000000" fill-rule="nonzero" />
                                             <path
                                                 d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                                 fill="#000000" opacity="0.3" />
                                         </g>
                                     </svg>
                                     <!--end::Svg Icon-->
                                 </span>
                             </a></td>' .
                        '</tr>';
                }
            } else {
                $output = '<tr><td align="center" colspan="4">No Data Found</td></tr>';
            }
            $data = array(
                'table_data'  => $output,
                'total_data'  => $total_row
            );

            echo json_encode($data);
        }
    }
}
