<?php

namespace App\Services;

use App\Models\Campaign;
use App\Builders\CampaignBuilder;
use App\Contracts\Services\CampaignServiceInterface;

class CampaignService implements CampaignServiceInterface {

    public static function filter(): CampaignBuilder
    {
        // Here some additional filter logic could be applied in case we need that
        return Campaign::query();
    }

    public function findActiveCampaigns()
    {
        return self::filter()->active()->highestOrderedNonRvm(10)->get();
    }

    public function create(array $data): Campaign
    {
        return Campaign::create($data);
    }

    public function update(Campaign $campaign, array $data): Campaign
    {
        $campaign->update($data);

        return $campaign;
    }
}
