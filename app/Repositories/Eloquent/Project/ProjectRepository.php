<?php

namespace App\Repositories\Eloquent\Project;

use App\Models\Project\Project;
use App\Models\User;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\Project\ProjectRepositoryInterface;
use App\Repositories\Contracts\ToDo\ToDoRepositoryInterface;
use Illuminate\Support\Facades\Auth;

/**
 *
 */
class ProjectRepository extends BaseRepository implements ProjectRepositoryInterface
{

    /**
     * @return string
     */
    public function model(): string
    {
        return Project::class;
    }
}
