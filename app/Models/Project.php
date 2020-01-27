<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class Project
 *
 * @package App\Models
 *
 * @method static Builder|Project success()
 *
 * @property int $id
 * @property string $owner
 * @property string $repo
 * @property int $status
 */
class Project extends Model
{
    const STATUS_NEW = 0;
    const STATUS_PENDING = 1;
    const STATUS_SUCCESS = 2;
    const STATUS_FAIL = 3;

    protected $fillable = [
        'owner',
        'repo',
    ];

    /**
     * @return HasMany
     */
    public function commits(): HasMany
    {
        return $this->hasMany(Commit::class)->select(['id', 'hash', 'comment']);
    }

    /**
     * @param Builder $builder
     */
    public function scopeSuccess(Builder $builder)
    {
        $builder->where('status', self::STATUS_SUCCESS);
    }
}
