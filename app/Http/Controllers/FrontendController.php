<?php

namespace App\Http\Controllers;

use App\Series;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    /**
     * welcom page function
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function welcome()
    {
        $series = Series::all();
        return view('welcome', compact('series'));
    }
}
