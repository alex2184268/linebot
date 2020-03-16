@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">選擇群組</div>
                
                <div class="card-body">
                    <form action="">
                        @foreach ($district as $value)
                            <tr>
                                <td>
                                    <h4>{{ $value->DISTRICT }}</h4>
                                    @foreach ($school as $item)
                                        @if ($value->id == $item->district_id)
                                        <h6>{{ $item->SCHOOL_NAME }}</h6>
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
