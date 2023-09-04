<?php

declare(strict_types=1);

namespace App\Contracts\Services;

use App\Builders\CampaignBuilder;
use App\Models\Campaign;

interface CampaignServiceInterface
{
    public static function filter(): CampaignBuilder;

    public function findActiveCampaigns();

    public function create(array $data): Campaign;

    public function update(Campaign $campaign, array $data): Campaign;
}
