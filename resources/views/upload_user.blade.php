@extends('layouts.app')
@section('content')
<html>
<head>
    <!---<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />-->
</head>
<body>

<div class="container">
    <div class="card" style="width: 40rem;margin:0px auto;">
        <div class="card-header">
            <form method="post" enctype="multipart/form-data" action="{{ route('import_user')}}"><!--不对字符编码。在使用包含文件上传控件的表单时，必须使用该值。-->
                @csrf
                <div class="from-group " style="width: 20rem;" >
                    <label for="inputfile">Excel上傳</label>
                    <input type="file" name="file" class="form-control" id="inputfile">
                </div>
                <button type="submit" class="btn btn-primary">上傳</button>
            </form>
            <br>
            <p class="card-text">請依照範例檔上傳，並將範例格式之資料覆蓋</p>
            <strong><h5></h5></strong>
            <h6><a href="/import_user.xlsx" download="import_user.xlsx">點選下載新增範例檔</a></h6>
            <!--範例檔URL URL::asset('/storage/example2.xlsx')-->
        </div>
    </div>
</div>

</body>
</html>
@endsection
