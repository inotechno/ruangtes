<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Province extends Model
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'code';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'code',
        'name',
    ];

    public function regencies()
    {
        return $this->hasMany(Regency::class, 'province_code', 'code');
    }
}
