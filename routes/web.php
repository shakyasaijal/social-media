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

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();
Route::get('/welcome', 'HomeController@welcome')->name('welcome');
Route::get('/admin', 'Admin\DashboardController@getDashboard')->middleware('auth')->name('admin.dashboard');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'isAdmin:admin']], function () {
    Route::get('users', ['as' => 'users.index', 'uses' => 'UserController@index']);
    Route::get('users/create', ['as' => 'users.create', 'uses' => 'UserController@create']);
    Route::post('users', ['as' => 'users.store', 'uses' => 'UserController@store']);
    Route::get('users/edit/{id}', ['as' => 'users.edit', 'uses' => 'UserController@edit']);
    Route::put('users/{id}', ['as' => 'users.update', 'uses' => 'UserController@update']);
    Route::delete('users/{id}', ['as' => 'users.destroy', 'uses' => 'UserController@destroy']);

    /** Blog control routes */
      Route::get('blogs', ['as' => 'blog.index', 'uses' => 'BlogController@index']);
      Route::get('blogs/create', ['as' => 'blog.create', 'uses' => 'BlogController@create']);
      Route::post('blogs', ['as' => 'blog.store', 'uses' => 'BlogController@store']);
      Route::get('blogs/{id}/edit', ['as' => 'blog.edit', 'uses' => 'BlogController@edit']);
      Route::put('blogs/{id}/update', ['as' => 'blog.update', 'uses' => 'BlogController@update']);
      Route::delete('blogs/{id}/destroy', ['as' => 'blog.destroy', 'uses' => 'BlogController@destroy']);

    Route::get('blogs/{id}/publish', ['as' => 'blog.publish', 'uses' => 'BlogController@publish']);
    /*Route::resource('blogs','BlogController');*/

    /** Profile control routes */
    Route::get('profile/{user?}', ['as' => 'profile', 'uses' => 'UserController@profile']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'UserController@updateProfile']);
});



Route::group(['middleware' => ['auth'], 'as' => 'site.', 'namespace' => 'Guest'], function () {
    Route::get('/', 'GuestController@index')->name('index');
    Route::get('blogs', 'GuestController@getBlogs')->name('blog-list');
    Route::get('blog/create', 'GuestController@createBlog')->name('blog-create');
    Route::post('blogs', 'GuestController@postBlog')->name('blog-store');

    Route::get('blog/edit/{id}', 'GuestController@editBlog')->name('blog-edit');
    Route::put('blog/update/{id}', 'GuestController@updateBlog')->name('blog-update');
    Route::get('blog/delete/{id}', 'GuestController@deleteBlog')->name('blog-delete');
    Route::get('my-blogs', 'GuestController@myBlogs')->name('my-blog');
    Route::get('blog/{slug}', 'GuestController@getBlogDetails')->name('blog-detail');

    /** Chat*/
    Route::get('chat','ChatController@getFriends')->name('chat');
    Route::get('chat-with-friend/{friend_id}','ChatController@getMyFriend')->name('chat-with-friend');
});


Route::group(['namespace' => 'Admin\Api\V1', 'prefix' => 'api', 'middleware' => 'auth'], function () {

    Route::get('comments/{blog_id}', 'ApiController@getComments');
    Route::post('comment/store', 'ApiController@addNewComment');

    Route::get('like-dislike/{blog_id}', 'ApiController@totalLikeDislike');
    Route::post('like-dislike/{blog_id}', 'ApiController@postLikeDislike');

    Route::get('fetch-messages/{friend_id}','ApiController@fetchMessages');

    Route::get('selected-friend/{friend_id}','ApiController@getSelectedFriend');
    Route::get('user-details','ApiController@getAuthenticateUserDetails');
    Route::post('store-message','ApiController@storeMessage');
});

Route::get('search','HomeController@search');

Route::get('payment-with-paypal', array('as' => 'addmoney.paywithpaypal','uses' => 'PaymentController@createPayment',));
Route::post('paypal', array('as' => 'addmoney.paypal','uses' => 'PaymentController@makePayment',));
Route::get('paypal', array('as' => 'payment.status','uses' => 'PaymentController@status',));

Route::get('access-class','PaymentController@accessClass');


