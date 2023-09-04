<?php

namespace App\Console\Commands;

use App\Models\Campaign;
use App\Services\CampaignService;
use Illuminate\Console\Command;

class UpdateCampaignStartDates extends Command
{
    protected $signature = 'campaigns:update-start-dates';
    protected $description = 'Update start dates for campaigns';

    public function handle()
    {
        $chunkSize = (int) $this->ask('What is the preferable chunk size?', 500);

        $countChunksUpdates = 0;

        Campaign::chunk($chunkSize, function ($campaigns) use (&$countChunksUpdates, $chunkSize) {
            foreach ($campaigns as $campaign) {
                $startDate = CampaignService::filter()->requestStartDate($campaign->id);
                $campaign->update(['start_date' => $startDate]);
            }

            $this->info(++$countChunksUpdates * $chunkSize . " companies updated");
        });

        $this->info('Start dates updated for campaigns.');
    }
}
