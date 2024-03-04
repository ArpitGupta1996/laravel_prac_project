<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\OpenAIController;
use App\Http\Controllers\PDFreportController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\WhatsAppController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::resource('users', UserController::class);


Route::resource('form',FormController::class);
Route::get('navbar-page', [FormController::class,'navbar']);

##########  Upload Video ##################
Route::get('upload-video', [VideoController::class,'uploadedvideo']);
Route::post('uploadVideo',[VideoController::class,'uploadVideo']);
###############till here upload video ##############


########## Twilio Account ##############
Route::get('whatsapp',[WhatsAppController::class,'index']);
Route::post('whatsapp',[WhatsAppController::class,'store'])->name('whatsapp.post');
########## Till here Twilio Account ########

########## For PDF Report start here ############
Route::get('pdf',[PDFreportController::class,'index']);
######### till here PDF report ################

#####open AI ###
Route::get('open-ai', [OpenAIController::class, 'index']);


##### Contact Form #########
Route::resource('contact',ContactController::class);
###### till here contact form ####


############ Blog Routes Start here #########
Route::resource('blog', BlogController::class);
Route::post('blog-detail', [BlogController::class,'detail']);
########### till here blog route ############

#########ip######
Route::get('/ip',[TestController::class,'ip']);
###till here ip###

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
