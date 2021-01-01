<?php

namespace App\Http\Controllers;

use App\Models\Pages;
use App\Http\Resources\PagesResource;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function getById(Request $request)
    {
    	$id = $request->input('page_id');
        $data = Pages::find($id);

    	return new PagesResource($data);
    }

    public function create(Request $request)
    {
    	$validate = $this->validate($request, [
            'name'  => 'required|string|min:1|max:256',
            'about' => 'string|min:1|max:512'
        ]);

        $data = Pages::create($validate);

    	return new PagesResource($data);
    }
}
