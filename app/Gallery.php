<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use Notifiable;

    protected $fillable = ['title', 'description'];

    public function photos()
    {
        return $this->hasMany(GalleryDetails::class);
    }
}
