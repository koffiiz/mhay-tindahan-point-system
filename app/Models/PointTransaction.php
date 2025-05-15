<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PointTransaction extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'points',
        'description',
    ];

    protected $casts = [
        'points' => 'float',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
