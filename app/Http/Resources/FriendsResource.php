<?php

namespace App\Http\Resources;

use App\Models\Users;
use App\Http\Resources\UsersResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class FriendsResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return UsersResource::collection(Users::whereIn('id', $this->collection)->get());
    }
}
