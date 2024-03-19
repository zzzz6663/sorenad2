<?php

use App\Models\Advertise;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return response()->json([
//         'status'=>"ok"
//     ]);
//     // return $request->user();
// });

Route::post('/test', function (Request $request) {
    $css = response()->make(asset('/css/css_add.css'));
    $css = asset('/css/css_add.css');
    $domin=$request->domin;
    $app=("admin.add_temp.app");
    $advertiser=Site::where('site', 'LIKE', "%{$domin}%")->first();
    $user=$advertiser->user;
    $advertis=Advertise::where('active', 1)->whereType("app")->where("confirm","!=","null")->whereStatus("ready_to_show")->first();
    // $css = ('/css/css_add.css');
    if($user->float_app){
        return response()->json([
            'all'=>$request->all(),
            'ip'=>$request->ip(),
            'css'=>$css,
            'status'=>"ok",
            'url'=>$request->getRequestUri(),
            'url2'=>$request->fullUrl(),
            'url3'=>$request->url(),
            'url4'=>$request->getHost(),
            'advertis'=>$advertis,
            'advertiser'=>$advertiser,
            'body' => view($app, compact(['advertis']))->render(),
        ]);
    }

    // return $request->user();
});
