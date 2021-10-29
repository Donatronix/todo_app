<?php

namespace App\Models;

use App\Models\Project\Project;
use App\Models\ToDo\ToDo;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Projects created by user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projects(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Project::class, 'user_id');
    }

    /**
     * To dos assigned to user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function toDosAssignedToMe(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ToDo::class, 'assigned_to_id');
    }
    /**
     * To dos assigned by user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function toDosAssignedByMe(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ToDo::class, 'assigned_by_id');
    }
}
