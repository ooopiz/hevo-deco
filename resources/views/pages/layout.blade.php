<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="hevodeco | design factory on metal making">
    <meta name="keywords" content="metal,design,factory" />
    <meta name="author" content="erco L.">
    <meta property="og:title" content="hevo | 日何百鐵">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <meta property="og:description" content="非機械大量製造,也不是帶著距離的藝術品.由台灣傳統工廠老職人手工製作的日常生活用品.希望讓數十載製作經驗延續,運用想像力創造鈑金可能.我們選擇賦予熟悉的鐵材嶄新功能,結合多種樣貌.天天能使用且人人可擁有,在日常中發掘鐵之優美.">
    
    <title>@yield('title')</title>
    <link rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico">
    <link href="/dist/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/dist/font-awesome/css/font-awesome.min.css" rel="stylesheet" >
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
                        <li>hevodeco@gmail.com</li>
                        <li>+886 912345678</li>
                        <li>GMT +8 10:00~18:00</li>
                    </ul>
                </div>
                <div class="col-md-3 footer-item">
                    <h4>Social | 社群</h4>
                    <ul>
                        <li><a href="https://www.facebook.com/hevodeco">Facebook</a></li>
                        <li><a href="#">Pinterest</a></li>
                        <li><a href="https://www.instagram.com/hevo_deco/">Instagram</a></li>
                    </ul>

                </div>
                <div class="col-md-3 footer-item">
                    <h4>Downloads | 型錄</h4>
                    <ul>
                        <li><a href="#">Brochure AW17</a></li>
                        <li><a href="#">Media Kit</a></li>
                        <li><a href="#">Customization Guide</a></li>
                    </ul>
                </div>
                <div class="col-md-3 footer-item">
                    <h4>Subscribe | 訂閱</h4>
                    <ul>
                        <li>隨時掌握新品訊息</li>
                        <li>
                            <div class="subscribe">
                                <button href="#">前往</button>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>

    <!-- jQuery 3 -->
    <script src="/dist/js/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="/dist/bootstrap/js/bootstrap.min.js"></script>

    @yield('inner-js')

</body>

</html>