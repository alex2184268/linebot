@extends('layouts.app')
<link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                <div class="card bg-info text-white">
                        <div class="card-header text-center">學校管理</div>
                        <div class="card-body text-center">
                            <form action="{{ route('update.user')}}" method="POST"  >
                                @csrf
                                <div class="form-group">
                                    <h5>地區</h5>
                                    <select name="district" id="district" >
                                        <option value="{{ $school->district_id}}" selected>{{ App\District::find($school->district_id)->DISTRICT}}</option>
                                        @foreach ($district as $item)
                                        <option value="{{ $item->id}}" >{{ $item->DISTRICT}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <h5>學校名稱</h5>
                                    <input type="text" value="{{ $school->SCHOOL_NAME}}" name="school_name" >
                                </div>
                                <div class="form-group">
                                    <h5>學校類型</h5>
                                    <select name="group" id="group" >
                                        <option value="{{ $school->school_type}}" selected>{{ App\Group::find($school->school_type)->school_type}}</option>
                                        @foreach ($group as $item)
                                        <option value="{{ $item->id}}" >{{ $item->school_type}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary " alt="submit">確定修改</button>
                                    <input  type="button" class="btn btn-primary" onclick="window.location='{{ route('school.group') }}'" value="取消">
                            </form>
                        </div>
                </div>
                        </div>
                </div>
        </div>
    </div>
</div>
@endsection
