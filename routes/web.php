<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;

// Route::get('/', function () {
//     return view('welcome');
// });


// Front page APIs
Route::get('/', [PageController::class, 'homePage']);
Route::get('/contactPage', [PageController::class, 'contactPageShow']);
Route::get('/blogPage', [PageController::class, 'blogPageShow']);
Route::get('/aboutPage', [PageController::class, 'aboutPageShow']);
Route::get('/singlePost', [PageController::class, 'singlePostShow']);





// Auth front page APIs
Route::get('/userLogin', [PageController::class, 'userLoginPage']);
Route::get('/userRegister', [PageController::class, 'userRegisterPage']);
Route::get('/otpSend', [PageController::class, 'otpSendPage']);
Route::get('/otpVerify', [PageController::class, 'otpVerifyPage']);
Route::get('/resetPassword', [PageController::class, 'resetPasswordPage'])->middleware([AuthMiddleware::class]);

// Dashboard  Front APIs
Route::get('/dashboard', [PageController::class, 'dashboardPage'])->middleware([AuthMiddleware::class]);
Route::get('/userProfile', [PageController::class, 'userProfilePage'])->middleware([AuthMiddleware::class]);
Route::get('/allPosts', [PageController::class, 'allPostPage'])->middleware([AuthMiddleware::class]);
Route::get('/addNewPosts', [PageController::class, 'addNewPostsPage'])->middleware([AuthMiddleware::class]);
Route::get('/updatePosts', [PageController::class, 'updatePostsPage'])->middleware([AuthMiddleware::class]);
Route::get('/categoryPage', [PageController::class, 'categoryPageShow'])->middleware([AuthMiddleware::class]);
Route::get('/tagPage', [PageController::class, 'tagPageShow'])->middleware([AuthMiddleware::class]);
Route::get('/allUsers', [PageController::class, 'allUserShowPage'])->middleware([AuthMiddleware::class]);






// Auth AJAX APIs 
Route::post('/user-register', [UserController::class, 'userRegister']);
Route::post('/user-login', [UserController::class, 'userLogin']);
Route::post('/send-otp', [UserController::class, 'OTPSending']);
Route::post('/verify-otp', [UserController::class, 'OTPVerifying']);
Route::post('/reset-password', [UserController::class, 'resetPassword'])->middleware([AuthMiddleware::class]);
Route::get('/user-info', [UserController::class, 'userInfoAction'])->middleware([AuthMiddleware::class]);
Route::post('/user-info-update', [UserController::class, 'userInfoUpdate'])->middleware([AuthMiddleware::class]);
Route::get('/all-users', [UserController::class, 'getAllUsers']);  
Route::get('/user-delete/{id}', [UserController::class, 'userDelete']);
Route::get('/logout', [UserController::class, 'userLogout']);




// Post AJAX APIs
Route::get('/all-post-show', [PostController::class, 'allPostShow']);
Route::get('/all-post-dash', [PostController::class, 'allPostBackend']);
Route::get('/post-by-user', [PostController::class, 'postShowByUser'])->middleware([AuthMiddleware::class]);
Route::get('/post-by-id/{id}', [PostController::class, 'postShowById'])->middleware([AuthMiddleware::class]);
Route::post('/post-create', [PostController::class, 'postCreate'])->middleware([AuthMiddleware::class]);
Route::post('/post-update', [PostController::class, 'postUpdate'])->middleware([AuthMiddleware::class]);
Route::post('/post-delete', [PostController::class, 'postDelete'])->middleware([AuthMiddleware::class]);
Route::get('/post-single/{id}', [PostController::class, 'postSingle']);




// Category Ajax APIs
Route::get('/category-show', [CategoryController::class, 'categoryShows'])->middleware([AuthMiddleware::class]);
Route::post('/category-create', [CategoryController::class, 'categoryCreate'])->middleware([AuthMiddleware::class]);
Route::post('/category-update', [CategoryController::class, 'categoryUpdate'])->middleware([AuthMiddleware::class]);
Route::post('/category-delete', [CategoryController::class, 'categoryDelete'])->middleware([AuthMiddleware::class]);
Route::get('/category-by-id/{id}', [CategoryController::class, 'categoryById'])->middleware([AuthMiddleware::class]);

// Tag Ajax APIs
Route::get('/tag-show', [TagController::class, 'tagShows'])->middleware([AuthMiddleware::class]);
Route::post('/tag-create', [TagController::class, 'tagCreate'])->middleware([AuthMiddleware::class]);
Route::post('/tag-update', [TagController::class, 'tagUpdate'])->middleware([AuthMiddleware::class]);
Route::post('/tag-delete', [TagController::class, 'tagDelete'])->middleware([AuthMiddleware::class]);
Route::get('/tag-by-id/{id}', [TagController::class, 'tagById'])->middleware([AuthMiddleware::class]);



// Slider APIs
Route::get('/slider-show', [PageController::class, 'sliderShowPage']);


