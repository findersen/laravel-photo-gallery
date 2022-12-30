<?php

namespace App\Http\Controllers;

use App\Gallery;
use Illuminate\Http\Request;

class GalleryViewController extends Controller
{
    public function galleryView($id)
    {
        $gallery = Gallery::findOrFail($id);
        $gallery->photos = \App\GalleryDetails::where(['gallery_id' => $id])->get();

        return view('gallery', ['gallery' => $gallery]);
    }
}
