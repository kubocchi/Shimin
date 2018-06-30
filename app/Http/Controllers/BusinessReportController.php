<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BusinessReport;
use App\Year;
use App\Attachment;
use App\Http\Resources\BusinessReportResource;
use Response;
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
        $businessReports = BusinessReport::With('year')->With('business')->orderBy('created_at', 'desc')->Where('deactivate', 0)->paginate(10);

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

        $businessReport->year_id= $request->input('year_id');
        $businessReport->business_id= $request->input('business_id');
        $businessReport->detail= $request->input('detail');
        $businessReport->file= $request->input('file');
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

    /**
     * Display a listing of the resource with requested parameters.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getBusinessReportData(Request $request)
    {
         // Get Kawarabis
         $search = $request->input('search');
         $yearId = $request->input('year');
         
         $businessReports = BusinessReport::With('year')
                            ->With('business')
                            //->join('businesses', 'business_reports.business_id', '=', 'businesses.id')
                           // ->Where('businesses.name', 'like', '%' . $search . '%')
                            ->where(function($query) use ($yearId)  {
                                if(isset($yearId)) {
                                    $query->where('business_reports.year_id', $yearId);
                                }
                             })
                            ->paginate(10);

        foreach($businessReports as $businessReport)
        {
            $files = explode(",", $businessReport['file']);
            $businessReport['attachments'] =  Attachment::WhereIn('id', $files)->get();
        }
         
         // Return collection of Kawarabis as a resource
         return BusinessReportResource::collection($businessReports);
    }

    /**
     * Display a listing of the resource with requested parameters.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getFrontPageData()
    {
        $businessReports = Year::join('businesses', 'businesses.year_id', '=', 'years.id')
                            ->join('business_reports', 'business_reports.business_id', '=', 'businesses.id')
                            ->orderBy('years.created_at', 'desc')
                            ->get();

        foreach($businessReports as $businessReport)
        {
            $files = explode(",", $businessReport['file']);
            $businessReport['attachments'] =  Attachment::WhereIn('id', $files)->get();
        }
                            
        // Group By Student ID from Query data               
        $groupByData = [];
        foreach($businessReports as $businessReport)
        { 
            $groupByData[$businessReport->year][] = $businessReport;
        }


        return Response::json(['data' => $groupByData], 201);
    }
}
