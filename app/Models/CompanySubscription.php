<?php

namespace App\Models;

use App\Enums\CompanySubscriptionStatus;
use App\Models\SubscriptionPlan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanySubscription extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'company_id',
        'plan_id',
        'subscription_number',
        'status' => CompanySubscriptionStatus::PENDING,
        'start_date',
        'end_date',
        'trial_ends_at',
        'total_users',
        'used_users',
        'additional_users',
        'base_amount',
        'additional_amount',
        'tax_amount',
        'total_amount',
        'amount_paid',
        'amount_due',
        'payment_method',
        'payment_reference',
        'paid_at',
        'invoice_url',
        'auto_renew',
        'renewal_token',
        'features',
        'customizations',
        'notes',
        'cancelled_at',
        'cancellation_reason',
        'cancelled_by',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'trial_ends_at' => 'datetime',
        'features' => 'array',
        'customizations' => 'array',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function plan()
    {
        return $this->belongsTo(SubscriptionPlan::class);
    }
}
