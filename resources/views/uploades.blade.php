<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Course') }}
        </h2>
    </x-slot>

    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="w-full border-black-50">
    

                    @foreach($data as $row)
                        <tr>
                            @foreach($row as $cell)
                                <td>{{$cell}}</td>
                            @endforeach
                        </tr>
                    @endforeach
                    
                </table>

                <div class="from flex m-3 h-6">
                    <a href="{{url('upload-excel')}}" name="excel_import" class="text-black ml-2 p-1 h-8 rounded-md bg-slate-500">Upload Excel</a>  
                </div>
                
            </div>
            
        </div>

    </div>  
</x-app-layout>