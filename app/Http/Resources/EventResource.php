<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
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
            'subject' => $this->subject,
            'activity_category' => $this->activity_category,
            'children' => $this->children,
            'event_start_date' => $this->event_start_date,
            'event_end_date' => $this->event_end_date,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'datetime' => $this->datetime,
            'organizer' => $this->organizer,
            'file' => $this->file,
            'deadline' => $this->deadline,
            'venue' => $this->venue,
            'capacity' => $this->capacity,
            'target' => $this->target,
            'how_to_apply' => $this->how_to_apply,
            'cost' => $this->cost,
            'detail' => $this->detail,
            'url' => $this->url,
            'phone' => $this->phone,
            'deactivate'=>$this->deactivate,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by
        ];
    }
    public function with($request) {
        return [
            'version' => '1.0.0'
        ];
    }
}
