<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>桃園市教育局LineBot管理系統</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background: url("/background-header.jpeg");
                background-size : cover; 
                color: #1ce6ed;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #1ca7ed;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">管理介面</a>
                    @else
                        <a href="{{ route('login') }}">管理登入</a>

                        @if (Route::has('register'))
                            <!--<a href="{{ route('register') }}">註冊</a> -->
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    桃園市教育局LineBot管理系統
                </div>

                <div class="links">
                    <a href="https://sso.tyc.edu.tw/TYESSO/Login.aspx" target="_blank">單一認證授權平台</a>
                    <a href="https://www.tycg.gov.tw/edu/" target="_blank">教育局網站</a>
                    <a href="https://drp.tyc.edu.tw/TYDRP/Index.aspx" target="_blank">教育發展資源入口網</a>
                    <a href="https://teos.tyc.edu.tw" target="_blank">教育公務入口(TEOS)</a>
                </div>
            </div>
        </div>
    </body>
</html>
