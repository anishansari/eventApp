<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Events::query();
        if ($request->sort == 'asc' || $request->sort == 'desc') {
            $query->orderBy('start_date', $request->sort);
        }

        if ($request->filter == 'finished') {
            $query->whereDate('start_date', '<', today())->whereDate('end_date', '<', today())->paginate(20);
        }

        if ($request->filter == 'upcoming') {
            $query->whereDate('start_date', '>=', today())->paginate(20);
        }
        if ($request->filter == 'finished_last') {
            $date = Carbon::now()->subDays(7);
            $query->whereDate('end_date', $date)->paginate(20);
        }
        if ($request->filter == 'upcoming_within') {
            $date = Carbon::now()->addDays(7);
            $query->whereDate('start_date', $date)->paginate(20);
        }

        $data['events'] = $query->paginate(20);
        return view('event.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('event.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'start_date' => 'required|date_format:Y-m-d|after_or_equal:today',
            'end_date' => 'required|date_format:Y-m-d|after_or_equal:today',
            'from_time' => 'required|date_format:H:i',
            'to_time' => 'required|date_format:H:i|after:from_time',
            'status' => 'required',
        ]);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'from_time' => $request->from_time,
            'to_time' => $request->to_time,
            'status' => $request->status,
        ];
        Events::insert($data);
        Session::flash('success_message', 'Event Created!');
        return redirect('/');

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$id) {
            Session::flash('error_message', 'Something Went wrong!');
            return redirect('/');
        }
        $event = Events::find($id);
        if ($event) {
            $data['event'] = $event;
            return view('event.view', $data);
        }
        Session::flash('error_message', 'Event Not Found!');
        return redirect('/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$id) {
            Session::flash('error_message', 'Something Went wrong!');
            return redirect('/');
        }
        $event = Events::find($id);
        if ($event) {
            $data['event'] = $event;
            return view('event.edit', $data);
        }
        Session::flash('error_message', 'Event Not Found!');
        return redirect('/');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!$id) {
            Session::flash('error_message', 'Something Went wrong!');
            return redirect('/');
        }
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'start_date' => 'required|date_format:Y-m-d|after_or_equal:today',
            'end_date' => 'required|date_format:Y-m-d|after_or_equal:today',
            'from_time' => 'required|date_format:H:i',
            'to_time' => 'required|date_format:H:i|after:from_time',
            'status' => 'required',
        ]);

        $event = Events::find($id);
        if ($event) {
            $data = [
                'title' => $request->title,
                'description' => $request->description,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'from_time' => $request->from_time,
                'to_time' => $request->to_time,
                'status' => $request->status,
            ];
            Events::where('id', $id)->update($data);
            Session::flash('success_message', 'Event Updated!');
            return redirect('/');
        }
        Session::flash('error_message', 'Event Not Found!');
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$id) {
            Session::flash('error_message', 'Something Went wrong!');
            return redirect('/');
        }
        $event = Events::find($id);
        if ($event) {
            $event->delete();

            $events = \App\Models\Events::orderBy('start_date', 'ASC')->get();
            $html = '';
            $count = 1;
            if ($events) {
                foreach ($events as $event) {
                    $html .= '<tr><td>' . $count++ . '</td>';
                    $html .= '<td>' . $event->title . '</td>';
                    $html .= '<td>' . $event->description . '</td>';
                    $html .= '<td>' . $event->start_date . '</td>';
                    $html .= '<td>' . $event->end_date . '</td>';
                    $html .= '<td>' . $event->from_time . '</td>';
                    $html .= '<td>' . $event->to_time . '</td>';
                    $html .= '<td>' . $event->status . '</td>';
                    $html .= '<td><a class="btn btn-secondary" href="' . route('event.edit', $event->id) . '">Edit</a> <a class="btn btn-danger delete" href="#" data-id="' . $event->id . '"> Delete</a></td>';
                    $html .= '</tr>';
                }
            }
            return response()->json($html);
        }
        Session::flash('error_message', 'Event Not Found!');
        return redirect('/');

    }
}
