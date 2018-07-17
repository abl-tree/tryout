<?php

use Illuminate\Http\Request;
use App\Http\Resources\SaleCollection;
use App\Sale;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/sales/search', function(Request $request){
    $query = $request->q;

    if(!$query) {
        return null;
    }

    $sales = Sale::where('address', 'like','%'.$query.'%')
        ->where('address', 'like','%Davao%')
        ->get();
        
    return response()->json($sales);
});
