<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'companies';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
   
    protected $fillable = [
        'code',
        'name',
        'email',
        'phone',
        'website',
        'address',
        'province_code',
        'regency_code',
        'district_code',
        'village_code',
        'country',
        'logo',
        'favicon',
        'primary_color',
        'secondary_color',
        'subscription_type',
        'subscription_start',
        'subscription_end',
        'max_participants',
        'current_participants',
        'billing_name',
        'billing_email',
        'billing_address',
        'tax_id',
        'status',
        'is_verified',
    ];


    protected function casts(): array
    {
        return [
            'subscription_start' => 'datetime',
            'subscription_end' => 'datetime',
            'settings' => 'array',
            'test_configurations' => 'array',
        ];
    }

     // Relationships
     public function admins()
     {
         return $this->hasMany(CompanyAdmin::class);
     }
     
     public function primaryAdmin()
     {
         return $this->hasOne(CompanyAdmin::class)->where('is_primary', true);
     }
     
     public function participants()
     {
         return $this->hasMany(Participant::class);
     }
     
     public function subscriptions()
     {
         return $this->hasMany(CompanySubscription::class);
     }
     
     public function activeSubscription()
     {
         return $this->hasOne(CompanySubscription::class)
             ->where('status', 'active')
             ->where('end_date', '>', now());
     }
     
     public function testAttempts()
     {
         return $this->hasMany(TestAttempt::class);
     }
     
     public function transactions()
     {
         return $this->hasMany(Order::class);
     }
     
     // Scopes
     public function scopeActive($query)
     {
         return $query->where('status', 'active');
     }
     
     public function scopeVerified($query)
     {
         return $query->where('is_verified', true);
     }
     
     // Methods
     public function hasActiveSubscription()
     {
         return $this->activeSubscription()->exists();
     }
     
     public function getRemainingParticipantSlots()
     {
         return max(0, $this->max_participants - $this->current_participants);
     }
     
     public function isSubscriptionExpired()
     {
         return $this->subscription_end && $this->subscription_end->isPast();
     }
}
