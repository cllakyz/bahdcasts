<?php

namespace App\Http\Requests\Series;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSeriesRequest extends FormRequest
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
            'image'         => 'image'
        ];
    }

    /**
     * Upload image function
     * @return $this
     */
    public function uploadSeriesImage()
    {
        $uploadedImage = $this->image;
        $this->fileName = str_slug($this->title).".".$uploadedImage->getClientOriginalExtension();
        $uploadedImage->storePubliclyAs('series', $this->fileName);
        return $this;
    }
}
