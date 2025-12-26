<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class District extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'code',
        'name',
        'regency_code',
    ];

    public function regency()
    {
        return $this->belongsTo(Regency::class, 'regency_code', 'code');
    }

    public function villages()
    {
        return $this->hasMany(Village::class, 'district_code', 'code');
    }
}
