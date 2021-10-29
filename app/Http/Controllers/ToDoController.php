<?php

namespace App\Http\Controllers;

use App\Http\Requests\ToDo\ToDoRequest;
use App\Models\ToDo\ToDo;
use App\Repositories\Interface\Project\ProjectRepositoryInterface;
use App\Repositories\Interface\ToDo\ToDoRepositoryInterface;
use App\Repositories\Interface\User\UserRepositoryInterface;
use App\Traits\ControllerTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ToDoController extends Controller
{
    use ControllerTrait;

    protected ToDoRepositoryInterface $todos;

    protected ProjectRepositoryInterface $projects;

    protected UserRepositoryInterface $users;

    public function __construct(ToDoRepositoryInterface $todos, ProjectRepositoryInterface $projects, UserRepositoryInterface $users)
    {
        $this->todos = $todos;
        $this->projects = $projects;
        $this->users = $users;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index', ['todos' => $this->todos->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todo.create', [
            'projects' => $this->projects->orderBy('title', 'asc')->all(),
            'users' => $this->users->all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ToDoRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->todos->create($request->validated());
        } catch (\Throwable $th) {
            DB::rollback();
            return $this->responseRedirectBack("ToDo was updated successfully!", 'success');
        }
        DB::commit();
        return $this->responseRedirect(route('todo.index'), "ToDo was updated successfully!", 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ToDo\ToDo  $toDo
     * @return \Illuminate\Http\Response
     */
    public function show(ToDo $toDo)
    {
        return view('todo.show', ['todo' => $toDo]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ToDo\ToDo  $toDo
     * @return \Illuminate\Http\Response
     */
    public function edit(ToDo $toDo)
    {
        return view('todo.edit', [
            'todo' => $toDo,
            'projects' => $this->projects->orderBy('title', 'asc')->all(),
            'users' => $this->users->all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ToDo\ToDo  $toDo
     * @return \Illuminate\Http\Response
     */
    public function update(ToDoRequest $request, ToDo $toDo)
    {
        DB::beginTransaction();
        try {
            $this->todos->update($toDo, $request->all());
        } catch (\Throwable $th) {
            DB::rollback();
            return $this->responseRedirectBack("There was an error updating the todo item!<br/>" . $th->getMessage(), 'error', true, true);
        }
        DB::commit();
        return $this->responseRedirect(route('todo.index'), "ToDo was updated successfully!", 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ToDo\ToDo  $toDo
     * @return \Illuminate\Http\Response
     */
    public function destroy(ToDo $toDo)
    {
        DB::beginTransaction();
        try {
            $this->todos->delete($toDo);
        } catch (\Throwable $th) {
            DB::rollback();
            return $this->responseRedirectBack("There was an error deleting the  todo item.<br/>" . $th->getMessage(), 'success');
        }
        DB::commit();
        return $this->responseRedirect(route('todo.index'), "ToDo was updated successfully!", 'success');
    }
}
