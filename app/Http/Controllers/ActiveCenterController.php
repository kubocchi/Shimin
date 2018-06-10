<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ActiveCenterResource;
use App\ActiveCenter;

class ActiveCenterController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get ActiveCenters
        $activeCenters = ActiveCenter::orderBy('created_at', 'desc')->paginate(15);

        // Return collection of ActiveCenters as a resource
        return ActiveCenterResource::collection($activeCenters);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $activeCenter = $request->isMethod('put') ? ActiveCenter::findOrFail($request->id) : new ActiveCenter;

       $activeCenter->title = $request->input('title');
        $activeCenter->start_date = $request->input('start_date');
        $activeCenter->end_date = $request->input('end_date');
        $activeCenter->content = $request->input('content');
        $activeCenter->file = $request->input('file');
        $activeCenter->deactivate = $request->input('deactivate');
        $activeCenter->created_by = $request->input('created_by');
        $activeCenter->updated_by = $request->input('updated_by');
        if($activeCenter->save()) {
            return new ActiveCenterResource($activeCenter);
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
        // Get ActiveCenters
        $activeCenter = ActiveCenter::findOrFail($id);

        // Return single ActiveCenters as a resource
        return new ActiveCenterResource($activeCenter);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get ActiveCenters
        $activeCenter = ActiveCenter::findOrFail($id);

        if($activeCenter->delete()) {
            return new ActiveCenterResource($activeCenter);
        }    
    }

    public function postImageUpload(Request $request)
    {
        $extension = $request->file('file')->getClientOriginalExtension();
        $fileName = str_random(8).'.'.$extension;
        $request->file('file')->storeAs('uploads', $fileName);
        return '/uploads/'.$fileName;
    }
}
