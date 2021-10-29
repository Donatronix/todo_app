<?php

namespace App\Providers;

use App\Models\ToDo\ToDo;
use App\Models\Project\Project;
use App\Observers\ToDo\ToDoObserver;
use App\Observers\Project\ProjectObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //Register model observers
        $this->registerObservers();
    }

    public function registerObservers()
    {
        ToDo::observe(ToDoObserver::class);
        Project::observe(ProjectObserver::class);
    }
}
