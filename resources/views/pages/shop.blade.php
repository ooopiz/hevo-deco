@extends('pages.layout') @section('title', '銷售通路 ｜日何百鐵') @section('inner-css') @endsection @section('content')

<div class="shop-info container-fluid">
    <div class="row">
        <div class="col-md-3 col-md-offset-2">
            <h3>零售</h3>
        </div>
        <div class="col-md-7">
            <h6>網路商店</h6>
            <ul class="web-shops">

                <li><a href="https://www.pinkoi.com/store/hevo" target="_blank">Pinkoi</a></li>

                <li><a href="http://udesign.udnfunlife.com/mall/cus/cat/Cc1c01.do?dc_cateid_0=0_059_049_391" target="_blank">uDesign</a></li>

                <li><a href="http://www.playdesignhotel.com/selections" target="_blank">玩味旅舍</a></li>

                <li><a href="https://theartling.com/en/designers/hevo-deco/" target="_blank">The Artling</a></li>
            </ul>
            <h6>實體通路</h6>
            <ul class="distributors">
                <li><a href="https://goo.gl/maps/YPWzHquAXST2" target="_blank">Ichijiku Cafe &amp; Living</a><span>&nbsp;</span>
                    <p>台北市永康街91-1號2樓</p>
                </li>

                <li><a href="https://www.scenehomeware.com/shop/product/3262" target="_blank">光景Scene Homeware</a><span>&nbsp;</span>
                    <p>台北市松山區民生東路三段130巷18弄11號1樓</p>
                </li>

                <li><a href="https://www.facebook.com/cubexlife" target="_blank">Cubex</a><span>&nbsp;</span>
                    <p>台北市大安區大安路一段169巷6號1F</p>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-md-10 col-md-offset-1">
        <hr style="border-top:1px dashed #ced7db" width="80%">
    </div>
    <div class="row">
        <div class="col-md-3 col-md-offset-2">
            <h3>訂製</h3>
        </div>
        <div class="col-md-7">
            <h6>家具家飾</h6>
            <ul class="bespoke-furniture">
                <li><a href="https://www.facebook.com/messages/t/896973380414328" target="_blank">訂購需求</a>&nbsp;&nbsp; 告知</li>
                <li><a href="https://www.dropbox.com/s/s6se79rfbiqry7f/hevodeco_aw17.pdf?dl=0" target="_blank">商品型錄</a>&nbsp;&nbsp; 下載</li>

            </ul>
        </div>
    </div>
</div>
@section('inner-js')
<script>
    document.getElementById('nav-3').style.borderBottom = "0.4rem solid #b0bec5";
    document.getElementById('nav-small-3').style.borderBottom = "0.4rem solid #b0bec5";
</script>
@endsection @endsection