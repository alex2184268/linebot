@extends('layouts.app')

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">確認發送訊息</div>
                <div class="card-body">
                    <form class="form-horizontal" method="POST" action="{{ route('value') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="control-group">
                            <div class="inc">
                                <div class="controls">
                                    <button style="margin-left: 50px" class="btn btn-info" type="submit" id="append"
                                        name="append">新增文字訊息</button>
                                    <button style="margin-left: 50px" class="btn btn-info" type="submit" id="image"
                                        name="image">新增圖片或影片訊息</button>
                                    <br>
                                    <br>
                                </div>
                            </div>
                            @foreach($school as $item)
                                <input hidden type="text" name="school[]" value="{{ $item }}">
                            @endforeach
                            <button type="submit" name="SubmitMessage" class="btn btn-primary"  disabled>發送訊息</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
        var num = 0;
        jQuery(document).ready(function () {
            $("#image").click(function (e) {
                e.preventDefault();
                $(".inc").append(`<div class="controls">\
                <input class="form-control" type="file" name="${num}" id="file" multiple="multiple">\
                <a href="#" class="remove_this btn btn-danger">移除</a>\
                <br>\
                <br>\
            </div>`);
                num++;
                return false;
            });

            $("#append").click(function (e) {
                e.preventDefault();
                $(".inc").append(`<div class="controls">\
                <textarea name="${num}" id="textarea" cols="50" rows="5"></textarea>\
                <a href="#" class="remove_this btn btn-danger">移除</a>\
                <br>\
                <br>\
            </div>`);
                num++;
                return false;
            });

            jQuery(document).on('click', '.remove_this', function () {
                jQuery(this).parent().remove();
                num--;
                return false;
            });
            $("input[type=submit]").click(function (e) {
                e.preventDefault();
                $(this).next("[name=textbox]")
                    .val(
                        $.map($(".inc :text"), function (el) {
                            return el.value
                        }).join(",\n")
                    )
            })

        });
</script>
@endsection
