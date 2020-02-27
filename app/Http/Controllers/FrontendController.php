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
        $this->setSeo('Bahdcasts', 'The best web development training');
        $series = Series::all();
        return view('welcome', compact('series'));
    }

    /**
     * Series single page
     *
     * @param Series $series
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function series(Series $series)
    {
        $this->setSeo($series->title, $series->description);
        return view('series', compact('series'));
    }

    /**
     * Show all the series
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAllSeries() {
        $this->setSeo('Bahdcasts', 'The best web development training');
        $series = Series::all();
        return view('all-series', compact('series'));
    }
}
