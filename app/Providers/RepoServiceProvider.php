<?php

namespace App\Providers;

use App\Repositories\Admin\AdminAuthRepository;
use App\Repositories\Admin\AdminAuthRepositoryInterface;
use App\Repositories\Admin\AdminRepository;
use App\Repositories\Admin\AdminRepositoryInterface;
use App\Repositories\Admin\CountryRepository;
use App\Repositories\Admin\CountryRepositoryInterface;
use App\Repositories\Admin\CityRepository;
use App\Repositories\Admin\CityRepositoryInterface;
use App\Repositories\Admin\ColorRepository;
use App\Repositories\Admin\ColorRepositoryInterface;
use App\Repositories\Admin\StateRepository;
use App\Repositories\Admin\StateRepositoryInterface;
use App\Repositories\Admin\UserRepository;
use App\Repositories\Admin\UserRepositoryInterface;
use App\Repositories\Admin\DepartmentRepository;
use App\Repositories\Admin\DepartmentRepositoryInterface;
use App\Repositories\Admin\MallRepository;
use App\Repositories\Admin\MallRepositoryInterface;
use App\Repositories\Admin\ManufactRepository;
use App\Repositories\Admin\ManufactRepositoryInterface;
use App\Repositories\Admin\ProductRepository;
use App\Repositories\Admin\ProductRepositoryInterface;
use App\Repositories\Admin\ShippingRepository;
use App\Repositories\Admin\ShippingRepositoryInterface;
use App\Repositories\Admin\SizeRepository;
use App\Repositories\Admin\SizeRepositoryInterface;
use App\Repositories\Admin\TrademarRepository;
use App\Repositories\Admin\TrademarRepositoryInterface;
use App\Repositories\Admin\WeightRepository;
use App\Repositories\Admin\WeightRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AdminAuthRepositoryInterface::class, AdminAuthRepository::class);
        $this->app->bind(AdminRepositoryInterface::class, AdminRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(CountryRepositoryInterface::class, CountryRepository::class);
        $this->app->bind(CityRepositoryInterface::class, CityRepository::class);
        $this->app->bind(StateRepositoryInterface::class, StateRepository::class);
        $this->app->bind(DepartmentRepositoryInterface::class, DepartmentRepository::class);
        $this->app->bind(TrademarRepositoryInterface::class, TrademarRepository::class);
        $this->app->bind(ManufactRepositoryInterface::class, ManufactRepository::class);
        $this->app->bind(ShippingRepositoryInterface::class, ShippingRepository::class);
        $this->app->bind(MallRepositoryInterface::class, MallRepository::class);
        $this->app->bind(ColorRepositoryInterface::class, ColorRepository::class);
        $this->app->bind(SizeRepositoryInterface::class, SizeRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(WeightRepositoryInterface::class, WeightRepository::class);
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
