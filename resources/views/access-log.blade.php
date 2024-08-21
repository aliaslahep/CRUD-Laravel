<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Course') }}
        </h2>
    </x-slot>

    
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <form action="/access-log" method="post">
                    @csrf
                    <div class="w-full">

                        <div class="search-container  p-2 m-2 flex justify-evenly">

                            <div class="username flex m-2">
                                <p>Username</p>
                                <select class="ml-2 h-6" name="user">
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="url flex m-2">
                                <p>URL</p>
                                <select class="ml-2 h-6" name="url">
                                    
                                    @foreach($logs_url as $log)
                                        @php
                                            $url = explode("/",$log->url);   
                                        @endphp
                                        <option value="{{$log->url}}">{{$log->url}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="search-container flex justify-evenly">                    
                            <div class="from flex m-2 h-6">
                                <p>From</p>
                                <input type="date" name="from" class="ml-2" value="2024-08-20"> 
                            </div>
                            <div class="to flex h-6 m-2">
                                <p>To</p>
                                <input type="date" name="to" class="ml-2" value="{{ $to }}">
                            </div>
                        </div>
                        <div class="search-container flex justify-evenly">                    
                            <div class="from flex m-3 h-6">
                                <input type="submit" name="search" class="ml-2 p-1 h-8 rounded-md bg-blue-600" value="Search"> 
                            </div>
                        </div>                   

                    </div>
                    

                </form>

                <table class="w-full border-black-50">
                    <tr class="text-center bg-green-900 h-10 text-black">
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
                            <td>{{date('d M Y h:i a' ,strtotime($log->access_log))}}</td>
                        </tr>
                    @endforeach
                </table>  
                
                
            </div>
            
        </div>
    </div>
</div>  
</x-app-layout>