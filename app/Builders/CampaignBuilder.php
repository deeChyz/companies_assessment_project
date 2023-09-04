<?php

namespace App\Builders;

use Carbon\Carbon;
use App\Models\Campaign;
use Illuminate\Database\Eloquent\Builder;

class CampaignBuilder extends Builder
{
    public function requestStartDate($campaignId): Carbon
    {
        // Here we can apply some additional logic in case we need it

        // For the default value I decided to use now() just for testing purposes, it could be otherwise brought from
        // either different source or avoided. As name of the functions is requestStartDate start date, I guessed that
        // it must return date regardless of whether campaign was found or not even tho in our case, company will be in
        // the db. I also decided to use a calculation here and brought operation of adding 30 days to the date just to
        // make this function change the actual date value to make the command results more declarative.

        $campaign = $this->find($campaignId);

        if ($campaign) {
            return optional($campaign->start_date)->subDays(30);
        }

        return now();
    }

    /**
     * This method is more atomaric version of custom builder method that brings only one condition to the query
     *
     * @return self
     */
    public function active(): self
    {
        return $this->where('status', Campaign::STATUS_ACTIVE);
    }

    /**
     * This method is more complex version of custom builder method that brings couple conditions that are supposed
     * to be used in couple, so we are not expecting them to be decoupled. This approach basically shows the variety of
     * different options presented by custom query building and scope operations
     *
     * @param int $count
     * @return self
     */
    public function highestOrderedNonRvm(int $count): self
    {
        return $this
            ->whereNot('type', Campaign::TYPE_RVM)
            ->orderByDesc('order')
            ->take($count);
    }
}
