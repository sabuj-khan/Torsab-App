<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    

    public function categoryShows(Request $request){
        try{
            $userId = $request->header('id');

            $category = Category::where('user_id', '=', $userId)->get();

            return response()->json([
                'status'    => 'success',
                'message'   => 'Request successfully done',
                'category'  => $category
            ], 200);

        }
        catch(Exception $e){
            return response()->json([
                'status'    => 'fail',
                'message'   => 'Request fail'
            ], 401);
        }
    }


    public function categoryCreate(Request $request){
        try{
            $userId = $request->header('id');
            $catName = $request->input('name');

            $category = Category::create([
                'name'     => $catName,
                'user_id'  => $userId
            ]);

            return response()->json([
                'status'    => 'success',
                'message'   => 'Category has been added successfully',
                'category'     => $category
            ], 201);

        }
        catch(Exception $e){
            return response()->json([
                'status'    => 'fail',
                'message'   => 'Request fail to add new category',
                'error'     => $e->getMessage()
            ], 401);
        }
    }


    public function categoryUpdate(Request $request){
        try{
            $userId = $request->header('id');
            $catId = $request->input('id');
            $name = $request->input('name');

            $cat = Category::where('id', '=', $catId)->where('user_id', '=', $userId)->update([
                'name' => $name
            ]);
            

            return response()->json([
                'status'    => 'success',
                'message'   => 'Category has been updated successfully',
                'data'  => $cat
                
            ], 200);

        }
        catch(Exception $e){
            return response()->json([
                'status'    => 'fail',
                'message'   => 'Request fail to update category',
                'error'     => $e->getMessage()
            ], 401);
        }
    }


    public function categoryDelete(Request $request){
        try{
            $userId = $request->header('id');
            $catId = $request->input('id');

            Category::where('id', '=', $catId)->where('user_id', '=', $userId)->delete();

            return response()->json([
                'status'    => 'success',
                'message'   => 'Category has been deleted successfully'
            ], 200);
        }
        catch(Exception $e){
            return response()->json([
                'status'    => 'fail',
                'message'   => 'Request fail to delete category',
                'error'     => $e->getMessage()
            ], 401);
        }
    }



    public function categoryById(Request $request){
        try{
            $userId = $request->header('id');
            $catId = $request->id;

            $category = Category::where('id', '=', $catId)->where('user_id', '=', $userId)->first();

            return response()->json([
                'status'    => 'success',
                'category'  => $category
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
