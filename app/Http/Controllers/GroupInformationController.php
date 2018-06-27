<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GroupInformation;
use App\Http\Resources\GroupInformationResource;
class GroupInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get GroupInformations
        $groupInformations = GroupInformation::orderBy('created_at', 'desc')->Where('deactivate', 0)->paginate(10);

        // Return collection of GroupInformations as a resource
        return GroupInformationResource::collection($groupInformations);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $groupInformation = $request->isMethod('put') ? GroupInformation::findOrFail($request->id) : new GroupInformation;

        $groupInformation->number= $request->input('number');
        $groupInformation->type= $request->input('type');
        $groupInformation->regist_management= $request->input('regist_management');
        $groupInformation->open_situation= $request->input('open_situation');
        $groupInformation->active_status= $request->input('active_status');
        $groupInformation->pause_date= $request->input('pause_date');
        $groupInformation->application_date= $request->input('application_date');
        $groupInformation->registration_date= $request->input('registration_date');
        $groupInformation->establishment_date= $request->input('establishment_date');
        $groupInformation->name= $request->input('name');
        $groupInformation->name_phonetic= $request->input('name_phonetic');
        $groupInformation->representative_name= $request->input('representative_name');
        $groupInformation->representative_name_phonetic= $request->input('representative_name_phonetic');
        $groupInformation->disclosure_name= $request->input('disclosure_name');
        $groupInformation->representative_phone= $request->input('representative_phone');
        $groupInformation->disclosure_representative_phone= $request->input('disclosure_representative_phone');
        $groupInformation->representative_phone_2= $request->input('representative_phone_2');
        $groupInformation->disclosure_representative_phone_2= $request->input('disclosure_representative_phone_2');
        $groupInformation->representative_fax= $request->input('representative_fax');
        $groupInformation->disclosure_representative_fax= $request->input('disclosure_representative_fax');
        $groupInformation->contact_name= $request->input('contact_name');
        $groupInformation->contact_name_phonetic= $request->input('contact_name_phonetic');
        $groupInformation->disclosure_contact_name= $request->input('disclosure_contact_name');
        $groupInformation->postal_code= $request->input('postal_code');
        $groupInformation->contact_address= $request->input('contact_address');
        $groupInformation->contact_address_name= $request->input('contact_address_name');
        $groupInformation->contact_address_title= $request->input('contact_address_title');
        $groupInformation->disclosure_contact_address= $request->input('disclosure_contact_address');
        $groupInformation->contact_phone= $request->input('contact_phone');
        $groupInformation->disclosure_contact_phone= $request->input('disclosure_contact_phone');
        $groupInformation->contact_phone_2= $request->input('contact_phone_2');
        $groupInformation->disclosure_contact_phone_2= $request->input('disclosure_contact_phone_2');
        $groupInformation->contact_fax= $request->input('contact_fax');
        $groupInformation->disclosure_contact_fax= $request->input('disclosure_contact_fax');
        $groupInformation->contact_mail= $request->input('contact_mail');
        $groupInformation->disclosure_contact_mail= $request->input('disclosure_contact_mail');
        $groupInformation->contact_url= $request->input('contact_url');
        $groupInformation->disclosure_contact_url= $request->input('disclosure_contact_url');
        $groupInformation->activity_category= $request->input('activity_category');
        $groupInformation->active_category_supplement= $request->input('active_category_supplement');
        $groupInformation->membership_male= $request->input('membership_male');
        $groupInformation->membership_female= $request->input('membership_female');
        $groupInformation->all_member= $request->input('all_member');
        $groupInformation->dues= $request->input('dues');
        $groupInformation->dues_price= $request->input('dues_price');
        $groupInformation->content= $request->input('content');
        $groupInformation->rocker= $request->input('rocker');
        $groupInformation->mail_box= $request->input('mail_box');
        $groupInformation->method= $request->input('method');
        $groupInformation->supplement= $request->input('supplement');
        $groupInformation->deactivate= $request->input('deactivate');
        $groupInformation->created_by= $request->input('created_by');
        $groupInformation->updated_by= $request->input('updated_by');
        if($groupInformation->save()) {
            return new GroupInformationResource($groupInformation);
        }
    }
    /**
     * Display the specified resource.
     *$
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Get GroupInformations
        $groupInformation = GroupInformation::findOrFail($id);

        // Return single GroupInformations as a resource
        return new GroupInformationResource($groupInformation);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get GroupInformations
        $groupInformation = GroupInformation::findOrFail($id);

        if($groupInformation->delete()) {
            return new GroupInformationResource($groupInformation);
        }    
    }

    /**
     * Display a listing of the resource with requested parameters.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getGroupInformationData(Request $request)
    {
         // Get Kawarabis
         $search = $request->input('search');
         $yearId = $request->input('year');
         
         $groupInformations = GroupInformation::orderBy('created_at', 'desc')->Where('deactivate', 0)->paginate(10);
         
         // Return collection of Kawarabis as a resource
         return GroupInformationResource::collection($groupInformations);
    }
}
