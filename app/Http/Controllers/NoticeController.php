<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Volunteer;
use App\Membership;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Resources\NoticeResource;
use Illuminate\Pagination\Paginator;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get ActiveCenters
        $events = Event::select('id', 'subject')->get();
        $volunteers = Volunteer::select('id', 'subject')->get();
        $memberships = Membership::select('id', 'organizer')->get();
        $mergedData = $events->merge($volunteers)->merge($memberships)->sortByDesc('id');

        // $events = Event::select('id', 'subject')->get()->toArray();
        // $volunteers = Volunteer::select('id', 'subject')->get()->toArray();
        // $mergedData = array_merge($events, $volunteers);

        // Return collection of ActiveCenters as a resource
        return NoticeResource::collection($mergedData, 10);
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
