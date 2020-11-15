<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'room' => $this->room->title,
            'user' => $this->user->name,
            'date' => $this->start->format(config('app.dateformat')),
            'time' => $this->start->format(config('app.timeformat')) . ' - ' . $this->end->format(config('app.timeformat')),
            'js_date' => $this->start->format('Y-m-d'),
            'js_time' => $this->start->format('G:i'),
            'duration' => $this->start->copy()->diffInMinutes($this->end),
            'room_id' => $this->room_id
        ];
    }
}
