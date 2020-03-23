@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">選擇學校</div>
                <div class="card-body">
                    <form action="{{route('check')}}" method="POST">
                        @csrf
                        <label for=""><input type="checkbox" name="all" id="all" value="all" onclick="checkall(this)"><h6>選擇全部</h6></label>
                        
                        <div class="card">
                            <table class="table table-bordered ">
                                <tbody>
                                    <tr><th>區</th>
                                        @foreach ($group as $item)
                                        <th>
                                            <input type="checkbox" id="{{ $item->id}}" onclick="checkgroup({{$item->id}},this);">
                                            <label for="{{ $item->id}}">{{ $item->school_type}}</label>
                                        </th>
                                        @endforeach
                                    </tr>
                                    @foreach ($district as $value)
                                    <tr>
                                        <th>
                                            <input type="checkbox" id="{{ $value->id}}" onclick="checkdistrict({{$value->id}},this);">
                                            <label for="{{ $value->id}}">{{ $value->DISTRICT }}</label>
                                        </th>
                                        <th>
                                            @foreach ($school as $school2)
                                                @if ($school2->school_type == 1 && $school2->district_id == $value->id)
                                                    <input type="checkbox" class="{{$school2->district_id}} {{$school2->school_type}}" name="SchoolCode['{{ $school2->SCHOOL_NAME }}']" value="{{ $school2->id}}" id="{{ $school2->id}}" onclick="chkRegionColor(1);">
                                                    <label for="{{ $school2->id}}">{{ $school2->SCHOOL_NAME }}</label><br>
                                                @endif
                                            @endforeach
                                        </th>
                                        <th>
                                            @foreach ($school as $school2)
                                                @if ($school2->school_type == 2 && $school2->district_id == $value->id)
                                                    <input type="checkbox" class="{{$school2->district_id}} {{$school2->school_type}}" name="SchoolCode['{{ $school2->SCHOOL_NAME }}']" value="{{ $school2->id}}" id="{{ $school2->id}}" onclick="chkRegionColor(1);">
                                                    <label for="{{ $school2->id}}">{{ $school2->SCHOOL_NAME }}</label><br>
                                                @endif
                                            @endforeach
                                        </th>
                                        <th>
                                            @foreach ($school as $school2)
                                                @if ($school2->school_type == 3 && $school2->district_id == $value->id)
                                                    <input type="checkbox" class="{{$school2->district_id}} {{$school2->school_type}}" name="SchoolCode['{{ $school2->SCHOOL_NAME }}']" value="{{ $school2->id}}" id="{{ $school2->id}}" onclick="chkRegionColor(1);">
                                                    <label for="{{ $school2->id}}">{{ $school2->SCHOOL_NAME }}</label><br>
                                                @endif
                                            @endforeach
                                        </th>
                                        <th>
                                            @foreach ($school as $school2)
                                                @if ($school2->school_type == 4 && $school2->district_id == $value->id)
                                                    <input type="checkbox" class="{{$school2->district_id}} {{$school2->school_type}}" name="SchoolCode['{{ $school2->SCHOOL_NAME }}']" value="{{ $school2->id}}" id="{{ $school2->id}}" onclick="chkRegionColor(1);">
                                                    <label for="{{ $school2->id}}">{{ $school2->SCHOOL_NAME }}</label><br>
                                                @endif
                                            @endforeach
                                        </th>
                                        <th>
                                            @foreach ($school as $school2)
                                                @if ($school2->school_type == 5 && $school2->district_id == $value->id)
                                                    <input type="checkbox" class="{{$school2->district_id}} {{$school2->school_type}}" name="SchoolCode['{{ $school2->SCHOOL_NAME }}']" value="{{ $school2->id}}" id="{{ $school2->id}}" onclick="chkRegionColor(1);">
                                                    <label for="{{ $school2->id}}">{{ $school2->SCHOOL_NAME }}</label><br>
                                                @endif
                                            @endforeach
                                        </th>
                                        <th>
                                            @foreach ($school as $school2)
                                                @if ($school2->school_type == 6 && $school2->district_id == $value->id)
                                                    <input type="checkbox" class="{{$school2->district_id}} {{$school2->school_type}}" name="SchoolCode['{{ $school2->SCHOOL_NAME }}']" value="{{ $school2->id}}" id="{{ $school2->id}}" onclick="chkRegionColor(1);">
                                                    <label for="{{ $school2->id}}">{{ $school2->SCHOOL_NAME }}</label><br>
                                                @endif
                                            @endforeach
                                        </th>
                                        <th>
                                            @foreach ($school as $school2)
                                                @if ($school2->school_type == 7 && $school2->district_id == $value->id)
                                                    <input type="checkbox" class="{{$school2->district_id}} {{$school2->school_type}}" name="SchoolCode['{{ $school2->SCHOOL_NAME }}']" value="{{ $school2->id}}" id="{{ $school2->id}}" onclick="chkRegionColor(1);">
                                                    <label for="{{ $school2->id}}">{{ $school2->SCHOOL_NAME }}</label><br>
                                                @endif
                                            @endforeach
                                        </th>
                                        <th>
                                            @foreach ($school as $school2)
                                                @if ($school2->school_type == 8 && $school2->district_id == $value->id)
                                                    <input type="checkbox" class="{{$school2->district_id}} {{$school2->school_type}}" name="SchoolCode['{{ $school2->SCHOOL_NAME }}']" value="{{ $school2->id}}" id="{{ $school2->id}}" onclick="chkRegionColor(1);">
                                                    <label for="{{ $school2->id}}">{{ $school2->SCHOOL_NAME }}</label><br>
                                                @endif
                                            @endforeach
                                        </th>
                                        <th>
                                            @foreach ($school as $school2)
                                                @if ($school2->school_type == 9 && $school2->district_id == $value->id)
                                                    <input type="checkbox" class="{{$school2->district_id}} {{$school2->school_type}}" name="SchoolCode['{{ $school2->SCHOOL_NAME }}']" value="{{ $school2->id}}" id="{{ $school2->id}}" onclick="chkRegionColor(1);">
                                                    <label for="{{ $school2->id}}">{{ $school2->SCHOOL_NAME }}</label><br>
                                                @endif
                                            @endforeach
                                        </th>
                                        <th>
                                            @foreach ($school as $school2)
                                                @if ($school2->school_type == 10 && $school2->district_id == $value->id)
                                                    <input type="checkbox" class="{{$school2->district_id}} {{$school2->school_type}}" name="SchoolCode['{{ $school2->SCHOOL_NAME }}']" value="{{ $school2->id}}" id="{{ $school2->id}}" onclick="chkRegionColor(1);">
                                                    <label for="{{ $school2->id}}">{{ $school2->SCHOOL_NAME }}</label><br>
                                                @endif
                                            @endforeach
                                        </th>
                                        <th>
                                            @foreach ($school as $school2)
                                                @if ($school2->school_type == 11 && $school2->district_id == $value->id)
                                                    <input type="checkbox" class="{{$school2->district_id}} {{$school2->school_type}}" name="SchoolCode['{{ $school2->SCHOOL_NAME }}']" value="{{ $school2->id}}" id="{{ $school2->id}}" onclick="chkRegionColor(1);">
                                                    <label for="{{ $school2->id}}">{{ $school2->SCHOOL_NAME }}</label><br>
                                                @endif
                                            @endforeach
                                        </th>
                                        <th>
                                            @foreach ($school as $school2)
                                                @if ($school2->school_type == 12 && $school2->district_id == $value->id)
                                                    <input type="checkbox" class="{{$school2->district_id}} {{$school2->school_type}}" name="SchoolCode['{{ $school2->SCHOOL_NAME }}']" value="{{ $school2->id}}" id="{{ $school2->id}}" onclick="chkRegionColor(1);">
                                                    <label for="{{ $school2->id}}">{{ $school2->SCHOOL_NAME }}</label><br>
                                                @endif
                                            @endforeach
                                        </th>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            
                        </div>
                        <tr>
                            <td>
                                <button type="submit" class="btn btn-primary">確認單位</button>
                            </td>
                        </tr>
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

    function checkgroup(obj,a)
    {
        var aa = document.querySelectorAll("input[type=checkbox]");
        for(var i = 0; i<aa.length; i++){
            var text = new Array();
            var text = aa[i].className.toString().split(" ");
            if(text[1] == obj){
                aa[i].checked = a.checked;
            }
        }
    }

    function checkdistrict(obj,a)
    {
        var aa = document.querySelectorAll("input[type=checkbox]");
        for(var i = 0; i<aa.length; i++){
            var text = new Array();
            var text = aa[i].className.toString().split(" ");
            if(text[0] == obj){
                aa[i].checked = a.checked;
            }
        }
    }
    
</script>
@endsection
