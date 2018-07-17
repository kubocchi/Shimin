<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Disaster;
use App\Http\Resources\DisasterResource;
class DisasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get Disasters
        $disasters = Disaster::orderBy('updated_at', 'desc')
                                        ->Where('deactivate', 0)
                                        ->whereDate('start_date', '<=', date("Y-m-d"))
                                        ->whereDate('end_date', '>=', date("Y-m-d"))
                                        ->paginate(10);

        // Return collection of Disaster as a resource
        return DisasterResource::collection($disasters);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $disaster = $request->isMethod('put') ? Disaster::findOrFail($request->id) : new Disaster;

        $disaster->title = $request->input('title');
        $disaster->start_date = $request->input('start_date');
        $disaster->end_date = $request->input('end_date');
        $disaster->content = $request->input('content');
        $disaster->file = $request->input('file');
        $disaster->deactivate = $request->input('deactivate');
        $disaster->created_by = $request->input('created_by');
        $disaster->updated_by = $request->input('updated_by');
        if($disaster->save()) {
            return new DisasterResource($disaster);
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
        // Get Disasters
        $disaster = Disaster::findOrFail($id);

        // Return single Disasters as a resource
        return new DisasterResource($disaster);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get Disasters
        $disaster = Disaster::findOrFail($id);

        if($disaster->delete()) {
            return new DisasterResource($disaster);
        }    
    }

    public function getDisasterData(Request $request)
    {
        // Get ActiveCenters
        $type = $request->input('type');
        $search = $request->input('search');
        $disabled = $request->input('disabled');
        $dateStatus = $request->input('dateStatus');


        $disasters = Disaster::orderBy('updated_at', 'desc')
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

        // Return collection of Disasters as a resource
        return DisasterResource::collection($disasters);
    }
}
