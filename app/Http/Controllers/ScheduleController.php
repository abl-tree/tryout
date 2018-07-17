<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schedule;
use Validator;
use Auth;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $schedule = Schedule::with('customer', 'property.seller')->get();

        return view('schedule')->with(['schedules' => $schedule]);
    }

    public function schedule(Request $request) {
        Validator::make($request->all(), [
            'sched' => 'required',
            'prop_id' => 'required',
        ])->validate();
        
        $schedule = new Schedule;
        $schedule->prop_id = $request->prop_id;
        $schedule->customer_id = Auth::id();
        $schedule->sched_date = Carbon::parse($request->sched);
        $schedule->save();

        if($schedule) {
            echo json_encode(true);
        } else {
            echo json_encode(false);
        }
    }
}
