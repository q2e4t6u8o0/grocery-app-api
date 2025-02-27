<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MediaController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if(@mysqli_connect(env("DB_HOST"), env("DB_USERNAME"), env("DB_PASSWORD"), env("DB_DATABASE"))) {
        if(setting("live")!="1"){
            return redirect(route("install.app"));
        }
	return view('welcome.index');
    }
	return redirect(route("install.app"));
// $data_fmc=[
// "title"=>"tes in th app",
// "message"=>"tes in th app",
// "image"=>null,
// "type"=>"home",
// "user_id"=>"1",
// ];

// return fmc($data_fmc);

    return view('welcome.index');
});

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' =>'media', 'middleware' => ['auth']], function(){
    Route::post('/upload', [MediaController::class, 'upload'])->name('media.upload');
    Route::post('/library', [MediaController::class, 'getMediaLibrary'])->name('media.library');
    Route::post('/delete', [MediaController::class, 'delete'])->name('media.delete');
    Route::post('/update/alt', [MediaController::class, 'update_alt'])->name('media.update.alt');
});

foreach(array("privacy_policy","terms_and_conditions","return_policy","contact_us","about_us") as $item){
    Route::get(str_replace('_','-',$item),function(){
		$head = '<!DOCTYPE html>
			<html lang="en">
				<head>
				<title>Bootstrap Example</title>
  				<meta charset="utf-8">
  				<meta name="viewport" content="width=device-width, initial-scale=1">
  				<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  				<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
  				<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  				<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
				</head>
				<body>
<div class="container">
				';
			$head .= setting(Route::currentRouteName());

			$head .= '
</div>
</body>
</html>';

return $head;
        return setting(Route::currentRouteName());
    })->name($item);
}


// Error page
Route::get('/404', function(){
    return view('error.404');
})->name('404');
