<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $guarded = [];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function series()
    {
        return $this->belongsTo(Series::class);
    }

    /**
     * Get next lesson after $this
     *
     * @return Lesson
     */
    public function getNextLesson()
    {
        $nextLesson = $this->series->lessons()
            ->where('episode_number', '>', $this->episode_number)
            ->orderBy('episode_number', 'asc')
            ->first();
        if ($nextLesson){
            return $nextLesson;
        }

        return $this;
    }

    /**
     * Get previous lesson before $this
     *
     * @return Lesson
     */
    public function getPrevLesson()
    {
        $prevLesson = $this->series->lessons()
            ->where('episode_number', '<', $this->episode_number)
            ->orderBy('episode_number', 'desc')
            ->first();
        if ($prevLesson){
            return $prevLesson;
        }

        return $this;
    }
}
