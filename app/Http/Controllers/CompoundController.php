<?php

namespace App\Http\Controllers;

use App\Imports\CompoundsImport;
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
        $validator = Validator($request->all(), [
            'name' => 'required | string | max:100',
            'city' => 'required | string | max:200',
            'address' => 'required | string | max:300',
            'images' => 'required | array',
        ]);
        if (!$validator->fails()) {
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

            return response()->json(
                [
                    'message' => $isSaved ? __('site.compounds') : 'Create failed!'
                ],
                $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
            );
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
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
        $validator = Validator($request->all(), [
            'name' => 'required |string | max:100',
            'city' => 'required |string | max:100',
            'address' => 'required |string | max:300',
        ]);
        if (!$validator->fails()) {
            $compound->name = $request->input('name');
            $compound->city = $request->input('city');
            $compound->address = $request->input('address');
            $isSaved = $compound->save();
            if ($request->images != null) {
                foreach ($request->images as $image) {
                    $images = new Images();
                    $this->saveImage($image, 'images/compound', $images, $compound);
                }
            }

            return response()->json(
                [
                    'message' => $isSaved ? trans('site.compound_update') : 'Create failed!'
                ],
                $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
            );
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
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
    }

    public function search(Request $request)
    {
        $query = $request->get('search');
        if ($request->ajax()) {
            $output = "";
            $compounds = Compound::where('property_owner_id', auth('owner')->user()->id)->where('name', 'like', '%' . $query . '%')
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
                        '<img src="' . asset($compound->images[0]->url ?? 'https://via.placeholder.com/200') . '" style="height: 100%;" class="img-fluid rounded-start" alt="...">' .
                        '</div>' .
                        '<div class="col-md-8">' .
                        '<div class="card-body">' .
                        '<div style="display: flex; justify-content: space-between;">' .
                        ' <h5 class="card-title text-start ">' . $compound->name . '</h5>' .
                        '<a href="' . route('compound.edit', $compound->id) . '"  style="text-decoration: none; color: #17191b;">Edit</a>' .
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
                $output = '<p style="margin-left:auto;margin-right:auto;font-size:18px;">No Data Found</p>';
            }
            // $data = array(
            //     'table_data'  => $output,
            //     'total_data'  => $total_row
            // );
            return response($output);
        }
    }

    function viewImport()
    {
        return view('dashboard.owner.compound.import');
    }
    function importShippment(Request $request)
    {
        $validator = Validator($request->all(), [
            'file' => 'required|mimes:xlsx,xls',
        ]);
        if (!$validator->fails()) {
            $file = $request->file('file')->path();
            $import = new CompoundsImport;
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
