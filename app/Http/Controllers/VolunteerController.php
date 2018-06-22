<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Volunteer;
use App\Http\Resources\VolunteerResource;

class VolunteerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get Volunteers
        $volunteers = Volunteer::orderBy('created_at', 'desc')->Where('deactivate', 0)->paginate(10);

        // Return collection of Volunteers as a resource
        return VolunteerResource::collection($volunteers);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $volunteer = $request->isMethod('put') ? Volunteer::findOrFail($request->id) : new Volunteer;

        $volunteer->subject= $request->input('subject');
        $volunteer->activity_category= $request->input('activity_category');
        $volunteer->children= $request->input('children');
        $volunteer->start_date= $request->input('start_date');
        $volunteer->end_date= $request->input('end_date');
        $volunteer->sponsor= $request->input('sponsor');
        $volunteer->file= $request->input('file');
        $volunteer->activity_date= $request->input('activity_date');
        $volunteer->deadline= $request->input('deadline');
        $volunteer->activity_location= $request->input('activity_location');
        $volunteer->number_of_people= $request->input('number_of_people');
        $volunteer->orientation= $request->input('orientation');
        $volunteer->cost= $request->input('cost');
        $volunteer->subscription= $request->input('subscription');
        $volunteer->content= $request->input('content');
        $volunteer->linkname= $request->input('linkname');
        $volunteer->contact= $request->input('contact');
        $volunteer->deactivate= $request->input('deactivate');
        $volunteer->created_by= $request->input('created_by');
        $volunteer->updated_by= $request->input('updated_by');
        if($volunteer->save()) {
            return new VolunteerResource($volunteer);
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
        // Get Volunteers
        $volunteer = Volunteer::findOrFail($id);

        // Return single Volunteers as a resource
        return new VolunteerResource($volunteer);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get Volunteers
        $volunteer = Volunteer::findOrFail($id);

        if($volunteer->delete()) {
            return new VolunteerResource($volunteer);
        }    
    }

    public function getVolunteerData(Request $request)
    {
         // Get Volunteers
         $volunteers;
         $type = $request->input('type');
         $search = $request->input('search');
         switch ($type) 
         {
             # All type
             case '0':
                 $volunteers = Volunteer::Where('title', 'like', '%' . $search . '%')
                             ->orderBy('created_at', 'desc')->paginate(10);
                 break;
             # Running type
             case '1':
                 $volunteers = Volunteer::Where('title', 'like', '%' . $search . '%')
                             ->whereDate('start_date', '<=', date("Y-m-d"))
                             ->whereDate('end_date', '>=', date("Y-m-d"))
                             ->orderBy('created_at', 'desc')->paginate(10);
                 break;
             # Future type
             case '2':
                 $volunteers = Volunteer::Where('title', 'like', '%' . $search . '%')
                     ->whereDate('start_date', '>', date("Y-m-d"))
                     ->orderBy('created_at', 'desc')->paginate(10);
                 break;
             # Previous type
             case '3':
                 $volunteers = Volunteer::Where('title', 'like', '%' . $search . '%')
                     ->whereDate('end_date', '<', date("Y-m-d"))
                     ->orderBy('created_at', 'desc')->paginate(10);
                 break;
         }
 
         // Return collection of Volunteers as a resource
         return VolunteerResource::collection($volunteers);
    }
}
