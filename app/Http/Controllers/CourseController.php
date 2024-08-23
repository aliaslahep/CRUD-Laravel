<?php

namespace App\Http\Controllers;

use App\Models\Course;


use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
 

class CourseController extends Controller
{
    
    public function create() {

        $get_category = DB::table("categories")->get();
        
        $get_tag = DB::table("tags")->get();

        return view("courses.create",[
            "categories"=> $get_category,
            "tags"=> $get_tag
        ]);
    }

    public function store(Request $request){
      
        $validator = Validator::make( $request->all(), [

           "title"=>'required',
            "content"=>'required',
            "category"=>'required',
            "thumbnail"=>'required|mimes:png,jpg,jpeg|max:10240',
            'tag' => 'required|array',
            'tag.*' => 'required|string|max:255',
            "file" => "required|array",
            'file.*' => 'required|mimes:pdf|max:10240',
        ]);

        if( $validator->fails() ){

            return redirect()->back()->withErrors($validator)->withInput();
        
        }


        $image = $request->file("thumbnail")->store('images','public');


        $course = new Course();

        $course->title = $request->title;
        $course->content = $request->content;
        $course->category = $request->category;
        $course->thumbnail = $image;
        $course->created_by = auth()->id();

        $course->save();


        $tags = $request->tag;

       foreach($tags as $tag){

            DB::table('course_tags')->insert([

                'tag_id'=> $tag,

                'course_id'=> $course->id

            ]);
       }

      
       $files = $request->file('file');

       foreach($files as $file) {

            DB::table('course_files')->insert([

                'file' => $file,
                'course_id' => $course->id
            ]);
       }

        return redirect()->route("course.show")->with('success','');

    }

    public function show(){

        $courses = DB::table('courses')->where('created_by', auth()->id())->get();
        $category = DB::table('categories')->first();

        return view('courses.show',[

            'courses' => $courses,
            'category'=> $category
        ]);
    }

    public function edit($id) {

        $course = DB::table('courses')->where('id', $id)->first();

        $get_category = DB::table("categories")->get();
        
        $get_tag = DB::table("tags")->get();

        $course_tag = DB::table("course_tags")->where('course_id',$id)->pluck('tag_id')->toArray();
        $course_file = DB::table("course_files")->where('course_id',$id)->first();


        return view('courses.update',[
            'course' => $course,
            'categories' => $get_category,
            'tags'=> $get_tag,
            'course_tag' => $course_tag,
            'course_file' => $course_file
        ]);
    }

    public function update($id , Request $request) {



        $validator = Validator::make($request->all(),[

            'title'=> 'required',
            'content'=> 'required',
            'category'=> 'required'
        ]);

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $course = DB::table('courses')->where('id',$id)->first();

        if( $request->hasFile('thumbnail') ) {
            
            $image = $request->file("thumbnail")->store('images','public');
            
        } else {

            $image = $course->thumbnail;
        }


        $course = DB::table('courses')->where('id',$id)->update([

            'title'=> $request->title,

            'content'=> $request->content,

            'category'=> $request->category,

            'thumbnail'=> $image,

            'updated_at'=> now()

        ]); 

        DB::table('course_tags')->where('course_id',$id)->delete();

        $tags = $request->tag;

        foreach($tags as $tag){

            DB::table('course_tags')->insert([

                'tag_id'=> $tag,

                'course_id'=> $id

            ]);
        }

        return redirect()->route('course.show')->with('success','');
    }



    public function delete($id) {

        $course = DB::table('courses')->where('id',$id)->delete();
        $course = DB::table('course_tags')->where('course_id',$id)->delete();
        $course = DB::table('course_files')->where('course_id',$id)->delete();

        return redirect()->route('course.show')->with('success','');

    }

    public function list() {

        $course = DB::table('courses')->orderBy('id','asc')->Paginate(3 , ['*'],'users');

        return view('courses.list',[
            
            'courses'=> $course,

        ]);


    }

    public function show_image($id) {

        $course = Course::findOrFail($id);
        
        if($course->created_by == auth()->user()->id) {

            $path = asset('storage/'.$course->thumbnail);


                return view('image',[
                    'path' => $path
                ]);


        }

        return view('image');
    }
}
