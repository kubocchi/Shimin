<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BusinessReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get BusinessReports
        $businessReports = BusinessReport::orderBy('created_at', 'desc')->Where('deactivate', 0)->paginate(10);

        // Return collection of BusinessReports as a resource
        return BusinessReportResource::collection($businessReports);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $businessReport = $request->isMethod('put') ? BusinessReport::findOrFail($request->id) : new BusinessReport;

        $businessReport->year= $request->input('year');
        $businessReport->business_name= $request->input('business_name');
        $businessReport->detail= $request->input('detail');
        $businessReport->deactivate= $request->input('deactivate');
        $businessReport->created_by= $request->input('created_by');
        $businessReport->updated_by= $request->input('updated_by');
        if($businessReport->save()) {
            return new BusinessReportResource($businessReport);
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
        // Get BusinessReports
        $businessReport = BusinessReport::findOrFail($id);

        // Return single BusinessReports as a resource
        return new BusinessReportResource($businessReport);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get BusinessReports
        $businessReport = BusinessReport::findOrFail($id);

        if($businessReport->delete()) {
            return new BusinessReportResource($businessReport);
        }    
    }
}
