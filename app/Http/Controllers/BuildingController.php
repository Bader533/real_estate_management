<?php

namespace App\Http\Controllers;

use App\Imports\BuildingsImport;
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
                'name' => 'required | max:100',
                'compound_id' => 'required',
                'images' => 'required | array',
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
                'name' => 'required | max:100',
                'city' => 'required | max:200',
                'address' => 'required | max:300',
                'images' => 'required | array',
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
                'name' => 'required | max:100',
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
                'name' => 'required | max:200',
                'city' => 'required | max:200',
                'address' => 'required | max:300',
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
            $buildings = Building::where('property_owner_id', auth('owner')->user()->id)
                ->where('name', 'like', '%' . $query . '%')
                ->orWhere('city', 'like', '%' . $query . '%')
                ->orWhere('address', 'like', '%' . $query . '%')
                ->orderBy('id', 'desc')
                ->get();

            $total_row = $buildings->count();

            if ($total_row > 0) {

                foreach ($buildings as $building) {
                    if ($building->kind == '0') {
                        $output .= '<div class="col" id="div_content" style=" padding: 0;">' .
                            ' <div class="card mb-3" id="div_card" style="">' .
                            ' <div class="row g-0">' .
                            ' <div class="col-md-4">' .
                            '<img src="' . asset($building->images[0]->url ?? 'https://via.placeholder.com/200') . '" style="height: 100%;" class="img-fluid rounded-start" alt="...">' .
                            '</div>' .
                            '<div class="col-md-8">' .
                            '<div class="card-body">' .
                            '<div style="display: flex; justify-content: space-between;">' .
                            ' <h5 class="card-title text-start ">' . $building->name . '</h5>' .
                            '<a href="' . route('building.edit', $building->id) . '"  style="text-decoration: none; color: #17191b;">Edit</a>' .
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
                                                   ' . $building->compound->name . '
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
                    } else {
                        $output .= '<div class="col" id="div_content" style=" padding: 0;">' .
                            ' <div class="card mb-3" id="div_card" style="">' .
                            ' <div class="row g-0">' .
                            ' <div class="col-md-4">' .
                            '<img src="' . asset($building->images[0]->url ?? 'https://via.placeholder.com/200') . '" style="height: 100%;" class="img-fluid rounded-start" alt="...">' .
                            '</div>' .
                            '<div class="col-md-8">' .
                            '<div class="card-body">' .
                            '<div style="display: flex; justify-content: space-between;">' .
                            ' <h5 class="card-title text-start ">' . $building->name . '</h5>' .
                            '<a href="' . route('building.edit', $building->id) . '"  style="text-decoration: none; color: #17191b;">Edit</a>' .
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
                }
            } else {
                $output = '<p style="margin-left:auto;margin-right:auto;font-size:18px;">No Data Found</p>';
            }
            return response($output);
            // $data = array(
            //     'table_data'  => $output,
            //     'total_data'  => $total_row
            // );

            // echo json_encode($data);
        }
    }

    function viewImport()
    {
        return view('dashboard.owner.building.import');
    }
    function importShippment(Request $request)
    {
        $validator = Validator($request->all(), [
            'file' => 'required|mimes:xlsx,xls',
        ]);
        if (!$validator->fails()) {
            $file = $request->file('file')->path();
            $import = new BuildingsImport;
            $import->import($file);
            return response()->json(
                [
                    'message' => 'File Added successfully'
                ]
            );
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }
}
