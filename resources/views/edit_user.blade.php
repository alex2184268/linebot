@extends('layouts.app')
<link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                <div class="card bg-info text-white">
                        <div class="card-header text-center">用戶管理</div>
                        <div class="card-body text-center">
                            <form action="{{ route('update.user')}}" method="POST"  >
                                @csrf
                                
                                <input hidden type="text" value="{{ $user->id }}" name="user_id" required>
                                <div class="form-group ">
                                    <h5>Line</h5>
                                </div>
                                <div class="form-group">
                                    <h5>用戶姓名</h5>
                                    <input type="text" value="{{ $user->person_name}}" name="person_name" required>
                                </div>
                                <div class="form-group">
                                    <h5>學校</h5>
                                    <select name="school" id="school">
                                                        <option value="" selected></option>
                                                    @forelse ($school as $value)
                                                        <option value="{{ $value->id}}" >{{ $value->SCHOOL_NAME}}</option>
                                                    @empty
                                                        
                                                    @endforelse
                                    </select>
                                </div>
                                <div class="form-group">
                                    <h5>連絡電話</h5>
                                    <input type="text" value="{{ $user->phone}}" name="phone" >
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary " alt="submit">確定修改</button>
                                    <input  type="button" class="btn btn-primary" onclick="window.location='{{ route('home') }}'" value="取消">
                            </form>
                               </div>
                </div>
                        </div>
                </div>
        </div>
    </div>
</div>
@endsection
