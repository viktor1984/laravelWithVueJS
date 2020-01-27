<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommitListRequest;
use App\Http\Requests\ProjectRequest;
use App\Http\Resources\CommitResource;
use App\Http\Resources\ProjectResource;
use App\Jobs\DownloadGitRepoJob;
use App\Models\Project;

/**
 * Class ProjectsController
 *
 * @package App\Http\Controllers\Api
 */
class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return ProjectResource::collection(Project::query()->paginate());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Project $project
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function commits(Project $project)
    {
        return CommitResource::collection($project->commits()->paginate(20));
    }

    /**
     * @param Project $project
     * @param CommitListRequest $request
     *
     * @return array
     */
    public function deleteCommits(Project $project, CommitListRequest $request)
    {
        $result = $project->commits()->whereIn('id', $request->list)->delete();

        return [
            'data' => [
                'status' => ($result == count($request->list)) ? 'ok' : 'error',
            ],
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProjectRequest $request
     *
     * @return ProjectResource
     */
    public function store(ProjectRequest $request)
    {
        /** @var Project $project */
        $project = Project::firstOrCreate($request->all());

        DownloadGitRepoJob::dispatch($project->id);

        return new ProjectResource($project);
    }

    /**
     * Display the specified resource.
     *
     * @param Project $project
     *
     * @return ProjectResource
     */
    public function show(Project $project)
    {
        return new ProjectResource($project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Project $project
     *
     * @return array
     *
     * @throws \Exception
     */
    public function destroy(Project $project)
    {
        if ($project->delete()) {
            return [
                'status' => 'success',
            ];
        }

        return [
            'status' => 'error',
        ];
    }
}
