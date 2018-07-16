<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GMaps;
use Validator;
use App\Sale;
use Auth;

class SellController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $config = array();
        $config['center'] = 'Davao City, Philippines';
        $config['zoom'] = '18';
        $config['scrollwheel'] = false;
        GMaps::initialize($config);
        
        $marker['draggable'] = true;  
        $marker['position'] = 'Davao City, Philippines';  
        $marker['ondrag'] = 'getLatLong(event)';  
        GMaps::add_marker($marker);

        $map = GMaps::create_map();

        return view('sell')->with('map', $map);
    }

    public function sell(Request $request) {
        Validator::make($request->all(), [
            'price' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ])->validate();

        $sale = new Sale;
        $sale->latitude = $request->latitude;
        $sale->longitude = $request->longitude;
        $sale->price = $request->price;
        $sale->seller_id = Auth::id();
        $sale->save();

        if($sale) {
            echo json_encode(true);
        } else {
            echo json_encode(false);
        }
    }
}
