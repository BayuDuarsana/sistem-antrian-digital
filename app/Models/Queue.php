<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Queue extends Model
{
    use HasFactory;

    protected $fillable = [
        'queue_number',
        'type',
        'status',
        'staff_id',
        'called_at',
        'done_at',
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function service()
    {
        return $this->hasOne(Service::class);
    }
}
