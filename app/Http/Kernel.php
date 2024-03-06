<?php

namespace App\Http;

use App\Http\Middleware\RoutingMiddleware;
use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Fruitcake\Cors\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'routingmiddleware'=>RoutingMiddleware::class,

        // check user's roles and department )routes)
        'ceo'           =>  \App\Http\Middleware\Ceo::class,
        'admin'         =>  \App\Http\Middleware\Admin::class,

        // sales middleware
        'bde_teamlead'  =>  \App\Http\Middleware\BusinessDevelopmentExecutiveTeamLead::class,
        'bde_intern'    =>  \App\Http\Middleware\BusinessDevelopmentExecutiveIntern::class,
        'bde'           =>  \App\Http\Middleware\BusinessDevelopmentExecutive::class,
        'bdm_teamlead'  =>  \App\Http\Middleware\BusinessDevelopmentManagementTeamLead::class,
        
        //tranning middleware
        'class_trainer'     =>  \App\Http\Middleware\ClassTranner::class,
        'demo_manager'      =>  \App\Http\Middleware\DemoManager::class,
        'demo_trainer'      =>  \App\Http\Middleware\DemoTranner::class,
        'quality_analiyst'  =>  \App\Http\Middleware\QualityAnaliyst::class,

        // student middleware 
        'lead'           =>  \App\Http\Middleware\Student::class,
        'scholarship'    =>  \App\Http\Middleware\ScholarshipUser::class,

        // content writter middleware 
        'junior_content' =>  \App\Http\Middleware\JuniorContent::class,
        'senior_content' =>  \App\Http\Middleware\SeniorContent::class,

        // junior senior roles for common routes
        'senior'         =>   \App\Http\Middleware\SeniorRole::class,
        'junior'         =>   \App\Http\Middleware\JuniorRole::class,
        'trainer'        =>   \App\Http\Middleware\TrainningPanel::class,

        // class trainer and qa panel 
        'classpanel'        =>   \App\Http\Middleware\ClassTrainerAndQA::class,
    ];
}
