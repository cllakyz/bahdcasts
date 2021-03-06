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
        $user = auth()->user();
        if($user->hasStartedSeries($series)){
            return redirect()->route('series.watch', [
                'series' => $series->slug,
                'lesson' => $user->getNextLessonToWatch($series)->slug
            ]);
        }

        return redirect()->route('series.watch', [
            'series' => $series->slug,
            'lesson' => $series->lessons->first()->slug
        ]);
    }

    /**
     * Show lesson page
     *
     * @param Series $series
     * @param Lesson $lesson
     * @return mixed
     */
    public function showLesson(Series $series, Lesson $lesson)
    {
        if ($lesson->premium && !auth()->user()->subscribed('monthly') && !auth()->user()->subscribed('yearly')) {
            return redirect()->route('subscribe');
        }
        $this->setSeo($series->title, $series->description);
        return view('watch', compact('series', 'lesson'));
    }

    /**
     * Complete lesson actions
     *
     * @param Lesson $lesson
     * @return \Illuminate\Http\JsonResponse
     */
    public function completeLesson(Lesson $lesson)
    {
        auth()->user()->completeLesson($lesson);
        return response()->json([
            'status' => 'ok'
        ]);
    }
}
