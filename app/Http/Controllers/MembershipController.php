<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Membership;
use App\Http\Resources\MembershipResource;
class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get Memberships
        $memberships = Membership::orderBy('created_at', 'desc')->Where('deactivate', 0)->paginate(10);

        // Return collection of Memberships as a resource
        return MembershipResource::collection($memberships);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $membership = $request->isMethod('put') ? Membership::findOrFail($request->id) : new Membership;

        $membership->organizer= $request->input('organizer');
        $membership->activity_category= $request->input('activity_category');
        $membership->start_date= $request->input('start_date');
        $membership->end_date= $request->input('end_date');
        $membership->file= $request->input('file');
        $membership->content= $request->input('content');
        $membership->is_payment= $request->input('is_payment');
        $membership->amount= $request->input('amount');
        $membership->payment_type= $request->input('payment_type');
        $membership->linkname= $request->input('linkname');
        $membership->contact= $request->input('contact');
        $membership->deactivate= $request->input('deactivate');
        $membership->created_by= $request->input('created_by');
        $membership->updated_by= $request->input('updated_by');
        if($membership->save()) {
            return new MembershipResource($membership);
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
        // Get Memberships
        $membership = Membership::findOrFail($id);

        // Return single Memberships as a resource
        return new MembershipResource($membership);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get Memberships
        $membership = Membership::findOrFail($id);

        if($membership->delete()) {
            return new MembershipResource($membership);
        }    
    }

    public function getMembershipData(Request $request)
    {
         // Get Memberships
         $memberships;
         $type = $request->input('type');
         $search = $request->input('search');
         switch ($type) 
         {
             # All type
             case '0':
                 $memberships = Membership::Where('title', 'like', '%' . $search . '%')
                             ->orderBy('created_at', 'desc')->paginate(10);
                 break;
             # Running type
             case '1':
                 $memberships = Membership::Where('title', 'like', '%' . $search . '%')
                             ->whereDate('start_date', '<=', date("Y-m-d"))
                             ->whereDate('end_date', '>=', date("Y-m-d"))
                             ->orderBy('created_at', 'desc')->paginate(10);
                 break;
             # Future type
             case '2':
                 $memberships = Membership::Where('title', 'like', '%' . $search . '%')
                     ->whereDate('start_date', '>', date("Y-m-d"))
                     ->orderBy('created_at', 'desc')->paginate(10);
                 break;
             # Previous type
             case '3':
                 $memberships = Membership::Where('title', 'like', '%' . $search . '%')
                     ->whereDate('end_date', '<', date("Y-m-d"))
                     ->orderBy('created_at', 'desc')->paginate(10);
                 break;
         }
 
         // Return collection of Memberships as a resource
         return MembershipResource::collection($memberships);
    }
}
