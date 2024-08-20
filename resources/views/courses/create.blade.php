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
            background-color: #f1f1f1;
            z-index: 9;
            display: flex;
            justify-content: center;
        }
    </style>
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
                                    <a onclick="category_popup()" class="ml-5 text-sm text-blue-600" >Add category +</a>
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

                            <div class="category_popup" id="category_popup">
                                <input type="text" id="category_input" class="category_input h-10 mt-9 mx-4" name="category_input">
                                <input type="button" id="add_category_id" value="Add">
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
</script>
    
