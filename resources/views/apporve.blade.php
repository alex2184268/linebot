@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">使用者審核列表</div>
                    <div class="card-body">
                        @if (session('message'))
                            <div class="alert alert-success" role="alert">
                                {{ session('message') }}
                            </div>
                        @endif
                        <div class="table-responsive-sm table-responsive-md table-responsive-lg  table-responsive-xl">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">UserID</th>
                                <th scope="col">姓名</th>
                                <th scope="col">註冊時間</th>
                                <th scope="col">單位</th>
                            </tr>
                            </thead>
                            @forelse ($users as $user)
                            <tbody>
                                <tr>
                                    @csrf
                                    <th scope="row">{{ $user->user_id }}</th>
                                    <td>{{ $user->person_name }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>{{ App\School::find("$user->school")->SCHOOL_NAME }}</td>
                                    
                                    <td>
                                        <form action="{{ route('users.approve')}}" method="post">
                                            <button type="submit" class="btn btn-success btn-sm " onclick="return confirm('確定審核?');" >審核通過</button>
                                            <input id="user_id" name="user_id" type="text" value="{{$user->id}}" hidden>
                                            <input id="user_id2" name="user_id2" type="text" value="{{$user->user_id}}" hidden>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{ route('delete')}}" method="post">
                                        @csrf
                                            <input id="delete" name="delete" value="{{ $user->user_id }}" type="hidden">
                                            <button type="submit" class="btn btn-danger btn-sm " onclick="return confirm('確定刪除?');">刪除</button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>    
                            @empty
                                <tr>
                                    <td colspan="4">目前沒有未審核的帳號</td>
                                </tr>
                            @endforelse
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
