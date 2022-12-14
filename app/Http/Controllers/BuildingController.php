<?php

namespace App\Http\Controllers;

use App\Models\Building;
use Illuminate\Http\Request;
use App\Models\Image as Images;
use App\Traits\image;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\Response;

class BuildingController extends Controller
{
    use image;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buildings = Building::with('compound')->where('property_owner_id', auth('owner')->user()->id)->paginate(10);
        return view('dashboard.owner.building.index', ['buildings' => $buildings]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $compounds = auth('owner')->user()->compounds;
        return view('dashboard.owner.building.create', ['compounds' => $compounds]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->input('kind') == '0') {

            $validator = Validator($request->all(), [
                'kind' => 'required',
                'name' => 'required | max:50',
                'compound_id' => 'required',
            ]);

            if (!$validator->fails()) {
                $building = new Building();
                $building->kind = $request->input('kind');
                $building->name = $request->input('name');
                $building->compound_id = $request->input('compound_id');
                $building->property_owner_id = auth('owner')->user()->id;
                $isSaved = $building->save();
                if ($request->images != null) {
                    foreach ($request->images as $image) {
                        $images = new Images();
                        $this->saveImage($image, 'images/building', $images, $building);
                    }
                }
                return response()->json(
                    [
                        'message' => $isSaved ? 'Building created successfully' : 'Created failed!'
                    ],
                    $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
                );
            } else {
                return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
            }
            //end kind 0 condition
        } else {

            $validator = Validator($request->all(), [
                'kind' => 'required',
                'name' => 'required | max:50',
                'city' => 'required | max:50',
                'address' => 'required | max:50',
            ]);

            if (!$validator->fails()) {
                $building = new Building();
                $building->kind = $request->input('kind');
                $building->name = $request->input('name');
                $building->city = $request->input('city');
                $building->address = $request->input('address');
                $building->property_owner_id = auth('owner')->user()->id;
                $isSaved = $building->save();
                if ($request->images != null) {
                    foreach ($request->images as $image) {
                        $images = new Images();
                        $this->saveImage($image, 'images/building', $images, $building);
                    }
                }
                return response()->json(
                    [
                        'message' => $isSaved ? 'Building created successfully' : 'Created failed!'
                    ],
                    $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
                );
            } else {
                return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
            }
            //end kind 1 condition
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function show(Building $building)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function edit(Building $building)
    {
        $compounds = auth('owner')->user()->compounds;
        return view('dashboard.owner.building.edit', ['building' => $building, 'compounds' => $compounds]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Building $building)
    {
        if ($request->input('kind') == '0') {

            $validator = Validator($request->all(), [
                'kind' => 'required',
                'name' => 'required | max:50',
                'compound_id' => 'required',
            ]);

            if (!$validator->fails()) {
                $building->kind = $request->input('kind');
                $building->name = $request->input('name');
                $building->compound_id = $request->input('compound_id');
                $building->property_owner_id = auth('owner')->user()->id;
                $isSaved = $building->save();
                if ($request->images != null) {
                    foreach ($request->images as $image) {
                        $images = new Images();
                        $this->saveImage($image, 'images/building', $images, $building);
                    }
                }
                return response()->json(
                    [
                        'message' => $isSaved ? 'Building created successfully' : 'Created failed!'
                    ],
                    $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
                );
            } else {
                return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
            }
            //end kind 0 condition
        } else {

            $validator = Validator($request->all(), [
                'kind' => 'required',
                'name' => 'required | max:50',
                'city' => 'required | max:50',
                'address' => 'required | max:50',
            ]);

            if (!$validator->fails()) {

                $building->kind = $request->input('kind');
                $building->name = $request->input('name');
                $building->city = $request->input('city');
                $building->address = $request->input('address');
                $building->property_owner_id = auth('owner')->user()->id;
                $isSaved = $building->save();
                if ($request->images != null) {
                    foreach ($request->images as $image) {
                        $images = new Images();
                        $this->saveImage($image, 'images/building', $images, $building);
                    }
                }
                return response()->json(
                    [
                        'message' => $isSaved ? 'Building created successfully' : 'Created failed!'
                    ],
                    $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
                );
            } else {
                return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
            }
            //end kind 1 condition
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function destroy(Building $building)
    {
        //
    }

    public function deleteImage($id)
    {
        $image = Images::where('id', $id)->first();
        File::delete($image->image_url);
        $isDeleted = $image->delete();
        return response()->json(
            ['message' => $isDeleted ? 'Deleted successfully' : 'Delete failed!'],
            $isDeleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }

    public function search(Request $request)
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
                    if ($building->kind == '0') {
                        $output .= '<tr>' .
                            '<td>' . $building->name . '<br>' . $building->compound->name . '</td>' .
                            '<td>' . $building->compound->city . '</td>' .
                            '<td>' . $building->compound->address . '</td>' .
                            '<td class="text-end"> <a href="' . route('building.edit', $building->id) . '"
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
                            </a></td>' .
                            '</tr>';
                    } else {
                        $output .= '<tr>' .
                            '<td>' . $building->name . '</td>' .
                            '<td>' . $building->city . '</td>' .
                            '<td>' . $building->address . '</td>' .
                            '<td class="text-end"> <a href="' . route('building.edit', $building->id) . '"
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
                            </a></td>' .
                            '</tr>';
                    }
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
