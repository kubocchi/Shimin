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
        $groupInformation->activity_frequency= $request->input('activity_frequency');
        $groupInformation->activity_day= $request->input('activity_day');
        $groupInformation->dues= $request->input('dues');
        $groupInformation->dues_price= $request->input('dues_price');
        $groupInformation->content= $request->input('content');
        $groupInformation->rocker= $request->input('rocker');
        $groupInformation->mail_box= $request->input('mail_box');
        $groupInformation->method= $request->input('method');
        $groupInformation->supplement= $request->input('supplement');
        $groupInformation->file= $request->input('file');
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
         $search = $request->input('search');
         $management = $request->input('management');
         $activityCategory = $request->input('activityCategory');
         $status = $request->input('status');
         $type = $request->input('type');
         
         $groupInformations = GroupInformation::where(function ($query) use($search) {
                                                    $query->where('name', 'like', '%' . $search . '%')
                                                    ->orWhere('name_phonetic', 'like', '%' . $search . '%');
                                                })
                                                ->where(function($query) use ($management)  {
                                                    if(isset($management)) {
                                                        $query->where('regist_management', $management);
                                                    }
                                                })
                                                ->where(function($query) use ($activityCategory)  {
                                                    if(isset($activityCategory)) {
                                                        $query->whereRaw('FIND_IN_SET(?, activity_category)', [$activityCategory]);
                                                    }
                                                })
                                                ->where(function($query) use ($status)  {
                                                    if(isset($status)) {
                                                        $query->where('active_status', $status);
                                                    }
                                                })
                                                ->where(function($query) use ($type)  {
                                                    if(isset($type)) {
                                                        $query->where('type', $type);
                                                    }
                                                })
                                                ->paginate(10);
         
         // Return collection of Kawarabis as a resource
         return GroupInformationResource::collection($groupInformations);
    }

    public function getCSV(Request $request)
    {
        setlocale ( LC_ALL ,  'ja_JP.UTF - 8' );
        if($request->hasFile('file'))
        {
            try {
                $fileExtension = pathinfo($request->file('file')->getClientOriginalName(), PATHINFO_EXTENSION);
                
                if($fileExtension != 'csv'){
                    //File extension not supported msg
                    return;
                }
                $path = $request->file('file')->getRealPath();
                $csv = array_map('str_getcsv', file($path));
                $file = file($path);
                $data = file_get_contents($path);
                $data = mb_convert_encoding($data, 'UTF-8','sjis-win');
    
                $row = 0;
                foreach( explode( PHP_EOL, $data ) as $line ) 
                {   
                    $row++;
                    //skip header row
                    if($row==1)continue;

                    // convert to array
                    //$column = explode(",", $line);
                    $column = str_getcsv($line);
                    
                    // checking if empty then exit 
                    if(empty($column[7])){
                        break;
                    }

                    $groupInformation =  new GroupInformation;    
                    
                    $groupInformation->number= $column[7]; //   1
                    //$groupInformation->type= $column[8]; //   2
                    $groupInformation->type= ($column[8]=='団体')?"0":"1"; //   2
    
                    for($index=1; $index<7; $index++){
                        if($column[$index]=='TRUE')break;
                    }
                    $groupInformation->regist_management= $index; //   3

                    // $groupInformation->open_situation= $column[9]; //   4
                    $groupInformation->open_situation= ($column[9]=='公開')?"0":"1"; //   4
                    // $groupInformation->active_status= $column[10]; //   5 
                    $groupInformation->active_status= ($column[10]=='活動中')?"0":(($column[10]=='休止')?"1":"2"); //   5 
    
                    // checking date format 
                    $groupInformation->pause_date= (empty($column[11]))?NULL:date('Y-m-d', strtotime($column[11])); //   6
                    $groupInformation->application_date=(empty($column[14]))?NULL:date('Y-m-d', strtotime($column[14])); //   7
                    $groupInformation->registration_date= (empty($column[15]))?NULL:date('Y-m-d', strtotime($column[15])); //   8
                    $groupInformation->establishment_date= (empty($column[16]))?NULL:date('Y-m-d', strtotime($column[16])); //   9
    
                    $groupInformation->name= $column[12]; //   10
                    $groupInformation->name_phonetic= $column[13]; //   11
                    $groupInformation->representative_name= $column[23]; //   12
                    $groupInformation->representative_name_phonetic= $column[24]; //   13
                    $groupInformation->disclosure_name= ($column[25]=='TRUE')?"1":"0"; //   14
                    $groupInformation->representative_phone= $column[26]; //   15
                    $groupInformation->disclosure_representative_phone= ($column[27]=='TRUE')?"1":"0"; //   16
                    $groupInformation->representative_phone_2= $column[30]; //   17
                    $groupInformation->disclosure_representative_phone_2= ($column[31]=='TRUE')?"1":"0"; //   18
                    $groupInformation->representative_fax= $column[28]; //   19
                    $groupInformation->disclosure_representative_fax= ($column[29]=='TRUE')?"1":"0"; //   20
                    $groupInformation->contact_name= $column[32]; //   21
                    $groupInformation->contact_name_phonetic= $column[33]; //   22
                    $groupInformation->disclosure_contact_name= ($column[34]=='TRUE')?"1":"0"; //   23
                    $groupInformation->postal_code= $column[17]; //   24
                    $groupInformation->contact_address= $column[18] . $column[19]; //   25
                    $groupInformation->contact_address_name= $column[21]; //   26
                    $groupInformation->contact_address_title= $column[22]; //   27
                    $groupInformation->disclosure_contact_address= ($column[20]=='TRUE')?"1":"0"; //   28
                    $groupInformation->contact_phone= $column[35]; //   29
                    $groupInformation->disclosure_contact_phone= ($column[36]=='TRUE')?"1":"0"; //   30
                    $groupInformation->contact_phone_2= $column[39]; //   31
                    $groupInformation->disclosure_contact_phone_2= ($column[40]=='TRUE')?"1":"0"; //   32
                    $groupInformation->contact_fax= $column[37]; //   33
                    $groupInformation->disclosure_contact_fax= ($column[38]=='TRUE')?"1":"0"; //   34
                    $groupInformation->contact_mail= $column[41]; //   35
                    $groupInformation->disclosure_contact_mail= ($column[42]=='TRUE')?"1":"0"; //   36
                    $groupInformation->contact_url= $column[43]; //   37
                    $groupInformation->disclosure_contact_url= ($column[44]=='TRUE')?"1":"0"; //   38
                    
                    for($index=52; $index<74; $index++){
                        if($column[$index]=='TRUE')break;
                    }
                    $groupInformation->activity_category= strval(($index-51)*100); //   39
                    $groupInformation->active_category_supplement = $column[75]; //   40
                    $groupInformation->membership_male = $column[45]; //   41
                    $groupInformation->membership_female= $column[46]; //   42
                    $groupInformation->all_member= $column[47]; //   43
                    $groupInformation->activity_frequency= $column[51]; //   44

                    if('50361'==$column[7]){
                        $check =  strval(($index-51)*100);
                    }

                    // $groupInformation->activity_day= $column[50]; //   45
                    $groupInformation->activity_day= ($column[50]=='週')?"1":(($column[50]=='月')?"2":(($column[50]=='年')?"3":"4")); //   45
                    // $groupInformation->dues= $column[48]; //   46
                    $groupInformation->dues= ($column[48]=='無')?"0":"1"; //   46

                    $groupInformation->dues_price= $column[49]; //   47
                    $groupInformation->content= $column[79]; //   48
                    $groupInformation->rocker= $column[76]; //   49
                    $groupInformation->mail_box= $column[77]; //   50
                    $groupInformation->method= $column[78]; //   51
                    $groupInformation->supplement= $column[80]; //   52
    
                    $groupInformation->deactivate= 1;
                    $groupInformation->created_by= 1; 
                    $groupInformation->updated_by= 1;
    
                    if($groupInformation->save()) {
                        continue;
                        
                    }
                }
            }
            catch (\Exception $e) {
                throw $e;
            }
        }
    }

    /**
     * Display a listing of the resource with requested parameters.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getGroupInformationFrontData(Request $request)
    {
         $search = $request->input('search');
         $activityCategory = $request->input('activityCategory');
         //$type = $request->input('type');
         
         $groupInformations = GroupInformation::where(function ($query) use($search) {
                                                    $query->where('name', 'like', '%' . $search . '%')
                                                    ->orWhere('name_phonetic', 'like', '%' . $search . '%');
                                                })
                                                ->where('active_status', '0')
                                                ->where(function($query) use ($activityCategory)  {
                                                    if(isset($activityCategory)) {
                                                        $query->whereRaw('FIND_IN_SET(?, activity_category)', [$activityCategory]);
                                                    }
                                                })
                                                ->paginate(40);
         
         // Return collection of Kawarabis as a resource
         return GroupInformationResource::collection($groupInformations);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDownlaodData()
    {
        // Get GroupInformations
        $groupInformations = GroupInformation::all();

        // Return collection of GroupInformations as a resource
        //return GroupInformationResource::collection($groupInformations);
    }
}
