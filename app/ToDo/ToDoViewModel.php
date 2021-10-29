<?php

namespace App\ToDo;

use App\Models\ToDo\ToDo;
use App\Repositories\Contracts\Project\ProjectRepositoryInterface;
use App\Repositories\Contracts\User\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Spatie\ViewModels\ViewModel;

class ToDoViewModel extends ViewModel
{
    /**
     * @var \App\Repositories\Contracts\User\UserRepositoryInterface
     */
    private UserRepositoryInterface $users;

    /**
     * @var \App\Models\ToDo\ToDo
     */
    private ToDo $toDo;

    /**
     * @var \App\Repositories\Contracts\Project\ProjectRepositoryInterface
     */
    private ProjectRepositoryInterface $projects;

    /**
     * @param \App\Models\ToDo\ToDo                                          $toDo
     * @param \App\Repositories\Contracts\Project\ProjectRepositoryInterface $projects
     * @param \App\Repositories\Contracts\User\UserRepositoryInterface       $users
     */
    public function __construct(ToDo $toDo, ProjectRepositoryInterface $projects, UserRepositoryInterface $users)
    {
        $this->projects = $projects;
        $this->toDo = $toDo;
        $this->users = $users;
    }


    /**
     * @return \App\Models\ToDo\ToDo
     */
    public function todo(): ToDo
    {
        return $this->toDo;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Builder|array|null
     */
    public function todoAssignedBy(): Model|Collection|Builder|array|null
    {
        return $this->users->find($this->todo()->assigned_by_id);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Builder|array|null
     */
    public function todoAssignedTo(): Model|Collection|Builder|array|null
    {
        return $this->users->find($this->todo()->assigned_to_id);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Builder|array|null
     */
    public function project(): Model|Collection|Builder|array|null
    {
        return $this->projects->find($this->todo()->project_id);
    }
}
