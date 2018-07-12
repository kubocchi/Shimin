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
use App\Support\Collection;

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

        $events = Event::Where('subject', 'like', '%' . $search . '%')
                            ->where(function($query) use ($activityCategory)  {
                                if(isset($activityCategory)) {
                                    $query->where('activity_category', $activityCategory);
                                }
                            })
                            ->get()->toArray();
        $volunteers = Volunteer::Where('subject', 'like', '%' . $search . '%')
                            ->where(function($query) use ($activityCategory)  {
                                if(isset($activityCategory)) {
                                    $query->where('activity_category', $activityCategory);
                                }
                            })->get()->toArray();
        $memberships = Membership::Where('organizer', 'like', '%' . $search . '%') 
                            ->where(function($query) use ($activityCategory)  {
                                if(isset($activityCategory)) {
                                    $query->where('activity_category', $activityCategory);
                                }
                            })->get()->toArray();

        $formattedData = [];
        if($type == 1)
        {
            foreach ($events as $key => $value) 
            {
                $obj = new stdClass;
                $obj->type = 'イベント';
                $obj->id =  $value['id'];
                $obj->subject = $value['subject'];
                $obj->activityCategory = $value['activity_category'];
                $obj->date = $value['event_start_date'] .' ~ '. $value['event_end_date'];
                $obj->updateDate = Carbon::parse($value['updated_at'])->format('Y-m-d H:i:s');
    
                array_push($formattedData, $obj);
            }
        }
        else if($type == 2)
        {
            foreach ($volunteers as $key => $value) 
            {
                $obj = new stdClass;
                $obj->type = 'ボランティア';
                $obj->id =  $value['id'];
                $obj->subject = $value['subject'];
                $obj->activityCategory = $value['activity_category'];
                $obj->date = '';
                $obj->updateDate = Carbon::parse($value['updated_at'])->format('Y-m-d H:i:s');
                
                array_push($formattedData, $obj);
            }
        }
        else if($type == 3)
        {
            foreach ($memberships as $key => $value) 
            {
                $obj = new stdClass;
                $obj->type = '会員募集';
                $obj->id =  $value['id'];
                $obj->subject = $value['organizer'];
                $obj->activityCategory = $value['activity_category'];
                $obj->date = '';
                $obj->updateDate = Carbon::parse($value['updated_at'])->format('Y-m-d H:i:s');
                
                array_push($formattedData, $obj);
            }
        }
        else
        {
            foreach ($events as $key => $value) 
            {
                $obj = new stdClass;
                $obj->type = 'イベント';
                $obj->id =  $value['id'];
                $obj->subject = $value['subject'];
                $obj->activityCategory = $value['activity_category'];
                $obj->date = $value['event_start_date'] .' ~ '. $value['event_end_date'];
                $obj->updateDate = Carbon::parse($value['updated_at'])->format('Y-m-d H:i:s');
    
                array_push($formattedData, $obj);
            }

            foreach ($memberships as $key => $value) 
            {
                $obj = new stdClass;
                $obj->type = '会員募集';
                $obj->id =  $value['id'];
                $obj->subject = $value['organizer'];
                $obj->activityCategory = $value['activity_category'];
                $obj->date = '';
                $obj->updateDate = Carbon::parse($value['updated_at'])->format('Y-m-d H:i:s');

                array_push($formattedData, $obj);
            }

            foreach ($volunteers as $key => $value) 
            {
                $obj = new stdClass;
                $obj->type = 'ボランティア';
                $obj->id =  $value['id'];
                $obj->subject = $value['subject'];
                $obj->activityCategory = $value['activity_category'];
                $obj->date = '';
                $obj->updateDate = Carbon::parse($value['updated_at'])->format('Y-m-d H:i:s');

                array_push($formattedData, $obj);
            }
        }
        
        usort($formattedData, function($a, $b)
        {
            return strcmp($b->updateDate, $a->updateDate);
        });

        $collection = (new Collection($formattedData))->paginate(20);

        return Response::json(['data' => $formattedData], 201);
    }

    public function getNoticeFrontData(Request $request)
    {
        $type = $request->input('noticeType');
        $search = $request->input('search');
        $activityCategory = $request->input('activityCategory');

        $events = Event::Where('deactivate', 0)->Where('subject', 'like', '%' . $search . '%')
                            ->where(function($query) use ($activityCategory)  {
                                if(isset($activityCategory)) {
                                    $query->where('activity_category', $activityCategory);
                                }
                            })
                            ->get()->toArray();
        $volunteers = Volunteer::Where('deactivate', 0)->Where('subject', 'like', '%' . $search . '%')
                            ->where(function($query) use ($activityCategory)  {
                                if(isset($activityCategory)) {
                                    $query->where('activity_category', $activityCategory);
                                }
                            })->get()->toArray();
        $memberships = Membership::Where('deactivate', 0)->Where('organizer', 'like', '%' . $search . '%') 
                            ->where(function($query) use ($activityCategory)  {
                                if(isset($activityCategory)) {
                                    $query->where('activity_category', $activityCategory);
                                }
                            })->get()->toArray();

        $formattedData = [];
        if($type == 1)
        {
            foreach ($events as $key => $value) 
            {
                $obj = new stdClass;
                $obj->type = 'イベント';
                $obj->id =  $value['id'];
                $obj->subject = $value['subject'];
                $obj->activityCategory = $value['activity_category'];
                $obj->date = $value['event_start_date'] .' ~ '. $value['event_end_date'];
                $obj->updateDate = Carbon::parse($value['updated_at'])->format('Y-m-d H:i:s');
    
                array_push($formattedData, $obj);
            }
        }
        else if($type == 2)
        {
            foreach ($volunteers as $key => $value) 
            {
                $obj = new stdClass;
                $obj->type = 'ボランティア';
                $obj->id =  $value['id'];
                $obj->subject = $value['subject'];
                $obj->activityCategory = $value['activity_category'];
                $obj->date = '';
                $obj->updateDate = Carbon::parse($value['updated_at'])->format('Y-m-d H:i:s');
                
                array_push($formattedData, $obj);
            }
        }
        else if($type == 3)
        {
            foreach ($memberships as $key => $value) 
            {
                $obj = new stdClass;
                $obj->type = '会員募集';
                $obj->id =  $value['id'];
                $obj->subject = $value['organizer'];
                $obj->activityCategory = $value['activity_category'];
                $obj->date = '';
                $obj->updateDate = Carbon::parse($value['updated_at'])->format('Y-m-d H:i:s');
                
                array_push($formattedData, $obj);
            }
        }
        else
        {
            foreach ($events as $key => $value) 
            {
                $obj = new stdClass;
                $obj->type = 'イベント';
                $obj->id =  $value['id'];
                $obj->subject = $value['subject'];
                $obj->activityCategory = $value['activity_category'];
                $obj->date = $value['event_start_date'] .' ~ '. $value['event_end_date'];
                $obj->updateDate = Carbon::parse($value['updated_at'])->format('Y-m-d H:i:s');
    
                array_push($formattedData, $obj);
            }

            foreach ($memberships as $key => $value) 
            {
                $obj = new stdClass;
                $obj->type = '会員募集';
                $obj->id =  $value['id'];
                $obj->subject = $value['organizer'];
                $obj->activityCategory = $value['activity_category'];
                $obj->date = '';
                $obj->updateDate = Carbon::parse($value['updated_at'])->format('Y-m-d H:i:s');

                array_push($formattedData, $obj);
            }

            foreach ($volunteers as $key => $value) 
            {
                $obj = new stdClass;
                $obj->type = 'ボランティア';
                $obj->id =  $value['id'];
                $obj->subject = $value['subject'];
                $obj->activityCategory = $value['activity_category'];
                $obj->date = '';
                $obj->updateDate = Carbon::parse($value['updated_at'])->format('Y-m-d H:i:s');

                array_push($formattedData, $obj);
            }
        }
        
        usort($formattedData, function($a, $b)
        {
            return strcmp($b->updateDate, $a->updateDate);
        });

        return Response::json(['data' => $formattedData], 201);
    }

    public function getNoticeHomePageData()
    {
        $events = Event::Where('deactivate', 0)->take(6)->get()->toArray();
        $volunteers = Volunteer::Where('deactivate', 0)->take(6)->get()->toArray();
        $memberships = Membership::Where('deactivate', 0)->take(6)->get()->toArray();

        $eventsResponce = [];
        $volunteersResponce = [];
        $membershipResponce = [];
        $allResponce = [];

        # Getting Events for Home page 
        foreach ($events as $key => $value) 
        {
            $obj = new stdClass;
            $obj->type = 'イベント';
            $obj->id =  $value['id'];
            $obj->subject = $value['subject'];
            $obj->activityCategory = $value['activity_category'];
            $obj->date = $value['event_start_date'] .' ~ '. $value['event_end_date'];
            $obj->updateDate = Carbon::parse($value['updated_at'])->format('Y-m-d H:i:s');

            array_push($eventsResponce, $obj);
        }

        # Getting Volunteer for Home page 
        foreach ($volunteers as $key => $value) 
        {
            $obj = new stdClass;
            $obj->type = 'ボランティア';
            $obj->id =  $value['id'];
            $obj->subject = $value['subject'];
            $obj->activityCategory = $value['activity_category'];
            $obj->date = '';
            $obj->updateDate = Carbon::parse($value['updated_at'])->format('Y-m-d H:i:s');

            array_push($volunteersResponce, $obj);
        }

        # Getting Memberships for Home page 
        foreach ($memberships as $key => $value) 
        {
            $obj = new stdClass;
            $obj->type = '会員募集';
            $obj->id =  $value['id'];
            $obj->subject = $value['organizer'];
            $obj->activityCategory = $value['activity_category'];
            $obj->date = '';
            $obj->updateDate = Carbon::parse($value['updated_at'])->format('Y-m-d H:i:s');

            array_push($membershipResponce, $obj);
        }

        # Getting First 6 items order by update date from Events, vounteers,memberships for Home page 
        foreach ($events as $key => $value) 
        {
            $obj = new stdClass;
            $obj->type = 'イベント';
            $obj->id =  $value['id'];
            $obj->subject = $value['subject'];
            $obj->activityCategory = $value['activity_category'];
            $obj->date = $value['event_start_date'] .' ~ '. $value['event_end_date'];
            $obj->updateDate = Carbon::parse($value['updated_at'])->format('Y-m-d H:i:s');

            array_push($allResponce, $obj);
        }

        foreach ($memberships as $key => $value) 
        {
            $obj = new stdClass;
            $obj->type = '会員募集';
            $obj->id =  $value['id'];
            $obj->subject = $value['organizer'];
            $obj->activityCategory = $value['activity_category'];
            $obj->date = '';
            $obj->updateDate = Carbon::parse($value['updated_at'])->format('Y-m-d H:i:s');

            array_push($allResponce, $obj);
        }

        foreach ($volunteers as $key => $value) 
        {
            $obj = new stdClass;
            $obj->type = 'ボランティア';
            $obj->id =  $value['id'];
            $obj->subject = $value['subject'];
            $obj->activityCategory = $value['activity_category'];
            $obj->date = '';
            $obj->updateDate = Carbon::parse($value['updated_at'])->format('Y-m-d H:i:s');

            array_push($allResponce, $obj);
        }
        
        usort($allResponce, function($a, $b)
        {
            return strcmp($b->updateDate, $a->updateDate);
        }); 
        $allResponce = array_slice($allResponce, 0, 6);

        
        return Response::json(['data' => ['events'=> $eventsResponce, 'volunteers'=> $volunteersResponce, 'memberships'=> $membershipResponce, 'all'=> $allResponce]], 201);
    }

    function paginate($items, $per_page)
    {
        $page   = 1;
        $offset = ($page * $per_page) - $per_page;

        return new Illuminate\Pagination\LengthAwarePaginator(
            $items->forPage($page, $per_page)->values(),
            $items->count(),
            $per_page,
            Illuminate\Pagination\Paginator::resolveCurrentPage(),
            ['path' => Illuminate\Pagination\Paginator::resolveCurrentPath()]
        );
    }
}
