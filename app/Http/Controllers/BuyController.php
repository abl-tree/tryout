<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GMaps;
use App\Sale;

class BuyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
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
            $sales = Sale::with("seller")->where('id', $propid)->get();
            $location = $sales[0]->latitude.", ".$sales[0]->longitude;
            $config['center'] = $location;
            $config['zoom'] = '20';
        } else {
            $config['center'] = 'Davao City, Philippines';
            $config['zoom'] = '14';
            $sales = Sale::with("seller")->get();
        }

        GMaps::initialize($config);

        foreach ($sales as $key => $value) {
            $location = $value->latitude.", ".$value->longitude;
            $marker['title'] = "For sale";
            $marker['position'] = $location;
            $marker['infowindow_content'] = "Php".number_format($value->price,2,".",",")." <br /> Contact: ".$value->seller->email;
            GMaps::add_marker($marker);
        }
        
        $map = GMaps::create_map();

        return view('buy')->with('map', $map);
    }

    public function test() {        
        $config = array();
        $config['places'] = true;
        $config['placesLocation'] = "Davao City";
        $config['placesRadius'] = 500;
        $config['placesName'] = "Davao City";
        $config['zoom'] = '16';
        $config['scrollwheel'] = false;
        GMaps::initialize($config);

        $map = GMaps::create_map();

        echo $map['html'];
        echo $map['js'];
    }
}
