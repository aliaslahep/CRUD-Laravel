<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add course') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <table class="w-full border-black-50">

                        <tr class="bg-green-900 h-10 text-black">
                            <th>SI.No</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>

                        @php 
                            $i=1
                        @endphp   
                        
                        
                        @foreach($courses as $course)

                            @php

                                $category_id = $course->category;
                    
                                $category = DB::table('categories')->where(['id'=>$category_id])->first();


                            @endphp

                            <tr class="text-center h-12">
                                <td>{{$i++}}</td>
                                <td>{{$course->title}}</td>
                                <td>{{$category->category}}</td>
                                <td><a href="{{url('courses/edit',$course->id)}}" class="px-4 py-2 bg-blue-600 rounded-md font-semibold text-xs text-white">Update</a></td>
                                <td><a href="{{url('courses/delete',$course->id)}}" class="px-4 py-2 bg-red-600 rounded-md font-semibold text-xs text-white">Delete</a></td>
                        @endforeach
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>