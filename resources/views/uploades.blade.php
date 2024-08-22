<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Import Access Log') }}
        </h2>
    </x-slot>

    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

            
                @if (session('message'))
                    <div class="alert alert-success text-blue-700">
                        {{ session('message') }}
                    </div>
                @endif

                    <form action="upload-log" method="post" class="flex" enctype="multipart/form-data">
                        @csrf
                        <div class="from flex m-5">
                            <b class="m-1">Upload CSV File</b> <input type="file" name="file" class="ml-3">  
                        </div>
                        
                        <div class="mt-5">
                            <input type="submit" value="Upload" class="px-3 py-1 rounded-md bg-blue-500">
                        </div>

                        @if($errors->has('file'))
                            <span class="text-red-500 mt-5 ml-3">{{ $errors->first('file') }}</span><br>
                        @endif  
                    </form>
                <table class="w-full border-black-50 mt-3">
    
                    <tr class="text-center bg-green-900 h-10 text-black">
                        <th>IP Address</th>
                        <th>Username</th>
                        <th>URL</th>
                        <th>Access Log</th>
                    </tr>

                    @if(!empty($data)) 
                        @foreach($data as $row)
                            <tr class="text-center">
                                @foreach($row as $cell)
                                    @if($cell == "")
                                        <td class="text-red-500">Missing Value !!</td>
            
                                    @else
    
                                        <td>{{$cell}}</td>
                                    
                                    @endif

                                @endforeach
                            </tr>
                        @endforeach
                    @endif
                </table>
                @if(!empty($error))
                    @if($error==1)
                        <div class="from flex m-5 h-6">
                            <a href="{{url('upload-excel')}}" name="excel_import" class="text-black ml-2 p-1 h-8 rounded-md bg-slate-500">Upload Excel</a>  
                        </div>
                   @endif
                @endif
                

            </div>
            
        </div>

    </div>  
</x-app-layout>