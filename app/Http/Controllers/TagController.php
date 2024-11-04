<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    
    public function tagShows(Request $request){
        try{
            $userId = $request->header('id');

            $tag = Tag::where('user_id', '=', $userId)->get();

            return response()->json([
                'status'    => 'success',
                'message'   => 'Request successfully done',
                'tag'  => $tag
            ], 200);

        }
        catch(Exception $e){
            return response()->json([
                'status'    => 'fail',
                'message'   => 'Request fail'
            ], 401);
        }
    }


    public function tagCreate(Request $request){
        try{
            $userId = $request->header('id');
            $tagName = $request->input('name');

            $tag = Tag::create([
                'name'     => $tagName,
                'user_id'  => $userId
            ]);

            return response()->json([
                'status'    => 'success',
                'message'   => 'Tag has been added successfully',
                'category'     => $tag
            ], 201);

        }
        catch(Exception $e){
            return response()->json([
                'status'    => 'fail',
                'message'   => 'Request fail to add new tag',
                'error'     => $e->getMessage()
            ], 401);
        }
    }



    public function tagUpdate(Request $request){
        try{
            $userId = $request->header('id');
            $tagId = $request->input('id');
            $tagName = $request->input('name');

            Tag::where('id', '=', $tagId)->where('user_id', '=', $userId)->update([
                'name'     => $tagName
            ]);

            return response()->json([
                'status'    => 'success',
                'message'   => 'Tag has been updated successfully'
            ], 200);

        }
        catch(Exception $e){
            return response()->json([
                'status'    => 'fail',
                'message'   => 'Request fail to update tag',
                'error'     => $e->getMessage()
            ], 401);
        }
    }




    public function tagDelete(Request $request){
        try{
            $userId = $request->header('id');
            $tagId = $request->input('id');

            Tag::where('id', '=', $tagId)->where('user_id', '=', $userId)->delete();

            return response()->json([
                'status'    => 'success',
                'message'   => 'Tag has been deleted successfully'
            ], 200);
        }
        catch(Exception $e){
            return response()->json([
                'status'    => 'fail',
                'message'   => 'Request fail to delete Tag',
                'error'     => $e->getMessage()
            ], 401);
        }
    }


    public function tagById(Request $request){
        try{
            $userId = $request->header('id');
            $tagId = $request->id;

            $tag = Tag::where('id', '=', $tagId)->where('user_id', '=', $userId)->first();

            return response()->json([
                'status'    => 'success',
                'tag'  => $tag
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





}
