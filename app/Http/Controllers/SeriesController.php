<?php

namespace App\Http\Controllers;

use App\Http\Requests\Series\CreateSeriesRequest;
use App\Http\Requests\Series\UpdateSeriesRequest;
use App\Series;
use App\Http\Controllers\Controller;

class SeriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $series = Series::all();
        return view('admin.series.index', compact('series'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.series.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateSeriesRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateSeriesRequest $request)
    {
        return $request->uploadSeriesImage()->storeSeries();
    }

    /**
     * Display the specified resource.
     *
     * @param Series $series
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Series $series)
    {
        return view('admin.series.show', compact('series'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Series $series
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Series $series)
    {
        return view('admin.series.edit', compact('series'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSeriesRequest $request
     * @param Series $series
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UpdateSeriesRequest $request, Series $series)
    {
        if($request->hasFile('image')){
            $series->image_url = $request->uploadSeriesImage()->fileName;
        }
        $series->title = $request->title;
        $series->slug = str_slug($request->title);
        $series->description = $request->description;

        $series->save();

        session()->flash('success', 'Series updated successfully.');
        return redirect(route('series.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
