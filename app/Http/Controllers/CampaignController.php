<?php

namespace App\Http\Controllers;

use App\Contracts\Services\CampaignServiceInterface;
use App\Http\Requests\StoreCampaignRequest;
use App\Http\Requests\UpdateCampaignRequest;
use App\Models\Campaign;

class CampaignController extends Controller
{
    public function __construct(private readonly CampaignServiceInterface $campaignService)
    {
    }

    public function index()
    {
        // You may consider move comment from 19 to 20 line to check the findActiveCampaigns method results as there is no other place where it's being used.
        // return $this->campaignService->findActiveCampaigns();
        return Campaign::query()->active()->get();
    }

    public function store(StoreCampaignRequest $request)
    {
        return $this->campaignService->create($request->validated());
    }

    public function update(UpdateCampaignRequest $request, Campaign $campaign)
    {
        return $this->campaignService->update($campaign, $request->validated());
    }
}
