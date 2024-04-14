<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DragDropController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\HighchartController;
use App\Http\Controllers\ImageUploadController;
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

Route::view('showdiv', 'hideshowdiv');

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
Route::get('/employee/pdf', [PDFreportController::class, 'createpdf']);
Route::get('send-email-pdf', [PDFreportController::class, 'sendmail']);


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


Route::get('browsescreenshot',[TestController::class,'screenshot']);


Route::get('barcode', 'App\Http\Controllers\BarcodeController@index')->name('home.index');

##############image upload starts here #########
Route::get('indeximage',[ImageUploadController::class, 'index']);
Route::post('image-upload',[ImageUploadController::class, 'upload'])->name('image-upload');
#########till here image upload ############

############# India Map Highchart###########
Route::get('india-map',[HighchartController::class,'indiamap']);
Route::get('user-status',[HighchartController::class,'handleChart']);
########### till here google map highchart #############

###################drag and drop image file in laravel #######
Route::get('drag-drop-form', [DragDropController::class, 'form']);
Route::post('uploadfiles', [DragDropController::class,'uploadFiles']);

Route::get('sidebar',[TestController::class,'sidebar']);


### typeahed js autocomplete search   ##############
Route::get('formauto', [TestController::class, 'index']);
Route::get('search-autocomplete', [TestController::class, 'searchAutocomplete']);
Route::get('address', [TestController::class, 'address']);
###############  till here #################

################## till here drag and drop image file #############
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
