<?php

namespace App\Providers;

use App\Contracts\Services\CampaignServiceInterface;
use App\Services\CampaignService;
use Illuminate\Support\ServiceProvider;

class CampaignServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->app->bind(
            CampaignServiceInterface::class,
            CampaignService::class
        );
    }
}
