<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('asset/css/bootstrap.min.css')}}">

</head>
<body>
    
    <div class="container-fluid">
        <div class="row">
            <style>
                #sidebar{
                    height: auto;
                    width: 100%;
                    background: #333;
                    position: relative;
                    display: block;
                }
                #logo img{
                    margin-top: 10px; 
                    width: 100px;
                    height: 100px;
                    z-index: 9999;
                    border-radius: 50%;
                    border: 2px solid aliceblue
                }
            </style>
            <div class="col-2" id="sidebar">
               <div class="logo text-center" id="logo">
                <img class="img-fluid" src="https://cf.ltkcdn.net/cats/images/std/259025-800x515r1-gorgeous-grey-cat-breeds.jpg" alt="" >
            </div>
            </div>
            <div class="col-10">
                @yield('content')
            </div>
        </div>
    </div>
    
    <script type="text/javascript" src="{{asset('asset/js/bootstrap.min.js')}}"></script>
</body>
</html>