<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;

class PageController extends Controller
{

    public function homePage(){
        return view('pages.public.home-page');
    }

    
    // User Login page
    public function userLoginPage(Request $request){
        return view('pages.admin.auth.login-page');
    }

    public function userRegisterPage(Request $request){
        return view('pages.admin.auth.register-page');
    }

    public function otpSendPage(Request $request){
        return view('pages.admin.auth.otp-send-page');
    }

    public function otpVerifyPage(Request $request){
        return view('pages.admin.auth.otpverify-page');
    }

    public function resetPasswordPage(Request $request){
        return view('pages.admin.auth.password-reset-page');
    }

    public function dashboardPage(Request $request){
        return view('pages.admin.dashboard.summary-page');
    }

    public function userProfilePage(Request $request){
        return view('pages.admin.dashboard.profile-page');
    }

    public function allPostPage(Request $request){
        return view('pages.admin.dashboard.posts-page');
    }

    public function categoryPageShow(Request $request){
        return view('pages.admin.dashboard.category-page');
    }

    public function tagPageShow(Request $request){
        return view('pages.admin.dashboard.tag-page');
    }

    public function addNewPostsPage(Request $request){
        return view('pages.admin.dashboard.new-post-page');
    }

    public function updatePostsPage(Request $request){
        return view('pages.admin.dashboard.update-post-page');
    }

    public function allUserShowPage(Request $request){
        return view('pages.admin.dashboard.users-page');
    }


    
    public function contactPageShow(){
        return view('pages.public.contact-page');
    }
    

    public function aboutPageShow(){
        return view('pages.public.about-page');
    }


    public function blogPageShow(){
        return view('pages.public.blog-page');
    }



    public function singlePostShow(){
        return view('pages.public.single-post-page');
    }




    public function sliderShowPage(Request $request){
        $slider = Slider::all();

        return response()->json([
            'status'    => 'success',
            'sliders'   => $slider
        ]);
    }

    
    

    

    
}
