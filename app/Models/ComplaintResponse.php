<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $complaint_id
 * @property int $user_id
 * @property string $response
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Complaint $complaint
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ComplaintResponse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ComplaintResponse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ComplaintResponse query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ComplaintResponse whereComplaintId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ComplaintResponse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ComplaintResponse whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ComplaintResponse whereResponse($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ComplaintResponse whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ComplaintResponse whereUserId($value)
 * @mixin \Eloquent
 */
class ComplaintResponse extends Model
{
    protected $fillable = [
        'complaint_id',
        'user_id',
        'response',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the complaint that owns the response.
     */
    public function complaint(): BelongsTo
    {
        return $this->belongsTo(Complaint::class);
    }

    /**
     * Get the user that owns the response.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
