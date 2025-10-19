<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                      => $this->id,
            'queue_id'                => $this->queue_id,
            'staff_id'                => $this->staff_id,
            'called_at'                => $this->called_at,
            'done_at'                 => $this->done_at,
            'duration_seconds'                => $this->duration_seconds,
        ];
    }
}
