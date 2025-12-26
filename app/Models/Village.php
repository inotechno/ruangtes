<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Village extends Model
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'code';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'code',
        'name',
        'district_code',
    ];

    public function district()
    {
        return $this->belongsTo(District::class, 'district_code', 'code');
    }
}
