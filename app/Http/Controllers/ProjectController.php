<?php

namespace App\Http\Controllers;

use App\Http\Requests\Project\ProjectRequest;
use App\Models\Project\Project;
use App\Repositories\Contracts\Project\ProjectRepositoryInterface;
use App\Repositories\Contracts\User\UserRepositoryInterface;
use App\ToDo\ToDoViewModel;
use App\Traits\ControllerTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Throwable;

class ProjectController extends Controller
{
    use ControllerTrait;

    /**
     * @var \App\Repositories\Contracts\Project\ProjectRepositoryInterface
     */
    protected ProjectRepositoryInterface $projects;

    /**
     * @var \App\Repositories\Contracts\User\UserRepositoryInterface
     */
    private UserRepositoryInterface $users;

    public function __construct(ProjectRepositoryInterface $projects,UserRepositoryInterface $users)
    {
        $this->projects = $projects;
        $this->users = $users;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(): View|Factory|Application
    {
        return view('project.index', ['projects' => $this->projects->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(): View|Factory|Application
    {
        return view('project.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Project\ProjectRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProjectRequest $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $this->projects->create($request->validated());
        } catch (Throwable $th) {
            DB::rollback();
            return $this->responseRedirectBack("There was an error creating the project!<br/>" . $th->getMessage(), 'success');
        }
        DB::commit();
        return $this->responseRedirect('projects.index', "Project was created successfully!", 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project\Project  $project
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Project $project): View|Factory|Application
    {
        $toDos=$project->toDos->map(function ($toDo, $key) {
            return new ToDoViewModel($toDo, $this->projects, $this->users);
        });
        return view('project.show', ['project' => $project,'toDos' => $toDos]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project\Project  $project
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Project $project): View|Factory|Application
    {
        return view('project.edit', ['project' => $project]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Project\ProjectRequest $request
     * @param \App\Models\Project\Project               $project
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProjectRequest $request, Project $project): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $this->projects->update($project, $request->validated());
        } catch (Throwable $th) {
            DB::rollback();
            return $this->responseRedirectBack("There was an error updating the project item!<br/>" . $th->getMessage(), 'error', true, true);
        }
        DB::commit();
        return $this->responseRedirect('project.index', "project was updated successfully!", 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project\Project  $project
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Project $project): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $this->projects->delete($project);
        } catch (Throwable $th) {
            DB::rollback();
            return $this->responseRedirectBack("There was an error deleting the project item.<br/>" . $th->getMessage(), 'success');
        }
        DB::commit();
        return $this->responseRedirect('projects.index', "Project was deleted successfully!", 'success');
    }
}
