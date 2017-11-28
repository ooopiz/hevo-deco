<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="hevo | design factory on metal making">
    <meta name="keywords" content="metal,design,factory" />
    <meta name="author" content="erco L., Ricky H.">
    <meta property="og:title" content="hevo | 日何百鐵">
    <meta property="og:url" content="http://www.hevodeco.com">
    <meta property="og:image" content="">
    <meta property="og:description" content="非機械大量製造,也不是帶著距離的藝術品.由台灣傳統工廠老職人手工製作的日常生活用品.希望讓數十載製作經驗延續,運用想像力創造鈑金可能.我們選擇賦予熟悉的鐵材嶄新功能,結合多種樣貌.天天能使用且人人可擁有,在日常中發掘鐵之優美.">

    <title>@yield('title')</title>
    <link rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico">
    <link href="/dist/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/dist/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="/css/pages.css" rel="stylesheet">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-109562241-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-109562241-1');
    </script>

    @yield('inner-css')

</head>

<body>
    <div class="page-wrapper">
        <header class="container">
            <div id="header">
                <img class="logo" src="/images/logo.png">
            </div>
        </header>

        <nav class="container m-shift">
            <div id="nav-main">
                <ul>
                    <li><a id="nav-1" href="{{ URL_HOME }}">Home | 最新消息</a></li>
                    <li><a id="nav-2" href="{{ URL_PRODUCT }}">Product | 產品</a></li>
                    <li><a id="nav-3" href="{{ URL_SHOP }}">Shop | 銷售通路</a></li>
                    <li><a id="nav-4" href="{{ URL_ABOUT }}">About | 關於百鐵</a></li>
                </ul>
            </div>
        </nav>

        <div class="main-body">
            @yield('content')
        </div>

        <footer class="container">
            <div id="footer" class="row">
                <div class="col-md-3 footer-item">
                    <h4>Contact | 聯絡方式</h4>
                    <ul>
                        <li>hevodeco&#64;gmail.com</li>
                        <li>+886 &#57;6&#49;-&#x30;&#48;6-89&#53;</li>
                        <li>GMT +8 10:00~18:00</li>
                    </ul>
                </div>
                <div class="col-md-3 footer-item">
                    <h4>Social | 社群</h4>
                    <ul>
                        <li><a href="https://www.facebook.com/hevodeco" target="_blank">Facebook</a></li>
                        <li><a href="https://www.pinkoi.com/store/hevo?ref_itemlist_tid=gQZ7A5tz&ref_itemlist=dDxsWVu4" target="_blank">Pinkoi</a></li>
                        <li><a href="https://www.instagram.com/hevo_deco/" target="_blank">Instagram</a></li>
                    </ul>

                </div>
                <div class="col-md-3 footer-item">
                    <h4>Downloads | 型錄</h4>
                    <ul>
                        <li><a href="https://www.dropbox.com/s/s6se79rfbiqry7f/hevodeco_aw17.pdf?dl=0" target="_blank">Brochure AW17</a></li>
                        <li><a href="https://www.dropbox.com/s/p06l00c6r5qgzt3/HEVO%20%E5%93%81%E7%89%8C%E4%BB%8B%E7%B4%B9.pdf?dl=0" target="_blank">Media Kit</a></li>
                        <li><a href="https://www.dropbox.com/s/zo3vuymbtyf7poh/customize.pdf?dl=0" target="_blank">Customization Guide</a></li>
                    </ul>
                </div>
                <div class="col-md-3 footer-item">
                    <h4>Subscribe | 訂閱</h4>
                    <ul>
                        <li>隨時掌握新品訊息</li>
                        <li>
                            <div class="subscribe">
                                <a href="http://eepurl.com/da8F-z" target="_blank">輸入e-mail</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row disclaimer">
                <h6>Copyright © 2017 hevo - All rights reserved<br>Creative Direction by erco Laii</h6>
            </div>
        </footer>
    </div>
    <!--FB sdk-->
    <div id="fb-root"></div>
        <script>
            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s);
                js.id = id;
                js.src = 'https://connect.facebook.net/zh_TW/sdk.js#xfbml=1&version=v2.11&appId=127843113974306';
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>

    <!-- jQuery 3 -->
    <script src="/dist/js/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="/dist/bootstrap/js/bootstrap.min.js"></script>

    @yield('inner-js')

</body>

</html>