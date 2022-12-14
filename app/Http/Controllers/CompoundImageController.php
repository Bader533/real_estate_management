<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\Response;


class CompoundImageController extends Controller
{
    public function deleteImage($id)
    {
        $image = Image::where('id', $id)->first();
        File::delete($image->image_url);
        // $image->delete();
        $isDeleted = $image->delete();
        return response()->json(
            ['message' => $isDeleted ? 'Deleted successfully' : 'Delete failed!'],
            $isDeleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}
