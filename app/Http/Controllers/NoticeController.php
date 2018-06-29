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

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::get()->toArray();
        $volunteers = Volunteer::get()->toArray();
        $memberships = Membership::get()->toArray();

        $formattedData = [];
        foreach ($events as $key => $value) 
        {
            $obj = new stdClass;
            $obj->type = 'イベント';
            $obj->id =  $value['id'];
            $obj->subject = $value['subject'];
            $obj->date = \Carbon\Carbon::parse($value['created_at'])->format('Y-m-d');

            array_push($formattedData, $obj);
        }

        foreach ($memberships as $key => $value) 
        {
            $obj = new stdClass;
            $obj->type = '会員募集';
            $obj->id =  $value['id'];
            $obj->subject = $value['organizer'];
            $obj->date = \Carbon\Carbon::parse($value['created_at'])->format('Y-m-d');

            array_push($formattedData, $obj);
        }

        foreach ($volunteers as $key => $value) 
        {
            $obj = new stdClass;
            $obj->type = 'ボランティア情報';
            $obj->id =  $value['id'];
            $obj->subject = $value['subject'];
            $obj->date = \Carbon\Carbon::parse($value['created_at'])->format('Y-m-d');

            array_push($formattedData, $obj);
        }

        
        usort($formattedData, function($a, $b)
        {
            return strcmp($b->date, $a->date);
        });

        return Response::json(['data' => $formattedData], 201);
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

        $events = Event::Where('subject', 'like', '%' . $search . '%')->get()->toArray();
        $volunteers = Volunteer::Where('subject', 'like', '%' . $search . '%')->get()->toArray();
        $memberships = Membership::Where('organizer', 'like', '%' . $search . '%')->get()->toArray();

        $formattedData = [];
        if($type == 1)
        {
            foreach ($events as $key => $value) 
            {
                $obj = new stdClass;
                $obj->type = 'イベント';
                $obj->id =  $value['id'];
                $obj->subject = $value['subject'];
                $obj->date = \Carbon\Carbon::parse($value['created_at'])->format('Y-m-d');
    
                array_push($formattedData, $obj);
            }
        }
        else if($type == 2)
        {
           
            foreach ($volunteers as $key => $value) 
            {
                $obj = new stdClass;
                $obj->type = 'ボランティア情報';
                $obj->id =  $value['id'];
                $obj->subject = $value['subject'];
                $obj->date = \Carbon\Carbon::parse($value['created_at'])->format('Y-m-d');

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
                $obj->date = \Carbon\Carbon::parse($value['created_at'])->format('Y-m-d');

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
                $obj->date = \Carbon\Carbon::parse($value['created_at'])->format('Y-m-d');
    
                array_push($formattedData, $obj);
            }

            foreach ($memberships as $key => $value) 
            {
                $obj = new stdClass;
                $obj->type = '会員募集';
                $obj->id =  $value['id'];
                $obj->subject = $value['organizer'];
                $obj->date = \Carbon\Carbon::parse($value['created_at'])->format('Y-m-d');

                array_push($formattedData, $obj);
            }

            foreach ($volunteers as $key => $value) 
            {
                $obj = new stdClass;
                $obj->type = 'ボランティア情報';
                $obj->id =  $value['id'];
                $obj->subject = $value['subject'];
                $obj->date = \Carbon\Carbon::parse($value['created_at'])->format('Y-m-d');

                array_push($formattedData, $obj);
            }
        }
        
        usort($formattedData, function($a, $b)
        {
            return strcmp($b->date, $a->date);
        });

        return Response::json(['data' => $formattedData], 201);
    }

    public function getNoticeFrontData(Request $request)
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
                $obj->date = \Carbon\Carbon::parse($value['created_at'])->format('Y-m-d');
    
                array_push($formattedData, $obj);
            }
        }
        else if($type == 2)
        {
           
            foreach ($volunteers as $key => $value) 
            {
                $obj = new stdClass;
                $obj->type = 'ボランティア情報';
                $obj->id =  $value['id'];
                $obj->subject = $value['subject'];
                $obj->activityCategory = $value['activity_category'];
                $obj->date = \Carbon\Carbon::parse($value['created_at'])->format('Y-m-d');

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
                $obj->date = \Carbon\Carbon::parse($value['created_at'])->format('Y-m-d');

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
                $obj->date = \Carbon\Carbon::parse($value['created_at'])->format('Y-m-d');
    
                array_push($formattedData, $obj);
            }

            foreach ($memberships as $key => $value) 
            {
                $obj = new stdClass;
                $obj->type = '会員募集';
                $obj->id =  $value['id'];
                $obj->subject = $value['organizer'];
                $obj->activityCategory = $value['activity_category'];
                $obj->date = \Carbon\Carbon::parse($value['created_at'])->format('Y-m-d');

                array_push($formattedData, $obj);
            }

            foreach ($volunteers as $key => $value) 
            {
                $obj = new stdClass;
                $obj->type = 'ボランティア情報';
                $obj->id =  $value['id'];
                $obj->subject = $value['subject'];
                $obj->activityCategory = $value['activity_category'];
                $obj->date = \Carbon\Carbon::parse($value['created_at'])->format('Y-m-d');

                array_push($formattedData, $obj);
            }
        }
        
        usort($formattedData, function($a, $b)
        {
            return strcmp($b->date, $a->date);
        });

        return Response::json(['data' => $formattedData], 201);
    }
}
