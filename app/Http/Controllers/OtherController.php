<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class OtherController extends Controller
{
    public function thumbnail_delete($id) {

        $course = DB::table('courses')->where('id',$id)->update([

            'thumbnail'=> ''
        ]);

        return redirect()->route("course.edit",['id' => $id])->with('success','');

    }

    public function category_add(Request $request) {

        $category = DB::table('categories')->insert([
        
            'category'=> $request->category,

            'created_at'=> now(),

            'updated_at'=> now(),
        
        ]);

        return response()->json(['success' => true, 'data' => $category]);        
    }

    public function tag_add(Request $request) {

        $tag = DB::table('tags')->insert([
            
            'tag'=> $request->tag,
            'created_at'=> now(),
            'updated_at'=> now(),
        ]);

        

        return response()->json(['success' => true, 'data' => $tag]);        

    }
}
