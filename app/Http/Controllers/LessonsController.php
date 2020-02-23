<?php

namespace App\Http\Controllers;

use App\Http\Requests\Lessons\CreateLessonsRequest;
use App\Http\Requests\Lessons\UpdateLessonsRequest;
use App\Lesson;
use App\Series;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LessonsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Series $series
     * @param CreateLessonsRequest $request
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(Series $series, CreateLessonsRequest $request)
    {
        $data = $request->all();
        $data['slug'] = str_slug($data['title']);
        return $series->lessons()->create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Series $series
     * @param Lesson $lesson
     * @param UpdateLessonsRequest $request
     * @return Lesson
     */
    public function update(Series $series, Lesson $lesson, UpdateLessonsRequest $request)
    {
        $data = $request->all();
        $data['slug'] = str_slug($data['title']);
        $lesson->update($data);
        return $lesson->fresh();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Series $series
     * @param Lesson $lesson
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Series $series, Lesson $lesson)
    {
        $lesson->delete();
        return response()->json(['status' => 'OK']);
    }
}
