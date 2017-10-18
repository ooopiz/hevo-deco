@extends('pages.layout')

@section('title', '首頁 ｜日何百鐵')

@section('inner-css')
@endsection

@section('content')
<div class="container">
    <div id="home-slide" data-ride="carousel" class="carousel slide turn-on">
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
            <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
        </ol>
        <div role="listbox" class="carousel-inner">
            <div class="item">
                <img src="imgs/_MG_0733-.jpg" alt="桌上的工廠系列">
                <div class="carousel-caption"> </div>
            </div>
            <div class="item active">
                <img src="imgs/f2_2016-10-07.jpg" alt="桌上的工廠系列">
                <div class="carousel-caption"> </div>
            </div>
            <div class="item">
                <img src="imgs/banner-dark.jpg" alt="桌上的工廠系列">
                <div class="carousel-caption"></div>
            </div>
        </div>
    </div>

    <div id="home-product-list">
        <div class="row">
              <div class="col-md-4 product-item">
                  <img src="https://instagram.ftpe7-3.fna.fbcdn.net/t51.2885-15/e35/21373492_280126235819921_8589130264884543488_n.jpg" alt="Candle Holder 燭台 #hevodeco #balckmetal #homedecor #madeintaiwan #lasercut #deskdecor #candleholder #homedecor #homedesign #homedecoration #interiordesign #interiordecorating #design #designlife #designweek #minimalist">
                  <h4>14-Aug-2017</h4>
                  <p>Candle Holder 燭台 #hevodeco #balckmetal #homedecor #madeintaiwan #lasercut #deskdecor #candleholder #homedecor #homedesign #homedecoration #interiordesign #interiordecorating #design #designlife #designweek #minimalist</p>
              </div>
              <div class="col-md-4 product-item">
                  <img src="https://instagram.ftpe7-3.fna.fbcdn.net/t51.2885-15/e35/14099324_1654251114886693_290373793_n.jpg">
                  <h4>14-Aug-2017</h4>
                  <p>Fruits vs Tray #minimalist #tray #fruits #hevodeco #lifestyle #healthylife #productdesign #green🌿 #natural #拜拜 #設計 #tbt #homedesign #composition #instadecor #display #decor #instamood #interior #product #interiordesign</p>
              </div>
              <div class="col-md-4 product-item">
                  <img src="https://instagram.ftpe7-3.fna.fbcdn.net/t51.2885-15/e35/14240554_1676146632711851_1364680922_n.jpg">
                  <h4>19-Jun-2016</h4>
                  <p>Happy green life day! We love plants! #hevodeco #design #picoftheday #green #taiwan #composition #beautiful #metal #designyourlife #instagood</p>
              </div>
        </div>
        <div class="row">
              <div class="col-md-4 product-item">
                  <img src="https://instagram.ftpe7-3.fna.fbcdn.net/t51.2885-15/e35/14473970_376893872657087_6593636129281409024_n.jpg">
                  <h4>22-May-2017</h4>
                  <p>A new stuff to get away Monday blue! #hevodeco #design #tool #simplicity #table #tray #bnw #cnc #cncmachining #industrial #industrialdesign #rustic #grind #housedecor #blue #art #interior #interiordesign #interiordesigner #instadecor #homedesign #decor #composition #designstudio #tbt #explore #metal #discovery #lasercut #instagood</p>
              </div>
              <div class="col-md-4 product-item">
                  <img src="https://instagram.ftpe7-3.fna.fbcdn.net/t51.2885-15/e35/14295471_760441397392059_631270828_n.jpg">
                  <h4>22-May-2017</h4>
                  <p>Checking out a special vase today! #hevodeco #design #minimalist #simplicity #metal #nature #details #ideas #designer #interiordesign #product #style #art #plants #vase #interior #display #instaoftheday #instadecor #homedesign #decor #tbt #instamood</p>
              </div>
              <div class="col-md-4 product-item">
                  <img src="https://instagram.ftpe7-3.fna.fbcdn.net/t51.2885-15/e35/14031579_846101505491696_1258571773_n.jpg">
                  <h4>04-May-2016</h4>
                  <p>Pattern #hevodeco #metal #material #design #originals #industrial #new #home #decoration #pattern</p>
              </div>
        </div>
        <div class="row">
              <div class="col-md-4 product-item">
                  <img src="https://instagram.ftpe7-3.fna.fbcdn.net/t51.2885-15/e35/17818888_604726593049860_6421236326703562752_n.jpg">
                  <h4>10-Apr-2017</h4>
                  <p>總是覺得桌上太多線太亂嗎？我們想到方法讓他們有秩序不亂跑囉！Always having too many cables on your desk? We could help you out! 😄 #hevodeco #cableholder #instagood #desinger #product #photooftheday #homedecor #designinspiration #designbyme #interiordesign #rustic #black #cnc #lasercut #roughdesign #handmade #industrialdesign</p>
              </div>
              <div class="col-md-4 product-item">
                  <img src="https://instagram.ftpe7-3.fna.fbcdn.net/t51.2885-15/e35/14156149_1691830891137163_1161992585_n.jpg">
                  <h4>29-Agu-2016</h4>
                  <p>Metal #hevodeco #metal #material #magnet #design #originals #industrial #colours</p>
              </div>
              <div class="col-md-4 product-item">
                  <img src="https://instagram.ftpe7-3.fna.fbcdn.net/t51.2885-15/e35/14596813_364020547279165_8991988211450380288_n.jpg">
                  <h4>21-Mar-2016</h4>
                  <p>Tools #hevodeco #design #tool #simplicity #sheetmetal #details #ideas #designer #interiordesign #product #style #art #interior #display #instaoftheday #instadecor #homedesign #decor #composition #designstudio #tbt #instamood #workspace #instagood</p>
              </div>
        </div>
    </div>
</div>


@endsection

@section('inner-js')
@endsection
