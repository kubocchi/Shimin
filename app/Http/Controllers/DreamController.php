<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dream;
use App\Http\Resources\DreamResource;
use App\Attachment;
class DreamController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get Dreams
        $dreams = Dream::orderBy('created_at', 'desc')->Where('deactivate', 0)->paginate(10);

        // Return collection of Dreams as a resource
        return DreamResource::collection($dreams);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dream = $request->isMethod('put') ? Dream::findOrFail($request->id) : new Dream;

        $dream->subject= $request->input('subject');
        $dream->detail= $request->input('detail');
        $dream->file= $request->input('file');
        $dream->deactivate= $request->input('deactivate');
        $dream->created_by= $request->input('created_by');
        $dream->updated_by= $request->input('updated_by');
        if($dream->save()) {
            return new DreamResource($dream);
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
        // Get Dreams
        $dream = Dream::findOrFail($id);

        // Return single Dreams as a resource
        return new DreamResource($dream);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get Dreams
        $dream = Dream::findOrFail($id);

        if($dream->delete()) {
            return new DreamResource($dream);
        }    
    }

    /**
     * Display a listing of the resource with requested parameters.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getDreamData(Request $request)
    {
         // Get Kawarabis
         $search = $request->input('search');
         $kawarabis = Dream::Where('subject', 'like', '%' . $search . '%')->orderBy('created_at', 'desc')->paginate(10);
 
         // Return collection of Kawarabis as a resource
         return DreamResource::collection($kawarabis);
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function getDreamDataFront()
     {
        // Get Dreams
        $dreams = Dream::orderBy('updated_at', 'desc')->Where('deactivate', 0)->take(4)->get();

        foreach($dreams as $dream)
        {
            $files = explode(",", $dream['file']);
            $dream['attachments'] =  Attachment::WhereIn('id', $files)->get();
        }
 
         // Return collection of Dreams as a resource
         return DreamResource::collection($dreams);
     }
}
