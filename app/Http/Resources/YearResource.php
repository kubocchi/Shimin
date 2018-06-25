<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class YearResource extends JsonResource
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
            'year' => $this->year,
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
