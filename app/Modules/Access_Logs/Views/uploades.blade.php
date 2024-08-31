<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Import Access Log') }}
        </h2>
    </x-slot>

    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg h-[100vh]">
                <div class="p-6 text-white-900">

                    <h2 class="text-title-md2 m-5 text-4xl font-bold text-black dark:text-white">
                        Upload Access Log file 
                      </h2>

                    @if (session('message'))
                        <div class="alert alert-success text-blue-700">
                            {{ session('message') }}
                        </div>
                    @endif

                        <form action="upload-log" method="post" class="flex" enctype="multipart/form-data">
                            @csrf
                            <div class="from flex m-5">
                                <b class="m-1">Upload CSV File</b> <input type="file" name="file" class="w-full cursor-pointer rounded-lg border-[1.5px] border-stroke bg-transparent font-normal outline-none transition file:mr-5 file:border-collapse file:cursor-pointer file:border-0 file:border-r file:border-solid file:border-stroke file:bg-whiter file:px-5 file:py-3 file:hover:bg-primary file:hover:bg-opacity-10 focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:file:border-form-strokedark dark:file:bg-white/30 dark:file:text-white dark:focus:border-primary ">  
                            </div>
                            
                            <div class="mt-5">
                                <input type="submit" value="Upload" class="mt-3 px-3 py-1 rounded-md bg-blue-500 text-black">
                            </div>

                            @if($errors->has('file'))
                                <span class="text-red-500 mt-5 ml-3">{{ $errors->first('file') }}</span><br>
                            @endif  
                        </form>
                        <br/>
                        <hr/>
                        <br/>
                    <table class="w-full border-black-50 mt-3">
        
                        <tr class="text-center bg-gray-900 h-10 text-gray-500">
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
                        
                        @else
                            
                            <td class="text-red-500">No File Uploaded !!</td>
        
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

    </div>  
</x-app-layout>