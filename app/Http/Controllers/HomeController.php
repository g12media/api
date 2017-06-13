<?php

namespace App\Http\Controllers;
use App\User;
use App\Category;
use App\Video;
use App\Audio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function getCategories(){
      return Category::all();
    }

    public function getVideosByCategory($categoryId){
      return Video::where('categoryId',$categoryId)->get();
    }


    public function redirectURL(){

      if(Auth::user()){
        $userType = Auth::user()->userType;

        if($userType == "admin"){
            return redirect("/admin");
        }else if($userType == "user"){
            return redirect("/user");
        }else{
            return redirect("/logout");
        }
      }else{
        return redirect("pailan");
      }



  }

}
