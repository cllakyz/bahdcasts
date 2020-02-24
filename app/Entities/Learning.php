<?php

namespace App\Entities;

use Redis;
use App\Lesson;
use App\Series;

trait Learning
{
    /**
     * Complete lesson function
     *
     * @param Lesson $lesson
     * @return bool|int
     */
    public function completeLesson(Lesson $lesson)
    {
        return Redis::sadd("user:{$this->id}:series:{$lesson->series->id}", $lesson->id);
    }

    /**
     * Percenage completed for series
     *
     * @param Series $series
     * @return float|int
     */
    public function percentageCompletedForSeries(Series $series)
    {
        $numberOfLessonsInSeries = $series->lessons->count();
        $numberOfCompletedLessons = $this->getNumberOfCompletedLessonsForASeries($series);

        return (($numberOfCompletedLessons / $numberOfLessonsInSeries) * 100);
    }

    /**
     * Completed lessons for a series
     *
     * @param Series $series
     * @return int
     */
    public function getNumberOfCompletedLessonsForASeries(Series $series)
    {
        return count(Redis::smembers("user:{$this->id}:series:{$series->id}"));
    }
}