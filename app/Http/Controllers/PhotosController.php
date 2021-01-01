<?php

namespace App\Http\Controllers;

use App\Models\Photos;
use App\Http\Resources\PhotosResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PhotosController extends Controller
{
    public function get(Request $request)
    {
    	$owner_id = $request->input('owner_id') ?? Auth::user()->id;
    	$data = Photos::where('owner_id', $owner_id)->get();

    	return [
            'count' => $data->count(),
            'items' => PhotosResource::collection($data)
        ];
    }
}
