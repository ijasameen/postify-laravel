<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\Reply;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        DB::prohibitDestructiveCommands(
            app()->isProduction(),
        );

        Model::preventLazyLoading(! app()->isProduction());
        Model::unguard();
        Model::shouldBeStrict();

        Relation::enforceMorphMap([
            Post::getClassKey() => Post::class,
            Reply::getClassKey() => Reply::class,
        ]);

        Password::defaults(function () {
            return app()->isProduction()
                ? Password::min(8)
                    ->max(255)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()
                : Password::min(3);
        });

        Date::use(CarbonImmutable::class);
    }
}
