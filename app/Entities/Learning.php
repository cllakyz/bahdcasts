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
     * Completed lessons count for a series
     *
     * @param Series $series
     * @return int
     */
    public function getNumberOfCompletedLessonsForASeries(Series $series)
    {
        return count($this->getCompletedLessonsForASeries($series));
    }

    /**
     * Completed lessons for a series
     *
     * @param Series $series
     * @return array
     */
    public function getCompletedLessonsForASeries(Series $series)
    {
        return Redis::smembers("user:{$this->id}:series:{$series->id}");
    }

    /**
     * Started lessons for a series
     *
     * @param Series $series
     * @return bool
     */
    public function hasStartedSeries(Series $series)
    {
        return $this->getNumberOfCompletedLessonsForASeries($series) > 0;
    }

    /**
     * Completed lessons for a series by collection
     *
     * @param Series $series
     * @return Lesson
     */
    public function getCompletedLessons(Series $series)
    {
        $completedLessons = $this->getCompletedLessonsForASeries($series);

        /*return collect($completedLessons)->map(function ($lessonId){
            return Lesson::find($lessonId);
        });*/

        return Lesson::whereIn('id', $completedLessons)->get();
    }

    /**
     * lesson is completed?
     * @param Lesson $lesson
     * @return bool
     */
    public function hasCompletedLesson(Lesson $lesson)
    {
        return in_array($lesson->id, $this->getCompletedLessonsForASeries($lesson->series));
    }

    /**
     * Get all the series being watch ids
     *
     * @return array
     */
    public function seriesBeingWatchedIds() {
        $keys = Redis::keys("user:{$this->id}:series:*");
        $seriesIds = [];
        foreach($keys as $key):
            $seriedId = explode(':', $key)[3];
            array_push($seriesIds, $seriedId);
        endforeach;

        return $seriesIds;
    }

    /**
     * Get all the series a user is watching
     *
     * @return \Illuminate\Support\Collection
     */
    public function seriesBeingWatched() {
        return collect($this->seriesBeingWatchedIds())->map(function($id){
            return Series::find($id);
        })->filter();
    }

    /**
     * Get total number of lessons user has ever completed
     *
     * @return int
     */
    public function getTotalNumberOfCompletedLessons()
    {
        $keys = Redis::keys("user:{$this->id}:series:*");
        $result = 0;
        foreach ($keys as $key):
            $result += count(Redis::smembers($key));
        endforeach;

        return $result;
    }
}