<?php

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
// use App\Ticket;
// use App\Reply;
// use App\User;
// Route::get('/test-customer-confirmation-email', function() {

// 	return new App\Mail\CustomerConfirmationEmail(Ticket::first());
// });
// Route::get('/test-confirmation-email', function() {

// 	return new App\Mail\Confirmationemail(Ticket::first());
// });
// Route::get('/test-reply-email', function() {

// 	return new App\Mail\ReplyEmail(Reply::first());
// });

// Route::get('/test-bevestig-email', function() {

// 	return new App\Mail\SendEmailToUser(User::find(4));
// });


// Route::name('pdf')->get('/pdf-generate','PdfController@PDFgenerate');
Route::name('pdf')->get('/pdf-generate/{quotation}', 'GenerateQuotationAndInvoice@makeQuotation');
Route::get('/quotation', 'QuotationController@index');

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', 'HomeController@index')->name('home');
