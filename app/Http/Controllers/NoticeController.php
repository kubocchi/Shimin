<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Volunteer;
use App\Membership;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Resources\NoticeResource;
use Illuminate\Pagination\Paginator;
use Response;
use \stdClass;
use Carbon\Carbon;
//use App\Support\Collection;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    public function paginates($items, $perPage)
    {
        $pageStart = \Request::get('page', 1);
        // Start displaying items from this number;
        $offSet = ($pageStart * $perPage) - $perPage; 
        // Get only the items you need using array_slice
        $itemsForCurrentPage = array_slice($items, $offSet, $perPage, true);

        return new LengthAwarePaginator($itemsForCurrentPage, count($items), $perPage, Paginator::resolveCurrentPage(), array('path' => Paginator::resolveCurrentPath()));
    }

    public function getNoticeData(Request $request)
    {
        $type = $request->input('noticeType');
        $search = $request->input('search');
        $activityCategory = $request->input('activityCategory');
        $disabled = $request->input('disabled');
        $dateStatus = $request->input('dateStatus');

        $events = Event::Where('subject', 'like', '%' . $search . '%')
                            ->where(function($query) use ($activityCategory)  {
                                if(isset($activityCategory)) {
                                    $query->where('activity_category', $activityCategory);
                                }
                            })
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
                            ->get()->toArray();
        
        $volunteers = Volunteer::Where('subject', 'like', '%' . $search . '%')
                            ->where(function($query) use ($activityCategory)  {
                                if(isset($activityCategory)) {
                                    $query->where('activity_category', $activityCategory);
                                }
                            })
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
                            ->get()->toArray();

        $memberships = Membership::Where('organizer', 'like', '%' . $search . '%') 
                            ->where(function($query) use ($activityCategory)  {
                                if(isset($activityCategory)) {
                                    $query->where('activity_category', $activityCategory);
                                }
                            })
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
                            ->get()->toArray();

        $formattedData = [];
        if($type == 1)
        {
            if(count($events)) array_push($formattedData, ...$this->makeCustomCollection($events, 'イベント'));
        }
        else if($type == 2)
        {
            if(count($volunteers)) array_push($formattedData, ...$this->makeCustomCollection($volunteers, 'ボランティア'));
        }
        else if($type == 3)
        {
            if(count($memberships)) array_push($formattedData, ...$this->makeCustomCollection($memberships, '会員募集'));
        }
        else
        {
            if(count($events)) array_push($formattedData, ...$this->makeCustomCollection($events, 'イベント'));
            if(count($memberships)) array_push($formattedData, ...$this->makeCustomCollection($memberships, '会員募集'));
            if(count($volunteers)) array_push($formattedData, ...$this->makeCustomCollection($volunteers, 'ボランティア'));
        }

        $formattedData = $this->sortByUpdateDate($formattedData);

        //$collection = (new Collection($formattedData))->paginate(20);

        return Response::json(['data' => $formattedData], 201);
    }

    public function getNoticeFrontData(Request $request)
    {
        $type = $request->input('noticeType');
        $search = $request->input('search');
        $activityCategory = $request->input('activityCategory');

        $events = Event::Where('deactivate', 0)
                            ->Where('subject', 'like', '%' . $search . '%')
                            ->where(function($query) use ($activityCategory)  {
                                if(isset($activityCategory)) {
                                    $query->where('activity_category', $activityCategory);
                                }
                            })
                            ->whereDate('start_date', '<=', date("Y-m-d"))
                            ->whereDate('end_date', '>=', date("Y-m-d"))
                            ->get()->toArray();

        $volunteers = Volunteer::Where('deactivate', 0)
                            ->Where('subject', 'like', '%' . $search . '%')
                            ->where(function($query) use ($activityCategory)  {
                                if(isset($activityCategory)) {
                                    $query->where('activity_category', $activityCategory);
                                }
                            })
                            ->whereDate('start_date', '<=', date("Y-m-d"))
                            ->whereDate('end_date', '>=', date("Y-m-d"))
                            ->get()->toArray();

        $memberships = Membership::Where('deactivate', 0)
                            ->Where('organizer', 'like', '%' . $search . '%') 
                            ->where(function($query) use ($activityCategory)  {
                                if(isset($activityCategory)) {
                                    $query->where('activity_category', $activityCategory);
                                }
                            })
                            ->whereDate('start_date', '<=', date("Y-m-d"))
                            ->whereDate('end_date', '>=', date("Y-m-d"))
                            ->get()->toArray();

        $formattedData = [];
        if($type == 1)
        {
            if(count($events)) array_push($formattedData, ...$this->makeCustomCollection($events, 'イベント'));
        }
        else if($type == 2)
        {
            if(count($volunteers)) array_push($formattedData, ...$this->makeCustomCollection($volunteers, 'ボランティア'));
        }
        else if($type == 3)
        {
            if(count($memberships)) array_push($formattedData, ...$this->makeCustomCollection($memberships, '会員募集'));
        }
        else
        {
            if(count($events)) array_push($formattedData, ...$this->makeCustomCollection($events, 'イベント'));
            if(count($memberships)) array_push($formattedData, ...$this->makeCustomCollection($memberships, '会員募集'));
            if(count($volunteers)) array_push($formattedData, ...$this->makeCustomCollection($volunteers, 'ボランティア'));
        }

        $formattedData = $this->sortByUpdateDate($formattedData);

        return Response::json(['data' => $formattedData], 201);
    }

    public function getNoticeHomePageData()
    {
        $events = Event::orderBy('updated_at', 'desc')
                            ->Where('deactivate', 0)
                            ->whereDate('start_date', '<=', date("Y-m-d"))
                            ->whereDate('end_date', '>=', date("Y-m-d"))
                            ->take(6)->get()->toArray();

        $volunteers = Volunteer::orderBy('updated_at', 'desc')
                            ->Where('deactivate', 0)
                            ->whereDate('start_date', '<=', date("Y-m-d"))
                            ->whereDate('end_date', '>=', date("Y-m-d"))
                            ->take(6)->get()->toArray();

        $memberships = Membership::orderBy('updated_at', 'desc')
                            ->Where('deactivate', 0)
                            ->whereDate('start_date', '<=', date("Y-m-d"))
                            ->whereDate('end_date', '>=', date("Y-m-d"))
                            ->take(6)->get()->toArray();

        $eventsResponce = [];
        $volunteersResponce = [];
        $membershipResponce = [];
        $allResponce = [];

        # Getting Events for Home page 
        
        # Getting Volunteer for Home page 

        # Getting Memberships for Home page 
        
        if(count($events)) array_push($eventsResponce, ...$this->makeCustomCollection($events, 'イベント'));
        if(count($memberships)) array_push($membershipResponce, ...$this->makeCustomCollection($memberships, '会員募集'));
        if(count($volunteers)) array_push($volunteersResponce, ...$this->makeCustomCollection($volunteers, 'ボランティア'));

        # Getting First 6 items order by update date from Events, vounteers,memberships for Home page 
        if(count($events)) array_push($allResponce, ...$this->makeCustomCollection($events, 'イベント'));
        if(count($memberships)) array_push($allResponce, ...$this->makeCustomCollection($memberships, '会員募集'));
        if(count($volunteers)) array_push($allResponce, ...$this->makeCustomCollection($volunteers, 'ボランティア'));
        
         
        $allResponce = $this->sortByUpdateDate($allResponce);
        $allResponce = array_slice($allResponce, 0, 6);

        
        return Response::json(['data' => ['events'=> $eventsResponce, 'volunteers'=> $volunteersResponce, 'memberships'=> $membershipResponce, 'all'=> $allResponce]], 201);
    }

    // function paginate($items, $per_page)
    // {
    //     $page   = 1;
    //     $offset = ($page * $per_page) - $per_page;

    //     return new Illuminate\Pagination\LengthAwarePaginator(
    //         $items->forPage($page, $per_page)->values(),
    //         $items->count(),
    //         $per_page,
    //         Illuminate\Pagination\Paginator::resolveCurrentPage(),
    //         ['path' => Illuminate\Pagination\Paginator::resolveCurrentPath()]
    //     );
    // }

    public function makeCustomCollection($collection, $type)
    {   
        $formattedData = [];
        foreach ($collection as $key => $value) 
        {
            $obj = new stdClass;
            $obj->type = $type;
            $obj->id =  $value['id'];
            $obj->subject = array_key_exists("subject", $value) ?  $value['subject'] : $value['organizer'];
            $obj->activityCategory = $value['activity_category'];
            $obj->date = array_key_exists("event_start_date", $value) ? $value['event_start_date'] .' ~ '. $value['event_end_date'] : '';
            $obj->updateDate = Carbon::parse($value['updated_at'])->format('Y-m-d H:i:s');

            //array_push($formattedData, $obj);
            $formattedData[] = $obj;
        }
        return $formattedData;
    }

    public function sortByUpdateDate($allResponce)
    {
        usort($allResponce, function($a, $b)
        {
            return strcmp($b->updateDate, $a->updateDate);
        }); 

        return $allResponce;
    }
}
