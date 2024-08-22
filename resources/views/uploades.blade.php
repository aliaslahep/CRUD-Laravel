<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Import Access Log') }}
        </h2>
    </x-slot>

    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                    {{!empty($file) ? $file : ""}}

                    <form action="upload-log" method="post" class="flex" enctype="multipart/form-data">
                        @csrf
                        <div class="from flex m-5">
                            <b class="m-1">Upload CSV File</b> <input type="file" name="file" class="ml-3">  
                        </div>
                        @if($errors->has('file'))
                            <span class="text-red-500">{{ $errors->first('file') }}</span><br>
                        @endif
                        <div class="mt-5">
                            <input type="submit" value="Upload" class="px-3 py-1 rounded-md bg-blue-500">
                        </div>
                        <div class="from flex m-3 h-6">
                            <a href="{{url('uploads-log')}}" name="excel_import" class="text-black ml-2 p-1 h-8 rounded-md bg-slate-500">Import Excel</a>  
                        </div>
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
                                    <td>{{$cell}}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    @endif
                </table>

                <div class="from flex m-5 h-6">
                    <a href="{{url('upload-excel')}}" name="excel_import" class="text-black ml-2 p-1 h-8 rounded-md bg-slate-500">Upload Excel</a>  
                </div>
                
            </div>
            
        </div>

    </div>  
</x-app-layout>