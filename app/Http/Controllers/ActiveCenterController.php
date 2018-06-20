<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ActiveCenterResource;
use App\ActiveCenter;
use App\FileManagement\Repositories\BaseRepository;
use App\FileManagement\Repositories\AttachmentCategory\AttachmentCategoryRepository;
use App\FileManagement\Repositories\Attachment\AttachmentRepository;

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
        $activeCenters = ActiveCenter::orderBy('created_at', 'desc')->Where('deactivate', 0)->paginate(10);

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

    public function getActiveCenterData(Request $request)
    {
         // Get ActiveCenters
         $activeCenters;
         $type = $request->input('type');
         $search = $request->input('search');
         switch ($type) 
         {
             # All type
             case '0':
                 $activeCenters = ActiveCenter::Where('title', 'like', '%' . $search . '%')
                             ->orderBy('created_at', 'desc')->paginate(10);
                 break;
             # Running type
             case '1':
                 $activeCenters = ActiveCenter::Where('title', 'like', '%' . $search . '%')
                             ->whereDate('start_date', '<=', date("Y-m-d"))
                             ->whereDate('end_date', '>=', date("Y-m-d"))
                             ->orderBy('created_at', 'desc')->paginate(10);
                 break;
             # Future type
             case '2':
                 $activeCenters = ActiveCenter::Where('title', 'like', '%' . $search . '%')
                     ->whereDate('start_date', '>', date("Y-m-d"))
                     ->orderBy('created_at', 'desc')->paginate(10);
                 break;
             # Previous type
             case '3':
                 $activeCenters = ActiveCenter::Where('title', 'like', '%' . $search . '%')
                     ->whereDate('end_date', '<', date("Y-m-d"))
                     ->orderBy('created_at', 'desc')->paginate(10);
                 break;
         }
 
         // Return collection of ActiveCenters as a resource
         return ActiveCenterResource::collection($activeCenters);
    }
}
