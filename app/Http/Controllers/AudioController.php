<?php

namespace App\Http\Controllers;

use App\Models\Audio;
use App\Http\Resources\AudioResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AudioController extends Controller
{
    public function index(Request $request)
    {
        $data = Audio::all();
        return new AudioResource($data);
    }

    public function get(Request $request)
    {
        $owner_id = $request->input('owner_id') ?? Auth::user()->id;
        $data = Audio::where('owner_id', $owner_id)->get();

        return [
            'count' => $data->count(),
            'items' => AudioResource::collection($data)
        ];
    }

    public function save(Request $request)
    {
        return [];
    }
}
