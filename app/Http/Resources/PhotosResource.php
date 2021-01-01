<?php

namespace App\Http\Resources;

use App\Models\PhotosUpload;
use Illuminate\Http\Resources\Json\JsonResource;

class PhotosResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return PhotosUpload::find($this->upload_id);;
    }
}
