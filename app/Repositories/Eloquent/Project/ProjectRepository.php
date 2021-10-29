<?php

namespace App\Repositories\Eloquent\Project;

use App\Models\Project\Project;
use App\Models\User;
use App\Repositories\Interface\Project\ToDoRepositoryInterface;

use Illuminate\Support\Facades\Auth;

/**
 *
 */
class ProjectRepository extends BaseRepository implements ProjectRepositoryInterface
{

    private ToDoRepositoryInterface $todos;
    private User $user;

    public function __construct(
        ToDoRepositoryInterface $todos,
    ) {
        $this->user = Auth::user();
        $this->todos = $todos;
    }

    /**
     * @return string
     */
    public function model(): string
    {
        return Project::class;
    }
}
