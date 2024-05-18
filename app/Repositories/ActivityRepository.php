<?php

namespace App\Repositories;

use App\Models\Activity;


class ActivityRepository
{
    public function getActivities()
    {
        return Activity::paginate(10);
    }

    public function createActivity(array $activity)
    {
        return Activity::create($activity);
    }

    public function getActivityById(string $id)
    {
        return Activity::findOrFail($id);
    }

    public function updateActivity(Activity $activity, array $data)
    {
        $activity->update($data);
        return $activity;
    }

    public function deleteActivity(Activity $activity)
    {
        $activity->delete();
    }
}