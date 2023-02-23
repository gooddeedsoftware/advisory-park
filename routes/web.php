<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\User;
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

Route::get('cache',function () {
        
        Artisan::call('route:clear');
        Artisan::call('clear-compiled');
        Artisan::call('config:cache');
        Artisan::call('cache:clear');
        Artisan::call('optimize:clear');
        
        return "Cache is cleared";
    }
);


/*-------------------------Frontend Website Area----------------------------*/
// Login With Google

Route::get('google', [App\Http\Controllers\Auth\GoogleController::class,'redirectToGoogle']);
Route::get('google/callback', [App\Http\Controllers\Auth\GoogleController::class,'handleGoogleCallback']);

// Paytm Payment Gateway Integration

Route::post('paytm-payment',[App\Http\Controllers\PaytmController::class, 'paytmPayment'])->name('paytm.payment');
Route::post('paytm-callback',[App\Http\Controllers\PaytmController::class, 'paytmCallback'])->name('paytm.callback');
// Route::get('paytm-purchase',[App\Http\Controllers\PaytmController::class, 'paytmPurchase'])->name('paytm.purchase');


/*------Auth-----*/

Route::get('login',[App\Http\Controllers\Auth\AuthController::class,'login'])->name('login');
Route::post('login',[App\Http\Controllers\Auth\AuthController::class,'loginPost'])->name('login.post');

Route::get('register',[App\Http\Controllers\Auth\AuthController::class,'register'])->name('register');
Route::post('register',[App\Http\Controllers\Auth\AuthController::class,'registerPost'])->name('register.post');

Route::get('logout',[App\Http\Controllers\Auth\AuthController::class,'logout'])->name('logout');

Route::post('change-password', [App\Http\Controllers\Auth\AuthController::class, 'changePassword'])->name('change.password.post');
Route::get('forget-password', [App\Http\Controllers\Auth\AuthController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [App\Http\Controllers\Auth\AuthController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
   
Route::get('account/verify/{token}', [App\Http\Controllers\Auth\AuthController::class, 'verifyAccount'])->name('user.verify'); 


/* Switch User/Advisor */
Route::get('switch-type',function (Request $request) {
        
        $message = "";
        if($request->type == 'User'){
            \Session::put('type','Advisor');
            $message = "Switched to Advisor!";
        }
        elseif($request->type == 'Advisor'){
            \Session::put('type','User');
            $message = "Switched to User!";
        }
        return redirect()->back()->with('success',$message);
    }
);


/*Route::get('session-close/{id}',function (Request $request) {
        
        $user = User::find($request->id);
        
        if($user->is_active == 1){
            User::whereId($request->id)->update(['is_active' == 0]);
        }
        User::whereId($request->id)->update(['is_active' == 1]);
});*/


/*---Home--*/

Route::get('/',[App\Http\Controllers\HomeController::class,'index'])->middleware('auth.timeout');
Route::get('/',[App\Http\Controllers\HomeController::class,'index']);
Route::get('index',[App\Http\Controllers\HomeController::class,'index'])->name('index')->middleware('auth.timeout');
Route::get('index',[App\Http\Controllers\HomeController::class,'index'])->name('index');
Route::get('top-advisors',[App\Http\Controllers\HomeController::class,'topAdvisors'])->name('top_advisors');
Route::get('like',[App\Http\Controllers\HomeController::class,'like'])->name('like');
Route::post('comment',[App\Http\Controllers\HomeController::class,'comment'])->name('comment');
Route::get('save',[App\Http\Controllers\HomeController::class,'save'])->name('save');
Route::get('following',[App\Http\Controllers\HomeController::class,'following'])->name('following');
Route::get('follower',[App\Http\Controllers\HomeController::class,'follower'])->name('follower');
Route::get('check-status',[App\Http\Controllers\HomeController::class,'CheckStatus'])->name('check.status');
Route::get('account-setting',[App\Http\Controllers\HomeController::class,'accountSetting'])->name('account_setting');
Route::get('all-advisors',[App\Http\Controllers\HomeController::class,'allAdvisors'])->name('all.advisors');
Route::get('categories',[App\Http\Controllers\HomeController::class,'categories'])->name('categories');
Route::get('messages',[App\Http\Controllers\HomeController::class,'messages'])->name('messages'); 
Route::post('update-notification', [App\Http\Controllers\HomeController::class,'updateNotification'])->name('update.notification');
Route::post('interested-or-not', [App\Http\Controllers\HomeController::class,'interestedOrNot'])->name('interested_or_not');


Route::post('payment-request', [App\Http\Controllers\HomeController::class,'paymentRequest'])->name('payment.request');


/* Profile Info & Business Profile */
Route::get('profile',[App\Http\Controllers\ProfileController::class,'profile'])->name('profile');
Route::get('profile/{id}',[App\Http\Controllers\ProfileController::class,'userProfile'])->name('user_profile');
Route::post('profile-update',[App\Http\Controllers\ProfileController::class,'profileUpdate'])->name('profile.update');
Route::post('business-profile-create',[App\Http\Controllers\ProfileController::class,'businessProfileCreate'])->name('business-profile.create');
Route::get('business-profile-edit/{id}',[App\Http\Controllers\ProfileController::class,'businessProfileEdit'])->name('business-profile.edit');
Route::post('business-profile-update/{id}',[App\Http\Controllers\ProfileController::class,'businessProfileUpdate'])->name('business-profile.update');
Route::delete('business-profile-delete/{id}',[App\Http\Controllers\ProfileController::class,'businessProfileDelete'])->name('business-profile.delete');
Route::get('autocomplete', [App\Http\Controllers\ProfileController::class,'autocomplete'])->name('autocomplete');
Route::get('autocomplete-requirement', [App\Http\Controllers\ProfileController::class,'autocompleteRequirement'])->name('autocomplete.requirement');
Route::post('change-status',[App\Http\Controllers\ProfileController::class,'changeStatus'])->name('change_status');
Route::post('complain',[App\Http\Controllers\ProfileController::class,'complain'])->name('complain');

/* REQUIREMENTS */
Route::get('requirements',[App\Http\Controllers\RequirementController::class,'requirements'])->name('requirements');
Route::post('requirement-store',[App\Http\Controllers\RequirementController::class,'requirementStore'])->name('requirements.store');
Route::get('requirement-details/{slug}',[App\Http\Controllers\RequirementController::class,'requirementDetails'])->name('requirements_details');
Route::get('requirement-edit/{id}',[App\Http\Controllers\RequirementController::class,'requirementEdit'])->name('requirements.edit');
Route::post('requirement-update',[App\Http\Controllers\RequirementController::class,'requirementUpdate'])->name('requirements.update');
Route::delete('requirement-delete/{id}',[App\Http\Controllers\RequirementController::class,'requirementDelete'])->name('requirements.delete');

/* POSTS  */ 
Route::post('store-post',[App\Http\Controllers\PostController::class,'postStore'])->name('store.post');
Route::get('post-details/{slug}',[App\Http\Controllers\PostController::class,'postDetails'])->name('post_details');
Route::get('post-edit/{id}',[App\Http\Controllers\PostController::class,'postEdit'])->name('post.edit');
Route::post('post-update',[App\Http\Controllers\PostController::class,'postUpdate'])->name('post.update');
Route::delete('post-delete/{id}',[App\Http\Controllers\PostController::class,'postDelete'])->name('post.delete');

/* Advisory Send & Listing */
Route::post('send-re-request',[App\Http\Controllers\AdvisoryController::class,'SendAdvisoryReRequest'])->name('advisory.re_request');
Route::post('send-advisory-request',[App\Http\Controllers\AdvisoryController::class,'SendAdvisoryRequest'])->name('send_advisory_request');
Route::get('advisory',[App\Http\Controllers\AdvisoryController::class,'advisory'])->name('advisory');
Route::get('advisory/field',[App\Http\Controllers\AdvisoryController::class,'fieldWiseAdvisory'])->name('field-wise-advisory');
Route::get('advisory-details/{id}',[App\Http\Controllers\AdvisoryController::class,'advisoryDetail'])->name('advisory-details');
Route::post('advisory-listing-create',[App\Http\Controllers\AdvisoryController::class,'advisoryListingCreate'])->name('advisory-listing.create');
Route::get('advisory-listing-edit/{id}',[App\Http\Controllers\AdvisoryController::class,'advisoryListingEdit'])->name('advisory-listing.edit');
Route::post('advisory-listing-update/{id}',[App\Http\Controllers\AdvisoryController::class,'advisoryListingUpdate'])->name('advisory-listing.update');
Route::delete('advisory-listing-delete/{id}',[App\Http\Controllers\AdvisoryController::class,'advisoryListingDelete'])->name('advisory-listing.delete');



/*-------------------------Backend Admin Area----------------------------*/

    
Route::get('admin',[App\Http\Controllers\Admin\Auth\AuthController::class,'login']);

Route::get('admin/login',[App\Http\Controllers\Admin\Auth\AuthController::class,'login'])->name('admin.login');
Route::post('admin/login-post',[App\Http\Controllers\Admin\Auth\AuthController::class,'loginPost'])->name('admin.login.post');

Route::group(['prefix'=>'admin','middleware'=>'auth'],function(){
   
	Route::get('dashboard',[App\Http\Controllers\Admin\DashboardController::class,'dashboard'])->name('dashboard');
    Route::get('profile',[App\Http\Controllers\Admin\Auth\AuthController::class,'profile'])->name('admin.profile');
    Route::get('logout',[App\Http\Controllers\Admin\Auth\AuthController::class,'logout'])->name('admin.logout');
    
	//Category
	Route::get('categories',[App\Http\Controllers\Admin\CategoryController::class,'index'])->name('category');
	Route::get('categories/create',[App\Http\Controllers\Admin\CategoryController::class,'create'])->name('category.create');
	Route::post('categories/store',[App\Http\Controllers\Admin\CategoryController::class,'store'])->name('category.store');
	Route::get('categories/edit/{id}',[App\Http\Controllers\Admin\CategoryController::class,'edit'])->name('category.edit');
	Route::post('categories/update/{id}',[App\Http\Controllers\Admin\CategoryController::class,'update'])->name('category.update');
	Route::delete('categories/delete/{id}',[App\Http\Controllers\Admin\CategoryController::class,'delete'])->name('category.delete');

    //Skill
	Route::get('skills',[App\Http\Controllers\Admin\SkillController::class,'index'])->name('skill');
	Route::get('skills/create',[App\Http\Controllers\Admin\SkillController::class,'create'])->name('skill.create');
	Route::post('skills/store',[App\Http\Controllers\Admin\SkillController::class,'store'])->name('skill.store');
	Route::get('skills/edit/{id}',[App\Http\Controllers\Admin\SkillController::class,'edit'])->name('skill.edit');
	Route::post('skills/update/{id}',[App\Http\Controllers\Admin\SkillController::class,'update'])->name('skill.update');
	Route::delete('skills/delete/{id}',[App\Http\Controllers\Admin\SkillController::class,'delete'])->name('skill.delete');
    
    //Tag
	Route::get('tags',[App\Http\Controllers\Admin\TagController::class,'index'])->name('tag');
	Route::get('tags/create',[App\Http\Controllers\Admin\TagController::class,'create'])->name('tag.create');
	Route::post('tags/store',[App\Http\Controllers\Admin\TagController::class,'store'])->name('tag.store');
	Route::get('tags/edit/{id}',[App\Http\Controllers\Admin\TagController::class,'edit'])->name('tag.edit');
	Route::post('tags/update/{id}',[App\Http\Controllers\Admin\TagController::class,'update'])->name('tag.update');
	Route::delete('tags/delete/{id}',[App\Http\Controllers\Admin\TagController::class,'delete'])->name('tag.delete');
	
	//Field(Sector)
	Route::get('fields',[App\Http\Controllers\Admin\FieldController::class,'index'])->name('field');
	Route::get('fields/create',[App\Http\Controllers\Admin\FieldController::class,'create'])->name('field.create');
	Route::post('fields/store',[App\Http\Controllers\Admin\FieldController::class,'store'])->name('field.store');
	Route::get('fields/edit/{id}',[App\Http\Controllers\Admin\FieldController::class,'edit'])->name('field.edit');
	Route::post('fields/update/{id}',[App\Http\Controllers\Admin\FieldController::class,'update'])->name('field.update');
	Route::delete('fields/delete/{id}',[App\Http\Controllers\Admin\FieldController::class,'delete'])->name('field.delete');
    
	
	 //Users
	Route::get('users',[App\Http\Controllers\Admin\UsersController::class,'index'])->name('users');
	Route::get('users/create',[App\Http\Controllers\Admin\UsersController::class,'create'])->name('users.create');
	Route::post('users/store',[App\Http\Controllers\Admin\UsersController::class,'store'])->name('users.store');
	Route::get('users/edit/{id}',[App\Http\Controllers\Admin\UsersController::class,'edit'])->name('users.edit');
	Route::post('users/update/{id}',[App\Http\Controllers\Admin\UsersController::class,'update'])->name('users.update');
	Route::delete('users/delete/{id}',[App\Http\Controllers\Admin\UsersController::class,'delete'])->name('users.delete');
	
	//(Requirements in admin)
	Route::get('requirements',[App\Http\Controllers\Admin\ReqController::class,'index'])->name('req');
	Route::get('requirements/create',[App\Http\Controllers\Admin\ReqController::class,'create'])->name('req.create');
	Route::post('requirements/store',[App\Http\Controllers\Admin\ReqController::class,'store'])->name('req.store');
	Route::get('requirements/edit/{id}',[App\Http\Controllers\Admin\ReqController::class,'edit'])->name('req.edit');
	Route::post('requirements/update/{id}',[App\Http\Controllers\Admin\ReqController::class,'update'])->name('req.update');
	Route::delete('requirements/delete/{id}',[App\Http\Controllers\Admin\ReqController::class,'delete'])->name('req.delete');
    
    
    //Reports
	Route::get('advisory-report',[App\Http\Controllers\Admin\ReportController::class,'advisoryReport'])->name('advisory.report');
	Route::get('payment-report',[App\Http\Controllers\Admin\ReportController::class,'paymentReport'])->name('payment.report');

    //Payment Request 
    // Route::get('payment-request/list', [App\Http\Controllers\Admin\PaymentController::class,'paymentRequestList'])->name('payment.request.list');
    Route::post('request-change', [App\Http\Controllers\Admin\PaymentController::class,'requestChange'])->name('request.change');

    // Route::post('advisor-payment', [App\Http\Controllers\Admin\PaymentController::class,'advisorPayment'])->name('advisor.payment');
    Route::get('advisor-payments-list', [App\Http\Controllers\Admin\PaymentController::class,'advisorPaymentList'])->name('advisor.payment.list');
    
    Route::get('advisor-pay',[App\Http\Controllers\Admin\PaymentController::class, 'advPay'])->name('adv.payment');
    Route::post('advisor-pay-callback',[App\Http\Controllers\Admin\PaymentController::class, 'advPayCallback'])->name('adv.pay.callback');
    
    Route::get('success-payment',[App\Http\Controllers\Admin\PaymentController::class, 'advPaySuccessPage'])->name('adv.pay.success');
    Route::get('fail-payment',[App\Http\Controllers\Admin\PaymentController::class, 'advPayFailPage'])->name('adv.pay.fail');

    
});


