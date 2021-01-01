<?php

namespace App\Http\Resources;

use App\Models\Photos;
use App\Models\PhotosUpload;
use Illuminate\Http\Resources\Json\JsonResource;

class PagesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'screen_name' => $this->screen_name,
            'name'        => $this->name,
            'photo'       => PhotosUpload::where('id', Photos::where('id', $this->photo)->value('upload_id'))->value('photo'),
            'cover'       => PhotosUpload::where('id', Photos::where('id', $this->cover)->value('upload_id'))->value('photo'),
            'verified'    => $this->verified,
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at
        ];
    }
}
