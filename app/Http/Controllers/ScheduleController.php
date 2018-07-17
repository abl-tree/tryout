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
        $schedule = Schedule::with('customer', 'property.seller')->orderBy('sched_date', 'asc')->get();

        return view('schedule')->with(['schedules' => $schedule]);
    }

    public function schedule(Request $request) {
        Validator::make($request->all(), [
            'sched' => 'required',
            'prop_id' => 'required',
        ])->validate();
        
        $response = array();
        $schedule = new Schedule;
        
        $exists = $schedule->where(['prop_id' => $request->prop_id, 'customer_id' => Auth::id()])->first();
        
        if(!$exists){
            $schedule->prop_id = $request->prop_id;
            $schedule->customer_id = Auth::id();
            $schedule->sched_date = Carbon::parse($request->sched);
            $schedule->save();
        } else {
            $response = array('status' => 'error', 'message' => 'You have been scheduled for this property.', 'title' => 'Try another property');
            echo json_encode($response);
            return;
        }

        if($schedule) {
            $response = array('status' => 'success', 'message' => 'Property has been scheduled.', 'title' => 'Set!');
            echo json_encode($response);
        } else {
            echo json_encode(false);
        }
    }
}
