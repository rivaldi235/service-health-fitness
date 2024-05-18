<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Service\ActivityService;
use App\Http\Controllers\Controller;
use App\Http\Resources\ActivityResource;
use App\Http\Resources\ResponseResource;
use App\Http\Resources\ResponseErrorResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ActivityController extends Controller
{
    protected $activityService;

    public function __construct(ActivityService $activityService)
    {
        $this->activityService = $activityService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $activities = $this->activityService->getActivities();
            return ResponseResource::jsonResponse('OK', 200, ActivityResource::collection($activities));
        } catch (\Throwable $th) {
            return ResponseErrorResource::jsonResponse('Internal Server Error', 500);
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $activity = $this->activityService->createActivity($request->all());
            return ResponseResource::jsonResponse('created', 201, (new ActivityResource($activity)));
        } catch (\Throwable $th) {
            return ResponseErrorResource::jsonResponse('Internal Server Error', 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $activity = $this->activityService->getActivity($id);
            return ResponseResource::jsonResponse('OK', 200, (new ActivityResource($activity)));
        } catch (ModelNotFoundException $th) {
            return ResponseErrorResource::jsonResponse('Data Not Found', 404);
        } catch (\Throwable $e) {
            return ResponseErrorResource::jsonResponse('Internal Server Error', 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $activity = $this->activityService->updateActivity($id, $request->all());
            return ResponseResource::jsonResponse('OK', 200, (new ActivityResource($activity)));
        } catch (\Throwable $th) {
            return ResponseErrorResource::jsonResponse('Internal Server Error', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $activity = $this->activityService->deleteActivity($id);
            return ResponseResource::jsonResponse('OK', 200);
        } catch (ModelNotFoundException $th) {
            return ResponseErrorResource::jsonResponse('Data Not Found', 404);
        } catch (\Throwable $e) {
            return ResponseErrorResource::jsonResponse('Internal Server Error', 500);
        }
    }
}
