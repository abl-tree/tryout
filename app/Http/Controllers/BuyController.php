<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GMaps;
use App\Sale;
use Validator;

class BuyController extends Controller
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
    public function index(Request $request)
    {
        $sales = array();
        $config = array();
        $config['places'] = true;
        $config['scrollwheel'] = false;

        if($propid = $request->id) {
            Validator::make($request->all(), [
                'id' => 'required|exists:sales',
            ])->validate();

            $sales = Sale::with("seller")->where('id', $propid)->get();

            $location = $sales[0]->latitude.", ".$sales[0]->longitude;
            $config['center'] = $location;
            $config['zoom'] = '20';
        } else {
            return redirect('home');
        }

        GMaps::initialize($config);

        if($sales)
        foreach ($sales as $key => $value) {
            $location = $value->latitude.", ".$value->longitude;
            $marker['title'] = "For sale";
            $marker['position'] = $location;
            $marker['infowindow_content'] = "Php".number_format($value->price,2,".",",")." <br /> Contact: ".$value->seller->email;
            GMaps::add_marker($marker);
        }
        
        $map = GMaps::create_map();

        return view('buy')->with(['map' => $map, 'props' => $sales]);
    }
}
