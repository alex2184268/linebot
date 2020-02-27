@extends('layouts.app')
<link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 ">
            <div class="card">
                <div class="card-header">學校管理</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="搜尋學校名稱" >
                    <input type="text" id="myInput2" onkeyup="myFunction2()" placeholder="搜尋地區" >
                    <label for=""></label>
                        <table id="myTable" class="table  table-bordered table-responsive table-primary text-black col-xs-10">
                            <thead>
                                <tr>
                                    <td>地區</td>
                                    <td>學校名稱</td>
                                    <td>學校類別</td>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($school as $value)
                                    <tr>
                                        <td>{{ $value->DISTRICT }}</td>
                                        <td>{{ $value->SCHOOL_NANE}}</td>
                                        <td>{{ $value->school_type}}</td>
                                    </tr>
                                @empty
                                    
                                @endforelse
                            </tbody>
                            
                        </table>
                        <script>
                            
                        function myFunction() {
                            // Declare variables
                            var input, filter, table, tr, td, i, txtValue;
                            input = document.getElementById("myInput");
                            filter = input.value.toUpperCase();
                            table = document.getElementById("myTable");
                            tr = table.getElementsByTagName("tr");
                            
                            // search td value,if not match return
                            for (i = 0; i < tr.length; i++) {
                                td = tr[i].getElementsByTagName("td")[0];//td element
                                if (td) {
                                    txtValue = td.textContent || td.innerText;
                                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                        tr[i].style.display = "";
                                    } else {
                                        tr[i].style.display = "none";
                                    }
                                }
                            }
                        }

                        function myFunction2(){
                            // Declare variables
                            var input, filter, table, tr, td, i, txtValue;
                            input = document.getElementById("myInput2");
                            filter = input.value.toUpperCase();
                            table = document.getElementById("myTable");
                            tr = table.getElementsByTagName("tr");
                            
                            // search td value,if not match return
                            for (i = 0; i < tr.length; i++) {
                                td = tr[i].getElementsByTagName("td")[2];//td element
                                if (td) {
                                    txtValue = td.textContent || td.innerText;
                                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                        tr[i].style.display = "";
                                    } else {
                                        tr[i].style.display = "none";
                                    }
                                }
                            }
                        }

                        
                        </script>

                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="col-md-12">
                <div class="fb-page" data-href="https://www.facebook.com/SonetPCR/?epa=SEARCH_BOX" data-tabs="timeline" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/SonetPCR/?epa=SEARCH_BOX" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/SonetPCR/?epa=SEARCH_BOX">超異域公主連結！ReDive Published by So-net</a></blockquote></div>
        </div>   -->
</div>


@endsection
