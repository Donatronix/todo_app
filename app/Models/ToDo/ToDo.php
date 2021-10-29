<?php

namespace App\Models\ToDo;

use App\Models\Project\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToDo extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'description',
        'dueDate',
        'priority',
        'status',
        'completed',
        'assigned_by_id',
        'assigned_to_id',
        'project_id',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }




    /**
     * Todo assigned by user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function assignedByUser(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class,'assigned_by_Id','id');
    }

    /**
     * Todo assigned to user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function assignedToUser(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class,'assigned_to_Id','id');
    }

    /**
     * Project with todo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
