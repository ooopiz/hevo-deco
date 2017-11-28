@extends('pages.layout') @section('title', '關於百鐵 ｜日何百鐵') @section('inner-css') @endsection @section('content')

<div class="container-fluid">
    <div class="intro row">
        <span class="col-md-1">&#91;</span>
        <p class="col-md-10">非機械大量製造，也不是帶著距離的藝術品。由台灣傳統工廠老師傅手工製作的日常<br>生活用品。希望讓數十載製作經驗延續，運用想像力創造鈑金可能。我們賦予熟悉的鐵材<br>嶄新功能，結合多種樣貌。天天能使用且人人可擁有，在日常中發掘鐵之優美。
        </p>
        <span class="col-md-1">&#93;</span>
    </div>
</div>

<div class="brand-banner container-fluid">
    <img src="/images/about/about_banner.jpg">
</div>

<div class="brand-story container">
    <div class="row">
        <div class="col-md-6">
            <h2>每天使用<br>人人都可擁有的</h2>
            <h4>日何<svg class="odd-svg" width="350" height="10"><rect width="350" height="10" style="fill:#b1deda"/></svg></h4>
            <p>從家具家飾出發的日何百鐵, 與<b>擁有25年製作經驗的鐵工廠</b>共同合作開發, 利用資深師傅們的經驗, 結合新銳設計師的創造力。<br>希望能打造出適合現代日常生活的器具, 做出每個人能有機會擁有且想要使用的產品。<br>首波主打辦公桌上的工廠。試圖在單調的隔板中建構出賞心悅目的工作桌面。接下來將持續各種各類產品。
            </p>
        </div>
        <div class="col-md-4 col-md-offset-2">
            <img src="/images/about/1-tx.png">
        </div>
    </div>
</div>
<div class="brand-banner container-fluid">
    <img src="/images/about/about_banner-2.jpg">
</div>

<div class="brand-story container">
    <div class="row">
        <div class="col-md-4">
            <img src="/images/about/2-pcs.png">
        </div>
        <div class="col-md-6 col-md-offset-2">
            <h2>一片鐵<br>產出百種樣貌</h2>
            <h4><svg class="even-svg" width="350" height="10"><rect width="350" height="10" style="fill:#b1deda"/></svg>百鐵</h4>
            <p>金屬是被大家低估的材料, 對於鐵板的想像也只有鐵捲門排風管或是烤肉架。為了突破這樣的想像, 我們特別選擇使用廣泛但鮮為人知的材料, 比如像白鐵不鏽鋼、鍍鋅花板與黑鐵等...<br>並賦予這些熟悉的鈑金新的型態與功能<br>同樣地, 在這些物件中使用的方式依舊保持開放性<br>希望每個人都能創造出獨特的樣貌<br>除此之外, 商品們都可接受<b>尺寸調整</b>與<b>客製化</b>
            </p>
        </div>
    </div>
</div>

<div class="brand-banner container-fluid">
    <img src="/images/about/about_banner-3.jpg">
</div>

<div class="brand-story container">

    <div class="row">
        <div class="col-md-6">
            <h2>延續製作<br>手工的溫度</h2>
            <h4>黑手認證<svg class="odd-svg" width="350" height="10"><rect width="350" height="10" style="fill:#b1deda"/></svg></h4>
            <p>百鐵認真把關流程並且希望在收到產品時也能感受到師傅們的熱情, 在包裝內都會附張<b>沾上指紋的”黑手認證”貼紙</b>, 表示從設計到製作以及包裝每一道程序都充滿手感與專業。
            </p>
        </div>
        <div class="col-md-4 col-md-offset-2">
            <img src="/images/about/3-bkh.png">
        </div>
    </div>

</div>
<div class="social-links container">
    <div class="fb-like" data-href="https://www.facebook.com/hevodeco/" data-layout="button_count" data-action="like" data-size="large" data-show-faces="false" data-share="true"></div>


</div>

@section('inner-js')
<script>
    document.getElementById('nav-4').style.borderBottom = "0.4rem solid #b0bec5";
</script>
@endsection @endsection