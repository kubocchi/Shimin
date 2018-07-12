<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GroupInformationResource extends JsonResource
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
            'number' => $this->number,
            'type' => $this->type,
            'regist_management' => $this->regist_management,
            'open_situation' => $this->open_situation,
            'active_status' => $this->active_status,
            'pause_date' => $this->pause_date,
            'application_date' => $this->application_date,
            'registration_date' => $this->registration_date,
            'establishment_date' => $this->establishment_date,
            'name' => $this->name,
            'name_phonetic' => $this->name_phonetic,
            'representative_name' => $this->representative_name,
            'representative_name_phonetic' => $this->representative_name_phonetic,
            'disclosure_name' => $this->disclosure_name,
            'representative_phone' => $this->representative_phone,
            'disclosure_representative_phone' => $this->disclosure_representative_phone,
            'representative_phone_2' => $this->representative_phone_2,
            'disclosure_representative_phone_2' => $this->disclosure_representative_phone_2,
            'representative_fax' => $this->representative_fax,
            'disclosure_representative_fax' => $this->disclosure_representative_fax,
            'contact_name' => $this->contact_name,
            'contact_name_phonetic' => $this->contact_name_phonetic,
            'disclosure_contact_name' => $this->disclosure_contact_name,
            'postal_code' => $this->postal_code,
            'contact_address' => $this->contact_address,
            'contact_address_name' => $this->contact_address_name,
            'contact_address_title' => $this->contact_address_title,
            'disclosure_contact_address' => $this->disclosure_contact_address,
            'contact_phone' => $this->contact_phone,
            'disclosure_contact_phone' => $this->disclosure_contact_phone,
            'contact_phone_2' => $this->contact_phone_2,
            'disclosure_contact_phone_2' => $this->disclosure_contact_phone_2,
            'contact_fax' => $this->contact_fax,
            'disclosure_contact_fax' => $this->disclosure_contact_fax,
            'contact_mail' => $this->contact_mail,
            'disclosure_contact_mail' => $this->disclosure_contact_mail,
            'contact_url' => $this->contact_url,
            'disclosure_contact_url' => $this->disclosure_contact_url,
            'activity_category' => $this->activity_category,
            'active_category_supplement' => $this->active_category_supplement,
            'membership_male' => $this->membership_male,
            'membership_female' => $this->membership_female,
            'all_member' => $this->all_member,
            'activity_frequency' => $this->activity_frequency,
            'activity_day' => $this->activity_day,
            'dues' => $this->dues,
            'dues_price' => $this->dues_price,
            'content' => $this->content,
            'rocker' => $this->rocker,
            'mail_box' => $this->mail_box,
            'method' => $this->method,
            'supplement' => $this->supplement,
            'file' => $this->file,
            'deactivate' => $this->deactivate,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ];
    }
    public function with($request) {
        return [
            'version' => '1.0.0'
        ];
    }
}
