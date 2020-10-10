<?php

namespace App\Repositories;

use Illuminate\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(
        'App\Repositories\SubjectRepositoryInterface',
        'App\Repositories\SubjectRepository'
    );
        $this->app->bind(
            'App\Repositories\StudentClassesRepositoryInterface',
            'App\Repositories\StudentClassesRepository'
        );


}

}