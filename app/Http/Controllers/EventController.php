<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Http\Requests;
use Response;
use DateTime;
use Illuminate\Validation\Validator;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function formatDateToView($date) {
        $dateFormat = new DateTime($date);
        return date_format($dateFormat, 'Y-m-d H:i:s');
    }

    public function change_date_format_fullcalendar($date)
    {
        $time = DateTime::createFromFormat('Y-m-d H:i:s', $date);
        return $time->format('d/m/Y H:i:s');
    }

    public function format_interval(\DateInterval $interval)
    {
        $result = "";
        if ($interval->y) { $result .= $interval->format("%y year(s) "); }
        if ($interval->m) { $result .= $interval->format("%m month(s) "); }
        if ($interval->d) { $result .= $interval->format("%d day(s) "); }
        if ($interval->h) { $result .= $interval->format("%h hour(s) "); }
        if ($interval->i) { $result .= $interval->format("%i minute(s) "); }
        if ($interval->s) { $result .= $interval->format("%s second(s) "); }
        
        return $result;
    }

    public function index()
    {
        $data = [
            'page_title' => 'Events',
            'events'     => Event::orderBy('start_time')->get(),
        ];

        return view('events.index', $data);
    }

    public function listEvents()
    {
        $data = [
            'page_title' => 'Events',
            'events'     => Event::orderBy('start_time')->get(),
        ];

        return view('events.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addForm()
    {
        return view('events.addEventForm');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        // Customize validation messages
        $messages = [
            'event-title.required' => 'The title field is required.',
            'event-body.required' => 'The description field is required.',
            'event-dates.required' => 'The dates field is required.'
        ];

        // Validation rules
        $rules = [
            'event-title' => 'required|min:5|max:100',
            'event-body' => 'required|min:5|max:100',
            'event-dates' => 'required'
        ];

        // Make validation
        $this->validate($request, $rules, $messages);
        
        $time = explode(" - ", $request->input('event-dates'));

        $event                  = new Event;
        $event->title           = $request->input('event-title');
        $event->description     = $request->input('event-body');
        $event->start_time      = $this->formatDateToView($time[0]);
        $event->end_time        = $this->formatDateToView($time[1]);
        $event->color           = $request->input('event-color');
        $event->save();

        // Create success flag
        $flag = true;

        return view('events.addEventForm', compact('flag'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::findOrFail($id);
        
        $first_date = new DateTime($event->start_time);
        $second_date = new DateTime($event->end_time);
        $difference = $first_date->diff($second_date);
        $data = [
            'page_title'    => $event->title,
            'event'         => $event,
            'duration'      => $this->format_interval($difference)
        ];

        return view('events.showEvent', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editForm($id)
    {   
        $event = Event::findOrFail($id);
        $event->start_time =  $this->change_date_format_fullcalendar($event->start_time);
        $event->end_time =  $this->change_date_format_fullcalendar($event->end_time);
        
        $data = [
            'page_title'    => 'Edit '.$event->title,
            'event'         => $event,
        ];

        return view('events.editEventForm', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        // Customize validation messages
        $messages = [
            'event-title.required' => 'The title field is required.',
            'event-body.required' => 'The description field is required.',
            'event-dates.required' => 'The dates field is required.'
        ];

        // Validation rules
        $rules = [
            'event-title' => 'required|min:5|max:100',
            'event-body' => 'required|min:5|max:100',
            'event-dates' => 'required'
        ];

        // Make validation
        $this->validate($request, $rules, $messages);
        
        $time = explode(" - ", $request->input('event-dates'));
        $title = $request->input('event-title');
        $description = $request->input('event-body');
        $color = $request->input('event-color');
        $start_time = $this->formatDateToView($time[0]);
        $end_time = $this->formatDateToView($time[1]);

        $event = Event::findOrFail($id);

        if($event->description == $description && $event->title == $title && $event->color == $color && $event->start_time == $start_time && $event->end_time == $end_time) {
            // Create alert message to flash back to session
            $result = 'Article information remains unchanged!';
            $alert_type = 'warning';
        } else {
            $event->description     = $description;
            $event->title           = $title;
            $event->color           = $color;
            $event->start_time      = $start_time;
            $event->end_time        = $end_time;
            $event->save();

            // Create alert message to flash back to session
            $result = 'Event information successfully updated!';
            $alert_type = 'success';
        }
        $event = Event::findOrFail($id);
        $event->start_time =  $this->change_date_format_fullcalendar($event->start_time);
        $event->end_time =  $this->change_date_format_fullcalendar($event->end_time);
        
        return view('events.editEventForm', compact('event', 'result', 'alert_type'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $event = Event::find($id);
        $event->delete();
          
        return redirect('events');
    }
}
