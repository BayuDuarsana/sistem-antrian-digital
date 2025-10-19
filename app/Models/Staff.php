<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'counter_number',
        'is_active',
    ];

    public function queues()
    {
        return $this->hasMany(Queue::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
