<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TutoringRequest extends Model
{
    protected $fillable = [
        'course',
        'reason',
        'topics',
        'preferred_date',
        'preferred_time',
    ];

    protected function casts(): array
    {
        return [
            'topics' => 'array',
            'preferred_date' => 'date',
        ];
    }
}