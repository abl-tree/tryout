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
        $config['places'] = true;
        $config['zoom'] = '16';
        $config['scrollwheel'] = false;
        GMaps::initialize($config);

        $sales = Sale::with("seller")->get();

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
