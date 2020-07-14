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
            <form method="post" enctype="multipart/form-data" action="{{ route('upload')}}"><!--不对字符编码。在使用包含文件上传控件的表单时，必须使用该值。-->
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
            <h6><a href="/example.xlsx" download="example.xlsx">點選下載新增學校範例檔</a></h6>
            <!--範例檔URL URL::asset('/storage/example2.xlsx')-->
        </div>
    </div>
    <div class="card" style="width: 40rem;margin:0px auto;">
      <h6>Excel請參照各區、各學校類別代碼填入，切勿直接使用中文名稱</h6>
      <table class="table table-primary text-black ">
        <tr>
          <td><strong><h5>地區名稱</h5></strong></td>
          <td><strong><h5>地區代碼</h5></strong></td>
        </tr>
          @foreach ($district as $item)
          <tr>  
            <td>{{ $item->DISTRICT}}</td>
            <td>{{ $item->id}}</td>
          </tr>
          @endforeach
        <tr>
          <td><strong><h5>學校類別</h5></strong></td>
          <td><strong><h5>學校類別代碼</h5></strong></td>
        </tr>
          @foreach ($group as $value)
          <tr>
            <td>{{ $value->school_type}}</td>
            <td>{{ $value->id}}</td>
          </tr>
          @endforeach
      </table>
    </div>


</div>

</body>
</html>
@endsection
