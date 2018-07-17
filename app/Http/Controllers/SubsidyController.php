<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subsidy;
use App\Http\Resources\SubsidyResource;


class SubsidyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get ActiveCenters
        $activeCenters = Subsidy::orderBy('updated_at', 'desc')
                                        ->Where('deactivate', 0)
                                        ->whereDate('start_date', '<=', date("Y-m-d"))
                                        ->whereDate('end_date', '>=', date("Y-m-d"))
                                        ->paginate(10);

        // Return collection of ActiveCenters as a resource
        return SubsidyResource::collection($activeCenters);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subsidy = $request->isMethod('put') ? Subsidy::findOrFail($request->id) : new Subsidy;

        $subsidy->title = $request->input('title');
        $subsidy->start_date = $request->input('start_date');
        $subsidy->end_date = $request->input('end_date');
        $subsidy->content = $request->input('content');
        $subsidy->file = $request->input('file');
        $subsidy->deactivate = $request->input('deactivate');
        $subsidy->created_by = $request->input('created_by');
        $subsidy->updated_by = $request->input('updated_by');
        if($subsidy->save()) {
            return new SubsidyResource($subsidy);
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
        // Get Subsidys
        $subsidy = Subsidy::findOrFail($id);

        // Return single Subsidys as a resource
        return new SubsidyResource($subsidy);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get Subsidys
        $subsidy = Subsidy::findOrFail($id);

        if($subsidy->delete()) {
            return new SubsidyResource($subsidy);
        }    
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSubsidyData(Request $request)
    {
        // Get ActiveCenters
        $type = $request->input('type');
        $search = $request->input('search');
        $disabled = $request->input('disabled');
        $dateStatus = $request->input('dateStatus');


        $subsidies = Subsidy::orderBy('updated_at', 'desc')
                        ->where('title', 'like', '%' . $search . '%')
                        ->where(function($query) use ($disabled)  {
                            if(isset($disabled)) {
                                $query->where('deactivate', $disabled);
                            }
                        })
                        ->where(function($query) use ($dateStatus)  {
                            if(isset($dateStatus)) {
                                switch ($dateStatus) {
                                    # Running type
                                    case '1':
                                        $query->whereDate('start_date', '<=', date("Y-m-d"))
                                                ->whereDate('end_date', '>=', date("Y-m-d"));
                                        break;
                                    # Future type
                                    case '2':
                                        $query->whereDate('start_date', '>', date("Y-m-d"));
                                        break;
                                    # Previous type
                                    case '3':
                                        $query->whereDate('end_date', '<', date("Y-m-d"));
                                        break;
                                }
                            }
                        })
                        ->paginate(10);

        // Return collection of Subsidys as a resource
        return SubsidyResource::collection($subsidies);
    }
}
