<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Commit
 *
 * @package App\Models
 *
 * @property int $id
 * @property string $hash
 * @property string $comment
 */
class Commit extends Model
{
    protected $fillable = [
        'hash',
        'comment',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class)
            ->select(['id', 'owner', 'repo']);
    }
}
