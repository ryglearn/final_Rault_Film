<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

class WatchController extends Controller
{
    //
    public function show($slug){
        $videoList = [
            'all-quiet-on-the-western-front' => 'https://pixeldrain.com/api/file/xAe9WaoN',
        ];

        $videoURL = $videoList[$slug] ?? null;

        return view('watch', compact('videoURL', 'slug'));
    }
}
