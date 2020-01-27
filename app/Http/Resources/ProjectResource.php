<?php

namespace App\Http\Resources;

use App\Models\Project;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ProjectResource
 *
 * @package App\Http\Resources
 *
 * @property Project $resource
 */
class ProjectResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'owner' => $this->resource->owner,
            'repo' => $this->resource->repo,
            'status' => $this->resource->status,
            'commits_count' => $this->resource->commits->count(),
        ];
    }
}
