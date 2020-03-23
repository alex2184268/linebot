@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">確認發送單位</div>
                <div class="card-body">
                    <table>
                        <form action="{{ route('push')}}" method="POST">
                            @csrf
                            @foreach ($school_name as $item)
                        <tr>
                            <td>
                                <h6>{{ $item }}</h6>
                            </td>
                        </tr>
                        @endforeach
                        @foreach ($school_id as $value)
                            <input hidden type="array" name="school_id[]" id="school_id" value="{{ $value }}">
                        @endforeach
                        
                        </form>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
