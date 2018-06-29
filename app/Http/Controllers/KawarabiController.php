<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kawarabi;
use App\Http\Resources\KawarabiResource;
class KawarabiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get Kawarabis
        $kawarabis = Kawarabi::orderBy('created_at', 'desc')->Where('deactivate', 0)->paginate(10);

        // Return collection of Kawarabis as a resource
        return KawarabiResource::collection($kawarabis);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kawarabi = $request->isMethod('put') ? Kawarabi::findOrFail($request->id) : new Kawarabi;

        $kawarabi->subject= $request->input('subject');
        $kawarabi->detail= $request->input('detail');
        $kawarabi->file= $request->input('file');
        $kawarabi->deactivate= $request->input('deactivate');
        $kawarabi->created_by= $request->input('created_by');
        $kawarabi->updated_by= $request->input('updated_by');
        if($kawarabi->save()) {
            return new KawarabiResource($kawarabi);
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
        // Get Kawarabis
        $kawarabi = Kawarabi::findOrFail($id);

        // Return single Kawarabis as a resource
        return new KawarabiResource($kawarabi);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get Kawarabis
        $kawarabi = Kawarabi::findOrFail($id);

        if($kawarabi->delete()) {
            return new KawarabiResource($kawarabi);
        }    
    }

    /**
     * Display a listing of the resource with requested parameters.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getKawarabiData(Request $request)
    {
         // Get Kawarabis
         $search = $request->input('search');
         $kawarabis = Kawarabi::Where('subject', 'like', '%' . $search . '%')->orderBy('created_at', 'desc')->paginate(10);
 
         // Return collection of Kawarabis as a resource
         return KawarabiResource::collection($kawarabis);
    }

    /**
     * Display a listing of the resource with requested parameters.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getKawarabiDataFront(Request $request)
    {
         // Get Kawarabis
         $search = $request->input('search');
         $kawarabis = Kawarabi::Where('subject', 'like', '%' . $search . '%')->orderBy('created_at', 'desc')->take(1)->get();
 
         // Return collection of Kawarabis as a resource
         return KawarabiResource::collection($kawarabis);
    }
}
