<?php

namespace App\Http\Resources;

use App\Models\Photos;
use App\Models\Audio;
use App\Models\WallPhotos;
use App\Models\WallAudio;
use App\Http\Resources\PhotosResource;
use App\Http\Resources\AudioResource;
use Illuminate\Http\Resources\Json\JsonResource;

class WallResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $photos = PhotosResource::collection(Photos::whereIn('id', WallPhotos::where('wall_id', $this->id)->pluck('photos_id'))->get());
        $audios = AudioResource::collection(Audio::whereIn('id', WallAudio::where('wall_id', $this->id)->pluck('audio_id'))->get());

        foreach ($photos as $photo) {
            $attachments[] = [
                'type' => 'photo',
                'photo'=> $photo
            ];
        }
        
        foreach ($audios as $audio) {
            $attachments[] = [
                'type' => 'audio',
                'audio'=> $audio
            ];
        }

        return [
            'id'           => $this->id,
            'from_id'      => $this->from_id,
            'owner_id'     => $this->owner_id,
            'text'         => $this->text,
            'created_at'   => $this->created_at,
            'updated_at'   => $this->updated_at,
            'attachments'  => $attachments ?? [],
            'comments'     => [
                'count' => 0
            ],
            'shares'       => [
                'count' => 0
            ],
            'likes'        => [
                'count' => 0
            ],
            'views'        => [
                'count' => 0
            ]
        ];
    }
}
