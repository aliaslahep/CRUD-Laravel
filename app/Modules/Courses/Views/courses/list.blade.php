<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add course') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white-900">

                    <h2 class="text-title-md2 text-4xl m-5 font-bold text-black dark:text-white">
                        List All Courses
                      </h2>

                
                    <table class="w-full border-black-50">

                        <tr class="text-center bg-gray-900 h-10 text-gray-500">
                            <th>SI.No</th>
                            <th>THUMBNAIL</th>
                            <th>TITLE</th>
                            <th>CATEGORY</th>
                            <th>CREATED BY</th>
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
                                <td><a href="{{ route('list.image', $course->id ) }}">
                                        <img src="{{url(route('list.image', $course->id ))}}" height="90" width="90">    
                                    {{--<p>View </p>--}}
                                    </a>
                                </td>
                                <td>{{$course->title}}</td>
                                <td>{{$category->category}}</td>
                                <td>{{$creator->name}}
                            </tr>
                            @endforeach
                    </table>  
                    <div class="d-flex justify-content-center mt-4 ">
                        {{ $courses->links('pagination::bootstrap-5') }}
                    </div>         
                </div>
            </div>
            
        </div>
    </div>
</div>  
</x-app-layout>

