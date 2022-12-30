<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GalleryDetails extends Model
{
    protected $fillable = ['gallery_id', 'filename'];

    public function item()
    {
        return $this->belongsTo('App\Gallery');
    }
}
