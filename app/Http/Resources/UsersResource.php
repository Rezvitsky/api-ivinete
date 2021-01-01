<?php

namespace App\Http\Resources;

use App\Models\Photos;
use App\Models\PhotosUpload;
use Illuminate\Http\Resources\Json\JsonResource;

class UsersResource extends JsonResource
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
            'id'           => $this->id,
            'screen_name'  => $this->screen_name,
            'first_name'   => $this->first_name,
            'last_name'    => $this->last_name,
            'photo'        => PhotosUpload::where('id', Photos::where('id', $this->photo)->value('upload_id'))->value('photo'),
            'cover'        => PhotosUpload::where('id', Photos::where('id', $this->cover)->value('upload_id'))->value('photo'),
            'about'        => $this->about,
            'sex'          => $this->sex,
            'type'         => $this->type,
            'verified'     => $this->verified
        ];
    }
}
