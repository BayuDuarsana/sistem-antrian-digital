<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'queue_id',
        'staff_id',
        'called_at',
        'done_at',
        'duration_seconds',
    ];

    // Relasi ke Queue
    public function queue()
    {
        return $this->belongsTo(Queue::class);
    }

    // Relasi ke Staff
    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}
