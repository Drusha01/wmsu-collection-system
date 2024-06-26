<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        .page-break {
            page-break-after: always;
        }
    </style>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>  
    <h2 class="text-center">{{$header[0]['Title']}}</h2>
    <div class="col">
        <div class="flex flex-wrap items-center justify-between mt-3 px-4 p-2">
            <h5 class="text-start ">{{$header[1]['Academic Year']}}</h5>
            @foreach($header as $key=> $value)
                @if($key > 1)
                    <h6 class="text-start ">{{$value['content']}}</h6>
                @endif
            @endforeach
        </div>
    </div>
    <table class="table table-striped">
       
        <tbody style="font-size:12px;margin:0px 0px 0px 0px;padding:0px 0px 0px 0px;">
            @foreach($content as $key => $value)
                <tr>
                @foreach($value as $column_key => $column_value)
                    <td>{{$column_value}}</td>
                @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>