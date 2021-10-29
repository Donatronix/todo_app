<?php

namespace App\Repositories\Eloquent\User;

use App\Models\User;
use App\Repositories\Contracts\Challenger\ChallengerRepositoryInterface;
use App\Repositories\Contracts\HealthAid\HealthAidRepositoryInterface;
use App\Repositories\Contracts\Newsletter\NewsletterSubscriptionRepositoryInterface;
use App\Repositories\Contracts\Newsletter\SpecialOffersSubscriptionRepositoryInterface;
use App\Repositories\Contracts\PharmaFund\PharmaFundRepositoryInterface;
use App\Repositories\Contracts\PharmaLearn\PharmaLearnRepositoryInterface;
use App\Repositories\Contracts\PharmaSource\ProductRepositoryInterface;
use App\Repositories\Contracts\User\RoleRepositoryInterface;
use App\Repositories\Contracts\User\UserLoginRepositoryInterface;
use App\Repositories\Contracts\User\UserRepositoryInterface;
use App\Repositories\Eloquent\BaseRepository;
use App\Services\Chart\ChartService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;
use JetBrains\PhpStorm\ArrayShape;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

/**
 * Class UserRepository
 *
 * @package \App\Repositories\Eloquent\User
 */
class UserRepository extends BaseRepository implements UserRepositoryInterface
{

    /**
     * @return string
     */
    public function model(): string
    {
        return User::class;
    }
}
