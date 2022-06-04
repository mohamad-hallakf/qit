<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subscription;
class Service_Subscription extends Model
{
    use HasFactory;
    protected $table="service_subscriptions";
    public function Subscriptions()
    {
        return $this->belongsTo(Subscription::class, 'subscriptionid');
    }
}
