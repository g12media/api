<?php

namespace App\Http\Controllers;

use App\User;
use App\Category;
use App\Video;
use App\Audio;
use DB,Image;
use App\FormControl;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AdminController extends Controller
{


      public function homeAdmin (){

        /*$users = DB::table('users as u')
        ->join('FormControl as fc', 'u.id', '=', 'fc.userId')
        ->select('fc.C_I_producer_id','u.name','fc.W_C_exp_date','fc.status','u.id')
        ->where('u.userType', '=', 'user')
        ->get();
        return view('admin.index')->with('users',$users);*/
        $categories = Category::all();

        $videos = DB::table('videos as video')
        ->join('categories as category', 'category.id', '=', 'video.categoryId')
        ->select('video.*','category.name as categoryName')
        ->get();

        $audios = DB::table('audios as audio')
        ->join('categories as category', 'category.id', '=', 'audio.categoryId')
        ->select('audio.*','category.name as categoryName')
        ->get();


        return view('admin.index')
                  ->with('categories',$categories)
                  ->with('videos',$videos)
                  ->with('audios',$audios);
      }

      public function saveCategory(Request $request){
          $category = new Category;
          $category->name = $request->name_category;
          if($request->imagen_diagnostica){
             $image = $request->image_category;
             $filename  = time().'.'.$image->getClientOriginalExtension();
             $path = public_path('uploads/images/'.$filename);
             Image::make($image->getRealPath())->resize(400, 400)->save($path);
             $image_category = $filename;
          }else{
             $image_category = 'none';
          }
          $category->image = $image_category;
          $category->description = $request->name_category;
          $category->save();
          return redirect('admin');
      }


      /*editar categoria*/
      public function editCategory ($id){
        $category = Category::find($id);
        return view('admin.edit')->with('category', $category);

      }

      public function updatecategory($id, Request $request){
          $category = Category::find($id);
          $category->name = $request->name_category;
          if($request->imagen_diagnostica){
             $image = $request->image_category;
             $filename  = time().'.'.$image->getClientOriginalExtension();
             $path = public_path('uploads/images/'.$filename);
             Image::make($image->getRealPath())->resize(400, 400)->save($path);
             $image_category = $filename;
          }else{
             $image_category = 'none';
          }
          $category->image = $image_category;
          $category->description = $request->name_category;
          $category->save();
          return redirect('admin');
      }
      /*----------------*/

      /*editar video*/
      public function editVideo ($id){
        $video = Video::find($id);
        $categories = Category::all();
        return view('admin.edit-video')->with('video', $video)->with('categories', $categories);

      }

      public function updateVideo($id, Request $request){
          $video = Video::find($id);
          $video->categoryId = $request->category_id;
          $video->name = $request->name_video;
          $video->url = $request->url_video;
          $video->type = $request->video_type;
          $video->keywords = $request->keywords_video;
          $video->description = $request->description_video;
          $video->save();
          return redirect('admin');
      }
      /*----------------*/

      public function saveVideo(Request $request){
          $video = new Video;
          $video->categoryId = $request->category_id;
          $video->name = $request->name_video;
          $video->url = $request->url_video;
          $video->type = $request->video_type;
          $video->keywords = $request->keywords_video;
          $video->description = $request->description_video;
          $video->save();
          return redirect('admin');
      }


      public function saveAudio(Request $request){

          $audio = new Audio;
          $audio->categoryId = $request->category_id;
          $audio->name = $request->name_audio;
          $audio->url = $request->url_audio;
          if($request->image_audio){
             $image = $request->image_audio;
             $filename  = time().'.'.$image->getClientOriginalExtension();
             $path = public_path('uploads/images/'.$filename);
             Image::make($image->getRealPath())->resize(400, 400)->save($path);
             $image_audio = $filename;
          }else{
             $image_audio = 'none';
          }
          $audio->img_profile = $image_audio;
          $audio->keywords = $request->keywords_audio;
          $audio->description = $request->description_audio;
          $audio->save();
          return redirect('admin');
      }



}
