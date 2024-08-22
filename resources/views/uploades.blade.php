<table class="w-full border-black-50" border="1">
    

    @foreach($data as $row)
        <tr>
            @foreach($row as $cell)
                <td>{{$cell}}</td>
            @endforeach
        </tr>
    @endforeach