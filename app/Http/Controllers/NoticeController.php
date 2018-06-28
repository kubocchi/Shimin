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
        // Get ActiveCenter


        $events = Event::get()->toArray();
        $volunteers = Volunteer::get()->toArray();
        $memberships = Membership::get()->toArray();

        $newEvents = [];
        foreach ($events as $key => $value) 
        {
            $obj = new stdClass;
            $obj->type = 'イベント';
            $obj->id =  $value['id'];
            $obj->subject = $value['subject'];
            $obj->date = \Carbon\Carbon::parse($value['created_at'])->format('Y-m-d');

           array_push($newEvents, $obj);
        }

        foreach ($memberships as $key => $value) 
        {
            $obj = new stdClass;
            $obj->type = '会員募集';
            $obj->id =  $value['id'];
            $obj->subject = $value['organizer'];
            $obj->date = \Carbon\Carbon::parse($value['created_at'])->format('Y-m-d');

            array_push($newEvents, $obj);
        }


        //$newVolunteers = [];
        foreach ($volunteers as $key => $value) 
        {
            $obj = new stdClass;
            $obj->type = 'ボランティア情報';
            $obj->id =  $value['id'];
            $obj->subject = $value['subject'];
            $obj->date = \Carbon\Carbon::parse($value['created_at'])->format('Y-m-d');

            array_push($newEvents, $obj);
        }

        
        usort($newEvents, function($a, $b)
        {
            return strcmp($b->date, $a->date);
        });


        //$mergedData = $events->merge($volunteers)->sortByDesc('created_at');

        //$mergedData = $events->merge($volunteers)->merge($memberships)->sortByDesc('created_at');



        return Response::json(['data' => $newEvents], 201);

        // $events = Event::select('id', 'subject')->get()->toArray();
        // $volunteers = Volunteer::select('id', 'subject')->get()->toArray();
        // $mergedData = array_merge($events, $volunteers);

        // Return collection of ActiveCenters as a resource
        //return NoticeResource::collection($mergedData, 10);
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
}
