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
                                    
                    <form name="users_form" action="{{url('/courses/create')}}" method="post" encType='multipart/form-data'>
                        <div class="form-group">
                            <div class="my-5">

                                @csrf

                                <b>Title :</b> 
                                     <input type="text" name="title" class="w-full p-2 border rounded" value={{old('title')}}>
                                    @if($errors->has('title'))
                                        <span class="text-red-500">{{ $errors->first('title') }}</span><br>
                                    @endif
                            </div>
                            <div class="my-5">
                                <b>Content : </b>
                                    <input type="text" name="content" class="w-full p-2 border rounded" value={{old('content')}}>
                                    @if($errors->has('content'))
                                        <span class="text-red-500">{{ $errors->first('content') }}</span><br>
                                    @endif
                            </div>
                            <div class="my-5">
                                <b>Categroy </b>
                                    <select name="category" class="w-full p-2 border rounded">
                                        <option></option>

                                        @foreach($categories as $category)
                                        
                                            <option value="{{$category->id}}" {{old('category')==$category->id ? "selected" : "" }}>{{$category->category}}</option>
                                        
                                        @endforeach

                                    </select>

                                @if($errors->has('category'))
                                    <span class="text-red-500">{{ $errors->first('category') }}</span><br>
                                @endif
                            </div>
                            <div class="my-5">
                                <b>Thumbnail</b>
                                    <input type="file" name="thumbnail">
                                <br>
                                @if($errors->has('thumbnail'))
                                    <span class="text-red-500">{{ $errors->first('thumbnail') }}</span><br>
                                @endif
                                
                            </div>
                            <div class="my-5 flex">
                                <b>Tags</b>

                                @foreach($tags as $tag)
                                    
                                    <div class="mx-3">
                                        <input type="checkbox" name="tag[]" class="m-2" value={{$tag->id}} {{in_array($tag->id,old('tag',[])) ? "checked" : ""}}>{{$tag->tag}}
                                    </div>
                                @endforeach
                                <br/>

                                
                                @if($errors->has('tag'))
                                    <span class="text-red-500">{{ $errors->first('tag') }}</span><br>
                                @endif
                            
                            </div>
                            <div class="my-5">
                                <b>File</b>
                                    <input type="file" name="file[]" multiple>
                                <br>
                                @if($errors->has('file'))
                                    <span class="text-red-500">{{ $errors->first('file') }}</span><br>
                                @endif
                            </div>
                            <center>
                                <input type="submit" value="submit" class="px-4 py-2 bg-blue-600 rounded-md font-semibold text-xs text-white">
                            </center>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

   
    
