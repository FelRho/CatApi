<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\SaveImageRequest;

use Illuminate\Support\Facades\Response;
use Image;
use App\Models\Image as Images;


class StoreImageController extends Controller
{
    public function createImage(SaveImageRequest $request)
    {
        $image_file = $request->user_image;

        $image = Image::make($image_file);
   
        Response::make($image->encode('jpeg'));
   
        $form_data = array(
         'description'  => $request->description,
         'img' => $image
        );
   
        Images::create($form_data);

        return response()->json("Success", 200);
    }

    function getImage($id)
    {
     $image = Images::findOrFail($id);

     $image_file = Image::make($image->user_image);

     $response = Response::make($image_file->encode('jpeg'));

     $response->header('Content-Type', 'image/jpeg');

     return $response;
    }
}
