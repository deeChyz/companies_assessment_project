<?php

use App\Http\Controllers\CampaignController;
use Illuminate\Support\Facades\Route;

Route::resource('campaigns', CampaignController::class)->only(['index', 'store', 'update']);
