<?php

namespace App\Providers;

use App\Repositories\Eloquent\Project\ProjectRepository;
use App\Repositories\Eloquent\ToDo\ToDoRepository;
use App\Repositories\Interface\Project\ProjectRepositoryInterface;
use App\Repositories\Interface\ToDo\ToDoRepositoryInterface;
use Illuminate\Support\ServiceProvider;

/**
 * Class RepositoryServiceProvider
 *
 * @package App\Providers
 */
class RepositoryServiceProvider extends ServiceProvider
{

    protected array $repositories = [
        ToDoRepositoryInterface::class => ToDoRepository::class,
        ProjectRepositoryInterface::class => ProjectRepository::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->repositories as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
