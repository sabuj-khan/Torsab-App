<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{

    public function allPostShow(Request $request){
        $posts = Post::with('user', 'category', 'tag')->paginate(3);

        return response()->json([
            'status'    => 'success',
            'posts'      => $posts
        ]);
    }

    public function allPostBackend(Request $request){
        $posts = Post::with('user', 'category', 'tag')->get();

        return response()->json([
            'status'    => 'success',
            'posts'      => $posts
        ]);
    }


    public function postShowByUser(Request $request){
        $userId = $request->header('id');
        $postByUser = Post::where('user_id', '=', $userId)->with('user', 'category', 'tag')->get();

        return response()->json([
            'status'    => 'success',
            'post'      => $postByUser
        ]);
    }


    public function postShowById(Request $request){
        $postId = $request->id;
        $post = Post::where('id', '=', $postId)->with('user', 'category', 'tag')->first();

        return response()->json([
            'status' => 'success',
            'post'  => $post
        ]);
    }
    
      

    public function postCreate(Request $request){
        try{
            $userId = $request->header('id');
            $title  = $request->input('title');
            $content  = $request->input('content');
            $category = $request->input('category_id');
            $tag      = $request->input('tag_id');
            
            $img        = $request->file('image');
            $time       = time();
            $fileName   = $img->getClientOriginalName();
            $imageName  = "{$userId}-{$time}-{$fileName}";
            $image_url  = "uploads/post-img/{$imageName}";

            // Image File Upload
            $img->move(public_path('uploads/post-img'), $imageName);

            // $user = User::where('id', '=', $userId)->first();
            // $userType = $user->user_type;

            $newPost = Post::create([
                'title'     => $title,
                'content'   => $content,
                'image'     => $image_url,
                'user_id'   => $userId,
                'category_id'   => $category,
                'tag_id'    => $tag
            ]);
            

            return response()->json([
                'status' => 'success',
                'message' => 'Request successfully done',
                'post'  => $newPost
            ], 201);
            
        }
        catch(Exception $e){
            return response()->json([
                'status'    => 'fail',
                'message'   => 'Request fail to create post',
                'error'     => $e->getMessage()
            ]);
        }
    }

    


    public function postUpdate(Request $request){
        try{
            $userId = $request->header('id');
            $postId = $request->input('id');
            $title  = $request->input('title');
            $content  = $request->input('content');
            $category = $request->input('category_id');
            $tag      = $request->input('tag_id');

            if($request->hasFile('image')){
                $img        = $request->file('image');
                $time       = time();
                $fileName   = $img->getClientOriginalName();
                $imageName  = "{$userId}-{$time}-{$fileName}";
                $image_url  = "uploads/post-img/{$imageName}";

                // Image File Upload
                $img->move(public_path('uploads/post-img'), $imageName);

                // Delete old File
                $filePath = $request->input('file_path');
                File::delete($filePath);

                Post::where('id', '=', $postId)->where('user_id', '=', $userId)->update([
                    'title'     => $title,
                    'content'   => $content,
                    'image'     => $image_url,
                    'user_id'   => $userId,
                    'category_id'   => $category,                       
                    'tag_id'    => $tag                       
                ]);

                return response()->json([
                    'status'    => 'success',
                    'message'   => 'Post has been updated successfully',
                ], 200);


            }else{
                Post::where('id', '=', $postId)->where('user_id', '=', $userId)->update([
                    'title'     => $title,
                    'content'   => $content,
                    'user_id'   => $userId,
                    'category_id'   => $category,                       
                    'tag_id'    => $tag                      
                ]);

                return response()->json([
                    'status'    => 'success',
                    'message'   => 'Post updated successfully',
                ], 200);
            }

        }
        catch(Exception $e){
            return response()->json([
                'status'    => 'fail',
                'message'   => 'Request fail to update post',
                'error'     => $e->getMessage()
            ], 401);
        }
    }


    public function postDelete(Request $request){
        try{
            $userId = $request->header('id');
            $postId = $request->input('id');

            Post::where('id', '=', $postId)->where('user_id', '=', $userId)->delete();

            return response()->json([
                'status'    => 'success',
                'message'   => 'Post has been deleted successfully'
            ], 200);

        }
        catch(Exception $e){
            return response()->json([
                'status'    => 'fail',
                'message'   => 'Request fail',
                'error'     => $e->getMessage()
            ], 401);
        }
    }



    public function postSingle(Request $request){
        $postId = $request->id;
        $post = Post::where('id', '=', $postId)->with('user', 'category', 'tag')->first();

        return response()->json([
            'status' => 'success',
            'post'  => $post
        ]);
    }













    




}
