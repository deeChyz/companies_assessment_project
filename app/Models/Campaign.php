<?php

namespace App\Models;

use App\Builders\CampaignBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    public const STATUS_ACTIVE = 'active';
    public const TYPE_RVM = 'rvm';

    use HasFactory;

    protected $fillable = [
        'name',
        'order',
        'type',
        'status',
        'start_date'
    ];

    protected $casts = [
        'start_date' => 'date',
        'order' => 'integer'
    ];

    public $timestamps = false;

    public function newEloquentBuilder($query): CampaignBuilder
    {
        return new CampaignBuilder($query);
    }
}
