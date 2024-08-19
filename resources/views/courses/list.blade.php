<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Course') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <

                <table class="w-full border-black-50">

                    <tr class="bg-green-900 h-10 text-black">
                        <th>SI.No</th>
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
                            <td>{{$course->title}}</td>
                            <td>{{$category->category}}</td>
                            <td>{{$creator->name}}
                        </tr>
                        @endforeach
                </table>

            
            </div>
        </div>
    </div>
</div>
</x-app-layout>