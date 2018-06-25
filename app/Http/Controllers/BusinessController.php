<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Business;
use App\Http\Resources\BusinessResource;
class BusinessController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get Businesses
        $businesses = Business::orderBy('created_at', 'desc')->Where('deactivate', 0)->paginate(10);

        // Return collection of Businesss as a resource
        return BusinessResource::collection($businesses);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $business = $request->isMethod('put') ? Business::findOrFail($request->id) : new Business;

        $business->name= $request->input('name');
        $business->year_id= $request->input('year_id');
        $business->deactivate= $request->input('deactivate');
        $business->created_by= $request->input('created_by');
        $business->updated_by= $request->input('updated_by');
        if($business->save()) {
            return new BusinessResource($business);
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
        // Get Businesss
        $business = Business::findOrFail($id);

        // Return single Businesss as a resource
        return new BusinessResource($business);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get Businesss
        $business = Business::findOrFail($id);

        if($business->delete()) {
            return new BusinessResource($business);
        }    
    }

    public function getBusinessData(Request $request)
    {
         // Get Businesss
         $businesses;
         $type = $request->input('type');
         $search = $request->input('search');
         switch ($type) 
         {
             # All type
             case '0':
                 $businesses = Business::Where('name', 'like', '%' . $search . '%')
                             ->orderBy('created_at', 'desc')->paginate(10);
                 break;
             # Running type
             case '1':
                 $businesses = Business::Where('name', 'like', '%' . $search . '%')
                             ->whereDate('start_date', '<=', date("Y-m-d"))
                             ->whereDate('end_date', '>=', date("Y-m-d"))
                             ->orderBy('created_at', 'desc')->paginate(10);
                 break;
             # Future type
             case '2':
                 $businesses = Business::Where('name', 'like', '%' . $search . '%')
                     ->whereDate('start_date', '>', date("Y-m-d"))
                     ->orderBy('created_at', 'desc')->paginate(10);
                 break;
             # Previous type
             case '3':
                 $businesses = Business::Where('name', 'like', '%' . $search . '%')
                     ->whereDate('end_date', '<', date("Y-m-d"))
                     ->orderBy('created_at', 'desc')->paginate(10);
                 break;
         }
 
         // Return collection of Businesss as a resource
         return BusinessResource::collection($businesses);
    }
}
