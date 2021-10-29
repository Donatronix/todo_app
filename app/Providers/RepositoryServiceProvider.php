<?php

namespace App\Providers;

use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Eloquent\Project\ProjectRepository;
use App\Repositories\Eloquent\ToDo\ToDoRepository;
use App\Repositories\Eloquent\User\UserRepository;
use App\Repositories\Contracts\BaseRepositoryInterface;
use App\Repositories\Contracts\Project\ProjectRepositoryInterface;
use App\Repositories\Contracts\ToDo\ToDoRepositoryInterface;
use App\Repositories\Contracts\User\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

/**
 * Class RepositoryServiceProvider
 *
 * @package App\Providers
 */
class RepositoryServiceProvider extends ServiceProvider
{

    protected array $repositories = [
        BaseRepositoryInterface::class => BaseRepository::class,
        ToDoRepositoryInterface::class => ToDoRepository::class,
        ProjectRepositoryInterface::class => ProjectRepository::class,
        UserRepositoryInterface::class => UserRepository::class,
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
