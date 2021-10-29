<?php

namespace App\Repositories\Eloquent\ToDo;

use App\Models\ToDo\ToDo;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\ToDo\ToDoRepositoryInterface;

/**
 *
 */
class ToDoRepository extends BaseRepository implements ToDoRepositoryInterface
{
    /**
     * @return string
     */
    public function model(): string
    {
        return ToDo::class;
    }
}
