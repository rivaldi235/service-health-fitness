<?php

namespace App\Service;

use App\Repositories\FoodRepository;
use App\Repositories\ActivityRepository;

Class ActivityService
{
    protected $activityRepository;

    public function __construct(ActivityRepository $activityRepository)
    {
        $this->activityRepository = $activityRepository;
    }

    public function getActivities()
    {
       $activities = $this->activityRepository->getActivities();
       return $activities;
    }

    public function createActivity(array $data)
    {
        $activity = $this->activityRepository->createActivity($data);
        return $activity;
    }

    public function getActivity(string $id)
    {
        $activity = $this->activityRepository->getActivityById($id);
        return $activity;
    }

    public function updateActivity(string $id, array $data)
    {
        $activity = $this->getActivity($id);
        $activity = $this->activityRepository->updateActivity($activity, $data);
        return $activity;
    }

    public function deleteActivity(string $id)
    {
        $activity = $this->getActivity($id);
        $this->activityRepository->deleteActivity($activity);
    }
}