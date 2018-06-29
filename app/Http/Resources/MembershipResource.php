<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MembershipResource extends JsonResource
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
            'organizer' => $this->organizer,
            'activity_category' => $this->activity_category,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'file' => $this->file,
            'is_payment' => $this->is_payment,
            'content' => $this->content,
            'amount' => $this->amount,
            'payment_type' => $this->payment_type,
            'linkname' => $this->linkname,
            'contact' => $this->contact,
            'deactivate' => $this->deactivate,
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
