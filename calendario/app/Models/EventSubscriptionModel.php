<?php namespace App\Models;

use CodeIgniter\Model;

class EventSubscriptionModel extends Model
{
    protected $table = 'event_subscriptions';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'event_id', 'subscribed_at'];
    protected $useTimestamps = false;
}