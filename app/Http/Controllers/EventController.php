<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Http\Resources\EventResource;
class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get Events
        $events = Event::orderBy('created_at', 'desc')->Where('deactivate', 0)->paginate(10);

        // Return collection of Events as a resource
        return EventResource::collection($events);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $event = $request->isMethod('put') ? Event::findOrFail($request->id) : new Event;

        $event->subject = $request->input('subject');
        $event->activity_category = $request->input('activity_category');
        $event->children = $request->input('children');
        $event->event_start_date = $request->input('event_start_date');
        $event->event_end_date = $request->input('event_end_date');
        $event->start_date = $request->input('start_date');
        $event->end_date = $request->input('end_date');
        $event->datetime = $request->input('datetime');
        $event->organizer = $request->input('organizer');
        $event->file = $request->input('file');
        $event->deadline = $request->input('deadline');
        $event->venue = $request->input('venue');
        $event->capacity = $request->input('capacity');
        $event->target = $request->input('target');
        $event->how_to_apply = $request->input('how_to_apply');
        $event->cost = $request->input('cost');
        $event->detail = $request->input('detail');
        $event->url = $request->input('url');
        $event->phone = $request->input('phone');
        $event->deactivate = $request->input('deactivate');
        $event->created_by = $request->input('created_by');
        $event->updated_by = $request->input('updated_by');
        if($event->save()) {
            return new EventResource($event);
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
        // Get Events
        $event = Event::findOrFail($id);

        // Return single Events as a resource
        return new EventResource($event);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get Events
        $event = Event::findOrFail($id);

        if($event->delete()) {
            return new EventResource($event);
        }    
    }

    public function getEventData(Request $request)
    {
         // Get Events
         $events;
         $type = $request->input('type');
         $search = $request->input('search');
         switch ($type) 
         {
             # All type
             case '0':
                 $events = Event::Where('title', 'like', '%' . $search . '%')
                             ->orderBy('created_at', 'desc')->paginate(10);
                 break;
             # Running type
             case '1':
                 $events = Event::Where('title', 'like', '%' . $search . '%')
                             ->whereDate('start_date', '<=', date("Y-m-d"))
                             ->whereDate('end_date', '>=', date("Y-m-d"))
                             ->orderBy('created_at', 'desc')->paginate(10);
                 break;
             # Future type
             case '2':
                 $events = Event::Where('title', 'like', '%' . $search . '%')
                     ->whereDate('start_date', '>', date("Y-m-d"))
                     ->orderBy('created_at', 'desc')->paginate(10);
                 break;
             # Previous type
             case '3':
                 $events = Event::Where('title', 'like', '%' . $search . '%')
                     ->whereDate('end_date', '<', date("Y-m-d"))
                     ->orderBy('created_at', 'desc')->paginate(10);
                 break;
         }
 
         // Return collection of Events as a resource
         return EventResource::collection($events);
    }
}
