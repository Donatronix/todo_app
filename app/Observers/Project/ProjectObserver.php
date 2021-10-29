<?php

namespace App\Observers\Project;

use App\Models\Project\Project;
use Illuminate\Support\Str;

class ProjectObserver
{
    /**
     * Handle the Project "created" event.
     *
     * @param  \App\Models\Project\Project  $project
     * @return void
     */
    public function created(Project $project)
    {
        //
    }

    /**
     * Handle the Project "creating" event.
     *
     * @param  \App\Models\Project\Project  $project
     * @return void
     */
    public function creating(Project $project)
    {
        $project->slug = Str::Slug($project->title);
    }

    /**
     * Handle the Project "updated" event.
     *
     * @param  \App\Models\Project\Project  $project
     * @return void
     */
    public function updated(Project $project)
    {
        //
    }

    /**
     * Handle the Project "deleted" event.
     *
     * @param  \App\Models\Project\Project  $project
     * @return void
     */
    public function deleted(Project $project)
    {
        //
    }

    /**
     * Handle the Project "restored" event.
     *
     * @param  \App\Models\Project\Project  $project
     * @return void
     */
    public function restored(Project $project)
    {
        //
    }

    /**
     * Handle the Project "force deleted" event.
     *
     * @param  \App\Models\Project\Project  $project
     * @return void
     */
    public function forceDeleted(Project $project)
    {
        //
    }
}
