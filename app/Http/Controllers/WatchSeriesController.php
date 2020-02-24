<?php

namespace App\Http\Controllers;

use App\Lesson;
use App\Series;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WatchSeriesController extends Controller
{
    /**
     * Redirect series lessons
     *
     * @param Series $series
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index(Series $series)
    {
        return redirect()->route('series.watch', ['series' => $series->slug, 'lesson' => $series->lessons->first()->slug]);
    }

    /**
     * Show lesson page
     *
     * @param Series $series
     * @param Lesson $lesson
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLesson(Series $series, Lesson $lesson)
    {
        return view('watch', compact('series', 'lesson'));
    }
}
