<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Course') }}
        </h2>
    </x-slot>

    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white-900">
                <h2 class="text-title-md2 text-4xl font-bold text-black dark:text-white">
                    Access Log
                  </h2>

                <form action="/access-log" method="post">
                    @csrf
                    <div class="w-full">

                        <div class="search-container  p-2 m-2 flex justify-evenly">

                            <div class="username flex m-2">
                                <b class="mr-2 mt-2">Username</b>
                                <select class="w-full p-2 border-gray-400 dark:bg-gray-700 rounded" name="user">
                                    <option></option>
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}" {{ !empty($old_user)  && $old_user == $user->id ? "selected" : ""}}>{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="url flex m-2">
                                <b class="mr-2 mt-2">URL</b>
                                <select class="w-full p-2 border-gray-400 dark:bg-gray-700 rounded" name="url">
                                    <option></option>
                                    @foreach($logs_url as $log)        
                                        <option value="{{$log->url}}" {{ !empty($old_url)  && $old_url == $log->url ? "selected" : "" }}>{{$log->url}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="search-container flex justify-evenly">                    
                            <div class="from flex m-2 h-6">

                                @php
                                    if(!empty($old_from)){

                                        $from = date('Y-m-d',strtotime($old_from));
                                   
                                    } else {
                                        $from = "2024-08-20";
                                    }
                                    if(!empty($old_to)){

                                        $to = date('Y-m-d',strtotime($old_to));
                                    
                                    } else {
                                     
                                        $to = date('Y-m-d',strtotime(now()));

                                    } 
                                @endphp

                                

                                <b>From</b>
                                <input type="date" name="from" class="form-datepicker ml-2 w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" value="{{ $from }}"> 
                            </div>
                            <div class="to flex h-6 m-2">
                                <b>To</b>
                                
                                <input type="date" name="to" class="form-datepicker ml-2 w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" value="{{ $to }}">
                            </div>
                        </div>
                        <div class="search-container flex justify-evenly">                    
                            <div class="from flex m-3 h-6">
                                <input type="submit" name="search" class="ml-2 p-1 h-8 rounded-md bg-blue-600" value="Search"> 
                            </div>
                            <div class="from flex m-3 h-6">
                                <a href="{{url('generate-pdf', [$old_user ?? "null", urlencode($old_url ?? "null"),date('Y-m-d H:i:s',strtotime($from)), date('Y-m-d 23:59:59',strtotime($to)) ]) }}" name="pdf_download" class="text-black ml-2 p-1 h-8 rounded-md bg-slate-500">Download PDF</a> 
                            </div>
                            <div class="from flex m-3 h-6">
                                <a href="{{url('generate-excel',[$old_user ?? "null", urlencode($old_url ?? "null"),date('Y-m-d H:i:s',strtotime($from)), date('Y-m-d 23:59:59',strtotime($to)) ])}}" name="excel_download" class="text-black ml-2 p-1 h-8 rounded-md bg-slate-500">Download Excel</a>  
                            </div>
                                
                        </div>                   

                    </div>
                    

                </form>
                
                <br/>
                <hr />
                <br />

                <table class="w-full border-black-50">
                    <tr class="text-center bg-gray-900 h-10 text-gray-500">
                        <th>IP Address</th>
                        <th>Username</th>
                        <th>URL</th>
                        <th>Access Log</th>
                    </tr>   

                    @foreach($logs as $log)
                        <tr class="text-center h-10">
                            <td>{{$log->ip_address}}</td>
                            <td>{{$log->name}}</td>
                            <td>{{$log->url}}</td>
                            <td>{{$log->access_log}}</td>

                        </tr>
                    @endforeach
                </table>  
                
                </div>
            </div>
            
        </div>
    </div>
</div>  
</x-app-layout>