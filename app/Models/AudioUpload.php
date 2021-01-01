<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AudioUpload extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'audio_upload';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'owner_id',
        'title',
        'artist',
        'cover',
        'path'
    ];
}
