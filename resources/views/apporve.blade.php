@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">使用者審核列表</div>

                    <div class="card-body">

                        @if (session('message'))
                            <div class="alert alert-success" role="alert">
                                {{ session('message') }}
                            </div>
                        @endif

                        <table class="table">
                            <tr>
                                <th>UserID</th>
                                <th>Line名稱</th>
                                <th>註冊時間</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{ $user->user_id }}</td>
                                    <td>{{ $user->user_name }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td><a href="{{ route('users.approve', $user->user_id) }}"
                                           class="btn btn-primary btn-sm">審核確認</a>
                                    </td>
                                    <td>
                                      <form action="{{ route('delete')}}" method="post">
                                        @csrf
                                          <input id="delete" name="delete" value="{{ $user->user_id }}" type="hidden">
                                          <button type="submit" class="btn btn-danger btn-sm " onclick="return confirm('確定刪除?');">刪除</button>
                                        </form>
                                    </td>

                                </tr>
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
@endsection
