<?php

namespace App\Http\Resources;

use App\Models\Commit;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class CommitResource
 *
 * @package App\Http\Resources
 *
 * @property Commit $resource
 */
class CommitResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'hash' => $this->resource->hash,
            'comment' => $this->resource->comment,
        ];
    }
}
