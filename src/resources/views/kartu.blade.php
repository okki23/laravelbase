
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Member - {{ $data->member_name }}</title>
    <style>

        @import url('https://fonts.googleapis.com/css?family=Muli');

        /*reset*/
        * {
        margin: 0;
        padding: 0;
        }

        /*product info */

        h1 {
        color: black;
        font-family: "muli";
        font-weight: bold;
        font-size: 22px;
        margin-top: 21px;
        display: inline-block;
        }

        i.fa.fa-search {
        margin-left: 90px;
        }

        .product-name i {
        color: #ffffff;
        transition: 0.3s all ease;
        margin: 0px 12px;
        }

        .product-name i:hover {
        color: #ff6d39;
        cursor: pointer;
        }

        h3 {
        color: black;
        font-family: "muli";
        margin-top: 84px;
        margin-bottom: 10px;
        font-size: 22px;
        font-weight: bold;
        }

        h2 {
        color: black;
        font-family: "muli";
        margin-top: 0px;
        margin-bottom: -20px;
        font-weight: 800;
        font-size: 29px;
        }

        h4 {
        display: inline-block;
        color: black;
        font-family: "muli";
        margin-top: 10px;
        font-weight: bold;
        font-size: 20px;
        }

        h4.dis {
        display: inline-block;
        color: #ffffff;
        font-family: "muli";
        font-weight: 400;
        font-size: 17px;
        margin-left: 30px;
        text-decoration: line-through #ea3201;
        }

        h4.dis span {
        text-decoration: line-through #ea3201;
        }

        .discount {
        display: inline-block;
        }

        ul {
        list-style-type: none;
        }

        li {
        display: inline-block;
        margin-right: 25px;
        }

        ul li {
        color: #ffffff;
        font-family: "muli";
        margin-top: 20px;
        font-weight: 500;
        font-size: 11px;
        }

        .bg {
        width: 15px;
        height: 15px;
        text-align: center;
        padding: 2px;
        margin-right: 20px;
        transition: 0.3s all ease;
        border-radius: 50%;
        }

        .bg:hover {
        background-color: white;
        border-radius: 50%;
        width: 15px;
        height: 15px;
        cursor: pointer;
        }

        .yellow {
        content: "";
        width: 13px;
        height: 13px;
        background-color: #fec60f;
        border-radius: 50%;
        border: 2px solid rgba(0, 0, 0, 0);
        transition: 0.3s all ease;
        }

        .black {
        content: "";
        width: 13px;
        height: 13px;
        background-color: #000000;
        border-radius: 50%;
        border: 2px solid rgba(0, 0, 0, 0);
        transition: 0.3s all ease;
        }

        .blue {
        content: "";
        width: 13px;
        height: 13px;
        background-color: #02a2ca;
        border-radius: 50%;
        border: 2px solid rgba(0, 0, 0, 0);
        transition: 0.3s all ease;
        }

        .yellow:hover,
        .black:hover,
        .blue:hover {
        border: 2px solid white;
        width: 13px;
        height: 13px;
        border-radius: 50%;
        cursor: pointer;
        }

        .foot {
        color: black;
        font-family: "muli";
        margin-top: 20px;
        margin-right: 50px;
        font-weight: 500;
        font-size: 11px;
        float: left;
        transition: 0.3s all ease;
        }

        .foot i:nth-child(1) {
        margin-left: 0;
        margin-right: 15px;
        }

        .foot:hover {
        color: #f76b39;
        cursor: pointer;
        }

        /*shoe slider indicator*/

        .left i {
        color: #ffd5c6;
        margin-top: 260px;
        transition: 0.3s all ease;
        }

        .fa-long-arrow-left {
        margin-left: -275px;
        }

        .fa-long-arrow-right {
        margin-left: 15px;
        }

        .left i:hover {
        cursor: pointer;
        color: #2a2f40;
        }

        /*main card*/

        .card {
        display: flex;
        align-items: center;
     
        height: 600px;
        width: 800px;
        margin: 0 auto;
        box-shadow: 0px 15px 50px 10px rgba(0, 0, 0, 0.4);
        margin-top: 2%;
        }

        .left {
        content: "";
        height: 395px;
        width: 330px;
        display: flex;
        align-items: center;
        background-color: white;
        margin-left: 93px;
        border-radius: 0% 50% 50% 0%;
        position: absolute;
        z-index: 5;
        }

        .left img {
        margin-left: -88px;
        margin-top: 60px;
        }

        .right {
        content: "";
        height: 395px;
        width: 550px;
        background-color: greenyellow;
        z-index: 3;
        margin-left: 200px;
        }

        .product-info {
        position: absolute;
        margin-left: 245px;
        height: 394px;
        width: 305px;
        z-index: 10;
        }


    </style>
</head>
<body>
    

  <div class="card">
    <div class="left">
        @if($data->foto == null || $data->foto == '' || !$data->foto)
            <img src="https://cdn.onlinewebfonts.com/svg/img_76927.png" style="width: 70%; height: 60%; float: left; margin-left: 60px; margin-top:-20px;" alt="memberprofile">
        @else 
            <img src="{{ asset('uploads/'.$data->foto) }}" style="border-radius:50%; width: 70%; height: 60%; float: left; margin-left: 60px; margin-top:-20px;" alt="memberprofile">
        @endif 
      <i class="fa fa-long-arrow-left"></i>
      <i class="fa fa-long-arrow-right"></i>
    </div>
    <div class="right">
      <div class="product-info">
        <div class="product-name">
          {{-- <h1>AKAGYM</h1> --}} 
          <img src="{{ asset('assets/img/akalogo.png') }}" alt="" style="width: 80%; height:80%; margin-bottom:-60px; float:left; margin-left:60px;">
          
          <i class="fa fa-search"></i>
          <i class="fa fa-user"></i>
          <i class="fa fa-shopping-cart"></i>
        </div>
        <div class="details"> 
          <h3>{{ $data->member_name }}</h3> 
          {!! DNS1D::getBarcodeHTML($data->barcode, 'PHARMA',3,60,'black',true) !!}
        </div>
        
      
      </div>
    </div>
  </div>


</body>
</html>