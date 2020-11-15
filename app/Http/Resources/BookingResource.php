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
            'room' => $this->room->title,
            'user' => $this->user->name,
            'start' => $this->start->format(config('app.timeformat')),
            'end' => $this->end->format(config('app.timeformat'))
        ];
    }
}
