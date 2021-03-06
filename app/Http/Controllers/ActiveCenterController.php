<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ActiveCenterResource;
use App\ActiveCenter;
use App\FileManagement\Repositories\BaseRepository;
use App\FileManagement\Repositories\AttachmentCategory\AttachmentCategoryRepository;
use App\FileManagement\Repositories\Attachment\AttachmentRepository;
use DB;
use Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

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
        $activeCentersFeatured = ActiveCenter::whereNotNull('featured')
                                        ->orderBy('featured', 'asc')
                                        ->Where('deactivate', 0)
                                        ->whereDate('start_date', '<=', date("Y-m-d"))
                                        ->whereDate('end_date', '>=', date("Y-m-d"))
                                        ->get();
        // Get ActiveCenters
        $activeCenters = ActiveCenter::orderBy('updated_at', 'desc')
                                        ->where('featured', NULL)
                                        ->Where('deactivate', 0)
                                        ->whereDate('start_date', '<=', date("Y-m-d"))
                                        ->whereDate('end_date', '>=', date("Y-m-d"))
                                        ->get();

        $result = $activeCentersFeatured->merge($activeCenters)->paginate(10);
        return ActiveCenterResource::collection($result);
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
        $disabled = $request->input('disabled');
        $dateStatus = $request->input('dateStatus');

        $activeCentersFeatured = ActiveCenter::whereNotNull('featured')
                        ->orderBy('featured', 'asc')
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
                        })->get();

        $activeCenters = ActiveCenter::orderBy('updated_at', 'desc')
                        ->where('featured', NULL)
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
                        })->get();

       

        $result = $activeCentersFeatured->merge($activeCenters)->paginate(10);

        //$resultSorted = $result->sortByDesc('expire_at');

        // $count = $activeCenters->count() + $activeCenters2->count();
        // $page = 2;
        // $perPage = 10;

        // $result = new LengthAwarePaginator(
        //     $result->forPage($page, $perPage), $count, $perPage, $page
        // );
 
         // Return collection of ActiveCenters as a resource
         return ActiveCenterResource::collection($result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static  function updateFeatured(Request $request)
    {
        $activeCenters = DB::SELECT(DB::RAW("UPDATE active_centers SET featured = :featured WHERE featured IS NOT NULL"), ['featured' => null]);
        $ids = $request->input('detail');

        for ($i= 0; $i < count($ids); $i++) 
        { 
            $activeCenter = ActiveCenter::findOrFail($ids[$i]);
            $activeCenter->featured = $i;
            $activeCenter->save();
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getFeatured()
    {
        // Get ActiveCenters
        $activeCenters = ActiveCenter::select('id', 'title')->whereNotNull('featured')->orderBy('featured', 'asc')->get();

        // Return collection of ActiveCenters as a resource
        return Response::json(['data' => $activeCenters]);
    }

    function paginate($request, $items, $perPage)
    {
        // Get the ?page=1 from the url
        $page = isset($request->page) ? $request->page : 1; 
        $offset = ($page * $perPage) - $perPage;

        $entries =  new LengthAwarePaginator(
            array_slice($items, $offset, $perPage, true),
            count($items), // Total items
            $perPage, // Items per page
            $page, // Current page
            ['path' => $request->url(), 'query' => $request->query()] // We need this so we can keep all old query parameters from the url
        );

        return $entries;
    }
}
