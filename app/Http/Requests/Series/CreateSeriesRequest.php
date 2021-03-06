<?php

namespace App\Http\Requests\Series;

use App\Series;

class CreateSeriesRequest extends SeriesRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'         => 'required',
            'description'   => 'required',
            'image'         => 'required|image'
        ];
    }

    /**
     * Store series function
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function storeSeries()
    {
        $series = Series::create([
            'title'         => $this->title,
            'slug'          => str_slug($this->title),
            'image_url'     => 'series/'.$this->fileName,
            'description'   => $this->description,
        ]);

        session()->flash('success', 'Series created successfully.');
        return redirect(route('series.show', $series->slug));
    }
}
