<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <script charset="utf-8" src="https://static.line-scdn.net/liff/edge/2/sdk.js"></script>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>桃園市教育局Line註冊頁面</title>
        <!-- Fonts -->

        <!-- Styles -->
        <style>

        </style>
    </head>
    <body>
      <script>
        const liffID = "1654982141-5QN28106";
        liff.init({
          liffId: liffID
        }).then(function() {
          console.log('LiIFF is starting');
        }).catch((err) => {
          //錯誤訊息
          console.log(err.code, err.message); //顯示錯誤代碼及錯誤訊息
        });
      </script>
    </body>
</html>
