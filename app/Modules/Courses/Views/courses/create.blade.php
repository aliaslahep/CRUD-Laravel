<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add course') }}
        </h2>
    </x-slot>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        div.category_popup {
            visibility: hidden;
            width: 40%;
            height: 20%;
            margin: 10%;
            padding: auto;
            position: fixed;
            top: 100px;
            border: 3px solid #5f5f5f;
            background-color:rgb(55 65 81);
            z-index: 9;
            display: flex;
            justify-content: center;
        }
        div.tag_popup {
            visibility: hidden;
            width: 40%;
            height: 20%;
            margin: 10%;
            padding: auto;
            position: fixed;
            top: 100px;
            border: 3px solid #5f5f5f;
            background-color: rgb(55 65 81);
            z-index: 9;
            display: flex;
            justify-content: center;
        }
    </style>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white-900">
                                    
                    <h2 class="text-title-md2 text-4xl font-bold text-black dark:text-white">
                        Create Course 
                      </h2>

                    <form name="users_form" action="{{url('/courses/create')}}" method="post" encType='multipart/form-data'>
                        <div class="form-group">
                            <div class="my-5">

                                @csrf

                                <b for="title">Title :</b> 
                                     <input type="text" name="title" class="w-full p-2 border-gray-400 dark:bg-gray-700 rounded " value={{old('title')}}>
                                    @if($errors->has('title'))
                                        <span class="text-red-500">{{ $errors->first('title') }}</span><br>
                                    @endif
                            </div>
                            <div class="my-5">
                                <b>Content : </b>
                                    <input type="text" name="content" class="w-full p-2 border-gray-400 dark:bg-gray-700 rounded" value={{old('content')}}>
                                    @if($errors->has('content'))
                                        <span class="text-red-500">{{ $errors->first('content') }}</span><br>
                                    @endif
                            </div>
                            <div class="my-5">
                                <b>Categroy </b>
                                    <a onclick="category_popup()" class="ml-5 text-sm text-blue-600" >Add category +</a>
                                    <select name="category" class="w-full p-2 border-gray-400 dark:bg-gray-700 rounded">
                                        <option></option>

                                        @foreach($categories as $category)
                                        
                                            <option value="{{$category->id}}" {{old('category')==$category->id ? "selected" : "" }}>{{$category->category}}</option>
                                        
                                        @endforeach

                                    </select>

                                @if($errors->has('category'))
                                    <span class="text-red-500">{{ $errors->first('category') }}</span><br>
                                @endif
                            </div>

                            <div class="category_popup" id="category_popup" class="border-gray-500 dark:bg-gray-700">
                                <b class="mt-9">Add Category</b>
                                <input type="text" id="category_input" class="category_input h-10 mt-8 mx-4" name="category_input">
                                <input type="button" id="add_category_id" value="Add">
                                
                            </div>

                            <div class="my-5">
                                <b>Thumbnail</b>
                                    <input type="file" name="thumbnail" class="w-full cursor-pointer rounded-lg border-[1.5px] border-stroke bg-transparent font-normal outline-none transition file:mr-5 file:border-collapse file:cursor-pointer file:border-0 file:border-r file:border-solid file:border-stroke file:bg-whiter file:px-5 file:py-3 file:hover:bg-primary file:hover:bg-opacity-10 focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:file:border-form-strokedark dark:file:bg-white/30 dark:file:text-white dark:focus:border-primary">
                                <br>
                                @if($errors->has('thumbnail'))
                                    <span class="text-red-500">{{ $errors->first('thumbnail') }}</span><br>
                                @endif
                                
                            </div>
                            
                                <b>Tags</b>
                                <a onclick="tag_popup()" class="ml-5 text-sm text-blue-600" >Add Tag +</a>
                                
                               
                            <div class="my-5 flex">
                                @foreach($tags as $tag)
                                    <label for="checkboxLabelOne" class="ml-5 mt-5 flex cursor-pointer select-none items-center text-sm font-medium">
                                        <div class="relative">
                                            <input type="checkbox" name="tag[]" id="checkboxLabelOne" class="sr-only" :value={{$tag->id}} {{in_array($tag->id,old('tag',[])) ? "checked" : ""}} /> 
                                            <div :class="checkboxToggle && 'border-primary bg-gray dark:bg-transparent'" class="mr-4 flex h-5 w-5 items-center justify-center rounded border">
                                                <span
                                                :class="checkboxToggle && 'bg-primary'"
                                                class="h-2.5 w-2.5 rounded-sm"
                                                ></span>
                                            </div>
                                        </div>
                                        {{$tag->tag}}
                                    </label>
                                @endforeach
                                <br />                             

                            </div>

                            @if($errors->has('tag'))
                                <span class="text-red-500">{{ $errors->first('tag') }}</span><br>
                            @endif

                            <div class="tag_popup" id="tag_popup" class="border-gray-500 dark:bg-gray-700">
                                <b class="mt-9">Add Tag</b>
                                <input type="text" id="tag_input" class="tag_input h-10 mt-8 mx-4" name="tag_input">
                                <input type="button" id="add_tag_id" value="Add">
                            </div>


                            <div class="my-5">
                                <b>File</b>
                                    <input type="file" name="file[]" class="w-full cursor-pointer rounded-lg border-[1.5px] border-stroke bg-transparent font-normal outline-none transition file:mr-5 file:border-collapse file:cursor-pointer file:border-0 file:border-r file:border-solid file:border-stroke file:bg-whiter file:px-5 file:py-3 file:hover:bg-primary file:hover:bg-opacity-10 focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:file:border-form-strokedark dark:file:bg-white/30 dark:file:text-white dark:focus:border-primary" multiple>
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

                    <script>
                        $(document).on("click", "#add_category_id", function(){

                            var category = $('#category_input').val();
                    
                            if(category.trim() === "") {
                                alert("Input field is empty");
                                return;
                            }
                    
                            $.ajax({
                                url: "{{ url('/category/add') }}", 
                                method: "POST",
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    category: category
                                },
                                dataType: "json",
                                success: function(data){
                                    $('#category').append('<option value="' + data.id + '">' + data.category + '</option>');
                                    
                                    category_popup_close(); 
                                },
                                error: function(xhr) {
                    
                                    console.log(xhr.responseText);
                                }
                            });
                        });

                        $(document).on("click", "#add_tag_id", function(){

                            var tag = $('#tag_input').val();

                            if(tag.trim() === "") {
                                alert("Input field is empty");
                                return;
                            }

                            $.ajax({
                                url: "{{ url('/tag/add') }}", 
                                method: "POST",
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    tag: tag
                                },
                                dataType: "json",
                                success: function(data){
                                    $('#tags').append('<input type="checkbox" value="' + data.id + '">' + data.tag);
                                    
                                    tag_popup_close(); 
                                },
                                error: function(xhr) {

                                    console.log(xhr.responseText);
                                }
                            });
                            });
                        
                        
                    </script>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>



<script>

    function category_popup(){

        document.getElementById("category_popup").style.visibility = "visible";
    }
    function category_popup_close(){

        document.getElementById("category_popup").style.visibility = "hidden";
    }
    function tag_popup(){

        document.getElementById("tag_popup").style.visibility = "visible";
    }
    function tag_popup_close(){

        document.getElementById("tag_popup").style.visibility = "hidden";
    }
</script>
    
