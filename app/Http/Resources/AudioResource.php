<?php

namespace App\Http\Resources;

use App\Models\AudioUpload;
use Illuminate\Http\Resources\Json\JsonResource;

class AudioResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return AudioUpload::find($this->upload_id);
    }
}
