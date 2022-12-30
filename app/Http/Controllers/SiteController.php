<?php

namespace App\Http\Controllers;

use App\Gallery;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        $galleries = $this->galleriesList();

        return view('index', ['list' => $galleries]);
    }

    public function galleriesList($count = 10)
    {
        $galleries = Gallery::orderBy('id', 'desc')->take($count)->get();

        if( ! empty($galleries)) {
            foreach ($galleries as &$gallery) {
                $gallery->photo = \App\GalleryDetails::where(['gallery_id' => $gallery->id])->first();
                $gallery->url = '/gallery/' . $gallery->id;
            } unset($gallery);

            return $galleries;
        }

        return false;
    }
}
