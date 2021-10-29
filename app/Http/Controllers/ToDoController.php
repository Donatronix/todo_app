<?php

namespace App\Http\Controllers;

use App\Http\Requests\ToDo\ToDoRequest;
use App\Models\ToDo\ToDo;
use App\Repositories\Contracts\Project\ProjectRepositoryInterface;
use App\Repositories\Contracts\ToDo\ToDoRepositoryInterface;
use App\Repositories\Contracts\User\UserRepositoryInterface;
use App\ToDo\ToDoViewModel;
use App\Traits\ControllerTrait;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class ToDoController extends Controller
{
    use ControllerTrait;

    protected ToDoRepositoryInterface $toDos;

    protected ProjectRepositoryInterface $projects;

    protected UserRepositoryInterface $users;

    public function __construct(ProjectRepositoryInterface $projects, ToDoRepositoryInterface $toDos, UserRepositoryInterface $users)
    {
        $this->toDos = $toDos;
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
        $toDos = $this->toDos->all()->map(function ($toDo, $key) {
            return new ToDoViewModel($toDo, $this->projects, $this->users);
        });
        return view('todo.index', ['toDos' => $toDos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create(): View|Factory|Response|Application
    {
        return view('todo.create', [
            'projects' => $this->projects->all(),
            'users' => $this->users->where('id', Auth::user()->id, '<>')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\ToDo\ToDoRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ToDoRequest $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $this->toDos->create($request->validated());
        } catch (Throwable $th) {
            DB::rollback();
            return $this->responseRedirectBack("There was an error creating the todo item!<br/>" . $th->getMessage(), 'error', true, true);
        }
        DB::commit();
        return $this->responseRedirect('toDos.index', "ToDo was created successfully!", 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\ToDo\ToDo $toDo
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(ToDo $toDo): View|Factory|Application
    {
        return view('todo.show', ['toDo' => new ToDoViewModel($toDo, $this->projects, $this->users)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\ToDo\ToDo $toDo
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(ToDo $toDo): View|Factory|Application
    {
        return view('todo.edit', [
            'toDo' => new ToDoViewModel($toDo, $this->projects, $this->users),
            'projects' => $this->projects->orderBy('title', 'asc')->all(),
            'users' => $this->users->all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\ToDo\ToDoRequest $request
     * @param \App\Models\ToDo\ToDo               $toDo
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ToDoRequest $request, ToDo $toDo): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $this->toDos->update($toDo, $request->validated());
        } catch (Throwable $th) {
            DB::rollback();
            return $this->responseRedirectBack("There was an error updating the todo item!<br/>" . $th->getMessage(), 'error', true, true);
        }
        DB::commit();
        return $this->responseRedirect('toDos.index', "ToDo was updated successfully!", 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\ToDo\ToDo $toDo
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(ToDo $toDo): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $this->toDos->delete($toDo);
        } catch (Throwable $th) {
            DB::rollback();
            return $this->responseRedirectBack("There was an error deleting the  todo item.<br/>" . $th->getMessage(), 'success');
        }
        DB::commit();
        return $this->responseRedirect('toDos.index', "ToDo was deleted successfully!", 'success');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Models\ToDo\ToDo $toDo
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function completed(ToDo $toDo): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $this->toDos->update($toDo, [
                'completedDate' => Carbon::now(),
                'status' => 'completed',
            ]);
        } catch (Throwable $th) {
            DB::rollback();
            return $this->responseRedirectBack("There was an error updating the todo item!<br/>" . $th->getMessage(), 'error', true, true);
        }
        DB::commit();
        return $this->responseRedirect('toDos.index', "ToDo was updated successfully!", 'success');
    }
}
