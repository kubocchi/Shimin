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
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'file' => $this->file,
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
