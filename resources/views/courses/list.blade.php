<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Course') }}
        </h2>
    </x-slot>

    
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                {{$user}}
                <table class="w-full border-black-50">

                    <tr class="text-center bg-green-900 h-10 text-black">
                        <th>SI.No</th>
                        <th>Thumbnail</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Created By</th>
                    </tr>

                    @php 
                        $i=1
                    @endphp   

                    
                    @foreach($courses as $course)

                        @php

                            $category_id = $course->category;
                
                            $category = DB::table('categories')->where(['id'=>$category_id])->first();

                            $creator = DB::table('users')->where(['id' => $course->created_by])->first();

                        @endphp

                        <tr class="text-center h-10">
                            <td>{{$i++}}</td>
                            <td><img src="{{$course->created_by == $user ? asset('storage/'.$course->thumbnail) : ""}}" alt="course image" width="70" height="80"></td>
                            <td>{{$course->title}}</td>
                            <td>{{$category->category}}</td>
                            <td>{{$creator->name}}
                        </tr>
                        @endforeach
                </table>  
                <div class="d-flex justify-content-center mt-4 ">
                    {{ $courses->links('pagination::bootstrap-4') }}
                </div>         
            </div>
            
        </div>
    </div>
</div>  
</x-app-layout>