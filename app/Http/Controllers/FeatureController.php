<?php

namespace App\Http\Controllers;
use App\Feature;
use Illuminate\Http\Request;
use App\Http\Resources\FeatureResource;
class FeatureController extends Controller
{
    
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get Features
        $features = Feature::Where('type', $type)->get();

        // Return collection of Features as a resource
        return FeatureResource::collection($features);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $feature = $request->isMethod('put') ? Feature::findOrFail($request->id) : new Feature;

        $feature->type = $request->input('type');
        $feature->detail = $request->input('detail');
        if($feature->save()) {
            return new FeatureResource($feature);
        }
    }
    /**
     * Display the specified resource.
     *$
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($type)
    {
        // Get Features
        $feature = Feature::Where('type', $type)->get();

        // Return single Features as a resource
        return new FeatureResource($feature);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get Features
        $feature = Feature::findOrFail($id);

        if($feature->delete()) {
            return new FeatureResource($feature);
        }    
    }
}
