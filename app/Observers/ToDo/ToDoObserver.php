<?php

namespace App\Observers\ToDo;

use App\Models\ToDo\ToDo;
use Illuminate\Support\Str;

class ToDoObserver
{
    /**
     * Handle the ToDo "created" event.
     *
     * @param  \App\Models\ToDo\ToDo  $toDo
     * @return void
     */
    public function created(ToDo $toDo)
    {
        //
    }
    /**
     * Handle the ToDo "created" event.
     *
     * @param  \App\Models\ToDo\ToDo  $toDo
     * @return void
     */
    public function creating(ToDo $toDo)
    {
        $toDo->slug = Str::slug($toDo->title);
    }

    /**
     * Handle the ToDo "updated" event.
     *
     * @param  \App\Models\ToDo\ToDo  $toDo
     * @return void
     */
    public function updated(ToDo $toDo)
    {
        //
    }

    /**
     * Handle the ToDo "updating" event.
     *
     * @param  \App\Models\ToDo\ToDo  $toDo
     * @return void
     */
    public function updating(ToDo $toDo)
    {
        $toDo->slug = Str::slug($toDo->title);
    }

    /**
     * Handle the ToDo "deleted" event.
     *
     * @param  \App\Models\ToDo\ToDo  $toDo
     * @return void
     */
    public function deleted(ToDo $toDo)
    {
        //
    }

    /**
     * Handle the ToDo "restored" event.
     *
     * @param  \App\Models\ToDo\ToDo  $toDo
     * @return void
     */
    public function restored(ToDo $toDo)
    {
        //
    }

    /**
     * Handle the ToDo "force deleted" event.
     *
     * @param  \App\Models\ToDo\ToDo  $toDo
     * @return void
     */
    public function forceDeleted(ToDo $toDo)
    {
        //
    }
}
