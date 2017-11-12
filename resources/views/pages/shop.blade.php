@extends('pages.layout')

@section('title', '銷售通路 ｜日何百鐵')

@section('inner-css')
@endsection

@section('content')

    <div class="shop-info container-fluid">
        <div class="row">
            <div class="col-md-3 col-md-offset-2">
                <h3>零售</h3>
            </div>
            <div class="col-md-7">
                <h6>網路商店</h6>
                <ul>
                    <li><a href="http://www.books.com.tw/web/sys_brand/0/0000015475" target="_blank">博客來</a></li>
                    <li><a href="http://www.gq.com.tw/shop/theme-116.html" target="_blank">GQShop</a></li>
                    <li><a href="https://www.pinkoi.com/store/hevo" target="_blank">Pinkoi</a></li>
                </ul>
                <h6>實體通路</h6>
                <ul>
                    <li><a href="https://goo.gl/maps/YPWzHquAXST2" target="_blank">Ichijiku Cafe &amp; Living</a>&nbsp;&nbsp; 台北市永康街91-1號2樓</li>
                </ul>
            </div>
        </div>
        <div class="col-md-10 col-md-offset-1">
            <hr style="border-top:1px dashed #ced7db">
        </div>
        <div class="row">
            <div class="col-md-3 col-md-offset-2">
                <h3>訂製</h3>
            </div>
            <div class="col-md-7">
                <h6>家具家飾</h6>
                <ul>
                    <li><a>訂購需求</a>&nbsp;&nbsp; 填寫</li>

                </ul>
            </div>
        </div>
    </div>
@section('inner-js')
<script>
    document.getElementById('nav-3').style.borderBottom = "0.4rem solid #b0bec5";
</script>
@endsection 

@endsection
