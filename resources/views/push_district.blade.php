@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">選擇地區</div>
                
                <div class="card-body">
                    <form action="{{ route('check')}}" method="POST">
                        @csrf
                        <label for=""><input type="checkbox" name="all" id="all" onclick="checkall(this)"><h6>選擇全部</h6></label>
                        @foreach ($district as $value)
                        <div class="card">
                            <div class="card-body"></div>
                            <label >
                                <input type="checkbox" name="district" id="{{$value->id}}"  onclick="check_district(this,{{ $value->id }})">
                                <h4>{{ $value->DISTRICT }}</h4>
                                @foreach ($school as $item)
                                @if ($value->id == $item->district_id)
                                <label>
                                    <input type="checkbox" name="{{ $value->id}}[]" id="{{ $item->id}}" value="{{$item->id}}">
                                    <!-- 回傳 -->
                                    <h6>{{ $item->SCHOOL_NAME}}</h6>
                                </label>
                                @endif
                                @endforeach
                            </label>
                        </div>
                        @endforeach
                        <button type="submit" class="btn btn-primary">確認學校</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function checkall(obj)
    {
        var aa = document.querySelectorAll("input[type=checkbox]");
        for (var i = 0; i < aa.length; i++){
        aa[i].checked = obj.checked;
        }
    }


    function check_district(obj,Name)
    {
        var checkboxs = document.getElementsByName(Name);//選擇checkbox
        for(var i=0; i<checkboxs.length; i++){
            checkboxs[i].checked = obj.checked;
            }
    }
</script>
@endsection
