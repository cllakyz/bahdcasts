<?php

namespace App\Http\Requests\Series;

use Illuminate\Foundation\Http\FormRequest;

class SeriesRequest extends FormRequest
{
    /**
     * Upload image function
     * @return $this
     */
    public function uploadSeriesImage()
    {
        $uploadedImage = $this->image;
        $this->fileName = str_slug($this->title).".".$uploadedImage->getClientOriginalExtension();
        $uploadedImage->storePubliclyAs('public/series', $this->fileName);
        return $this;
    }
}
