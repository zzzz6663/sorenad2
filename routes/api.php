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


Route::any('/test', 'ApiController@test')->name('test');


// Route::post('/test', function (Request $request) {


//     // return $request->user();
// });
