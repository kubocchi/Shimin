<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VolunteerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'subject' => $this->subject,
            'activity_category' => $this->activity_category,
            'children' => $this->children,
            'event_start_date' => $this->event_start_date,
            'event_end_date' => $this->event_end_date,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'sponsor' => $this->sponsor,
            'file' => $this->file,
            'activity_date' => $this->activity_date,
            'deadline' => $this->deadline,
            'activity_location' => $this->activity_location,
            'number_of_people' => $this->number_of_people,
            'orientation' => $this->orientation,
            'cost' => $this->cost,
            'subscription' => $this->subscription,
            'content' => $this->content,
            'linkname' => $this->linkname,
            'contact' => $this->contact,
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
