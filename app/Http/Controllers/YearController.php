<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Year;
use App\Http\Resources\YearResource;
class YearController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get Years
        $years = Year::orderBy('created_at', 'desc')->Where('deactivate', 0)->paginate(10);

        // Return collection of Years as a resource
        return YearResource::collection($years);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $year = $request->isMethod('put') ? Year::findOrFail($request->id) : new Year;

        $year->year= $request->input('year');
        $year->deactivate= $request->input('deactivate');
        $year->created_by= $request->input('created_by');
        $year->updated_by= $request->input('updated_by');
        if($year->save()) {
            return new YearResource($year);
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
        // Get Years
        $year = Year::findOrFail($id);

        // Return single Years as a resource
        return new YearResource($year);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get Years
        $year = Year::findOrFail($id);

        if($year->delete()) {
            return new YearResource($year);
        }    
    }

    public function getYearData(Request $request)
    {
         // Get Years
         $years;
         $type = $request->input('type');
         $search = $request->input('search');
         switch ($type) 
         {
             # All type
             case '0':
                 $years = Year::Where('year', 'like', '%' . $search . '%')
                             ->orderBy('created_at', 'desc')->paginate(10);
                 break;
             # Running type
             case '1':
                 $years = Year::Where('year', 'like', '%' . $search . '%')
                             ->whereDate('start_date', '<=', date("Y-m-d"))
                             ->whereDate('end_date', '>=', date("Y-m-d"))
                             ->orderBy('created_at', 'desc')->paginate(10);
                 break;
             # Future type
             case '2':
                 $years = Year::Where('year', 'like', '%' . $search . '%')
                     ->whereDate('start_date', '>', date("Y-m-d"))
                     ->orderBy('created_at', 'desc')->paginate(10);
                 break;
             # Previous type
             case '3':
                 $years = Year::Where('year', 'like', '%' . $search . '%')
                     ->whereDate('end_date', '<', date("Y-m-d"))
                     ->orderBy('created_at', 'desc')->paginate(10);
                 break;
         }
 
         // Return collection of Years as a resource
         return YearResource::collection($years);
    }
}
