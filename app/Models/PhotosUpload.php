<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhotosUpload extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'photos_upload';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'owner_id',
        'path'
    ];
}
