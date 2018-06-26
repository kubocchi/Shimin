<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Various;
use App\Http\Resources\VariousResource;
class VariousController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get Variouss
        $variouses = Various::orderBy('created_at', 'desc')->Where('deactivate', 0)->paginate(10);

        // Return collection of Variouss as a resource
        return VariousResource::collection($variouses);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $various = $request->isMethod('put') ? Various::findOrFail($request->id) : new Various;

        $various->subject= $request->input('subject');
        $various->detail= $request->input('detail');
        $various->group= $request->input('group');
        $various->file= $request->input('file');
        $various->deactivate= $request->input('deactivate');
        $various->created_by= $request->input('created_by');
        $various->updated_by= $request->input('updated_by');
        if($various->save()) {
            return new VariousResource($various);
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
        // Get Variouss
        $various = Various::findOrFail($id);

        // Return single Variouss as a resource
        return new VariousResource($various);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get Variouss
        $various = Various::findOrFail($id);

        if($various->delete()) {
            return new VariousResource($various);
        }    
    }

    /**
     * Display a listing of the resource with requested parameters.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getVariousData(Request $request)
    {
         // Get Variouss
        $search = $request->input('search');
        $group = $request->input('group');
         
        $variouses = Various::where('subject', 'like', '%' . $search . '%')
                            ->where(function($query) use ($group)  {
                                if(isset($group)) {
                                    $query->where('group', $group);
                                }
                             })
                            ->paginate(10);
 
         // Return collection of Variouss as a resource
         return VariousResource::collection($variouses);
    }
}
