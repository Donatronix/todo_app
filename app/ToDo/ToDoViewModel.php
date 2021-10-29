<?php

namespace App\ToDo;

use App\Models\Project\Project;
use App\Models\ToDo\ToDo;
use App\Models\User;
use App\Repositories\Contracts\Project\ProjectRepositoryInterface;
use App\Repositories\Contracts\User\UserRepositoryInterface;
use Spatie\ViewModels\ViewModel;

class ToDoViewModel extends ViewModel
{

    public mixed $title;
    public mixed $description;
    public $dueDate;
    public $priority;
    public $status;
    public $completedDate;
    public User $assignedBy;
    public User $assignedTo;
    public Project $project;

    /**
     * @var \App\Repositories\Contracts\User\UserRepositoryInterface
     */
    private UserRepositoryInterface $users;

    /**
     * @var \App\Models\ToDo\ToDo
     */
    public ToDo $toDo;

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


        $this->title = $toDo->title;
        $this->description = $toDo->description;
        $this->dueDate = $toDo->dueDate;
        $this->priority = $toDo->priority;
        $this->status = $toDo->status;
        $this->completedDate = $toDo->completedDate;
        $this->assignedBy = $this->users->find($toDo->assigned_by_id);
        $this->assignedTo = $this->users->find($toDo->assigned_to_id);
        $this->project = $this->projects->find($toDo->project_id);
    }



}
