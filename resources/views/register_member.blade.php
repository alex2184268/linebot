<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <script charset="utf-8" src="https://static.line-scdn.net/liff/edge/2/sdk.js"></script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
    integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
  </script>
  <title>桃園市教育局Line註冊頁面</title>
  <!-- Fonts -->

  <!-- Styles -->
  <style>

  </style>
</head>

<body>
  <div class="container">
    <div class="card-body text-center">
      <form method="post" action="{{ route('register_info') }}">
        @csrf
        <div class="text-center mb-auto mx-auto ">
          <img class="mb-4" src="https://www.tycg.gov.tw/edu/img/_logo.png" alt="">
          <h1 class="h3 mb-3 font-weight-normal">桃園市教育局LINE註冊</h1>
          <p>請選擇您的學校，等待管理員審核後即可收到桃園市教育局LINE通知訊息</p>
        </div>
        @if($errors->any())
          <h4>{{ $errors->first() }}</h4>@endif
          <div class="form-label-group">
            <input type="text" id="YourProfile" name="YourProfile" value="" hidden>
          </div>
          <div class="form-label-group">
            <label for="name">姓名：</label>
            <input type="text" id="name" name="name" value="" required>
          </div>
          </br>
          <div class="form-label-group">
            <label for="phone">電話：</label>
            <input type="text" id="phone"" name=" phone" value="" required>
          </div>
          </br>
          <div class="form-label-group ">
            <label for="district_list">選擇地區</label>
            <select name="district_list" id="district_list" onchange="ChangeSchool(this.value)" class="form-control"
              style="width:auto;"></select>
          </div>
          </br>
          <div class="form-label-group">
            <label for="school_list">選擇學校</label>
            <select name="school_list" id="school_list" class="form-control" style="width:auto;"></select>
          </div>
          </br>
          <button class="btn btn-primary " type="submit">註冊</button>
      </form>
    </div>
  </div>
  <!--<label for="browserLanguage">語言:</label>
      <p id="browserLanguage"></p>
      
      <label for="sdkVersion">LIFF SDK版本:</label>
      <p id="sdkVersion"></p>
      
      <label for="isInClient">LINE APP存取:</label>
      <p id="isInClient"></p>
      
      <label for="isLoggedIn">登入狀態:</label>
      <p id="isLoggedIn"></p>
      
      <label for="deviceOS">OS平台:</label>
      <p id="deviceOS"></p>
      
      <label for="lineVersion">LINE版本:</label>
      <p id="lineVersion"></p>-->
</body>
      <script>
        var district = @json($district); //地區陣列
        var school = @json($school); //學校陣列
        var ChangeSelect = document.getElementById('district_list'); //取的地區select HTML
        console.log(district);
        console.log(school);

        var inner = "<option value=''></option>"; //宣告inner 用來儲存HTML option存放到distirct-list

        for (var i = 0; i < district.length; i++) {
          inner = inner + '<option value=' + district[i]['id'] + '>' + district[i]['DISTRICT'] + '</option>'; //LOOP把option存放到inner陣列
        }
        ChangeSelect.innerHTML = inner; //將變數inner放回HTML 變成option

        const liffID = "1654982141-5QN28106"; //桃園市政府LIFF ID
        liff.init({ //初始化
          liffId: liffID
        }).then(function () {
          console.log('LiIFF is starting');
          const idToken = liff.getIDToken(); //
          if (!liff.isLoggedIn()) {
            alert('You not logged in yet!! '); //尚未登入時返回此訊息
            window.location.replace("http://www.google.com");
          }
          //console.log(idToken);
          displayLiffData();
        }).catch((err) => {
          //錯誤訊息
          console.log(err.code, err.message); //顯示錯誤代碼及錯誤訊息
        });



        /*** Display data generated by invoking LIFF methods*/
        function displayLiffData() {
          /*document.getElementById('browserLanguage').textContent = liff.getLanguage();//LIFF的語言
          document.getElementById('sdkVersion').textContent = liff.getVersion();//LIFF 版本
          document.getElementById('isInClient').textContent = liff.isInClient();// 回傳是否由 LINE App 存取
          document.getElementById('isLoggedIn').textContent = liff.isLoggedIn();//是否登入LINE
          document.getElementById('deviceOS').textContent = liff.getOS();//裝置的平台
          document.getElementById('lineVersion').textContent = liff.getLineVersion();//LINE的版本*/
          liff.getProfile()
            .then(profile => {
              const userId = profile.userId;
              document.getElementById('YourProfile').value = userId; //取得使用者資料
            })
            .catch((err) => {
              console.log('error', err);
            });

        }

        function ChangeSchool(index) { //取得select value
          var schoolInner = "";
          var schoolSelect = document.getElementById('school_list');
          for (var i = 0; i < school.length; i++) {
            if (index == school[i]['district_id'])
              schoolInner = schoolInner + '<option value=' + school[i]['id'] + '>' + school[i]['SCHOOL_NAME'] + '</option>';
          }
          schoolSelect.innerHTML = schoolInner;
        }
        ChangeSchool(document.getElementById("school_list").value);
      </script>
    </body>
</html>
