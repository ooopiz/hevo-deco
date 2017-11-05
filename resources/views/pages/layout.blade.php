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

    <link href="{{ asset('/sb-admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/sb-admin/css/sb-admin.css') }}" rel="stylesheet">
    <link href="{{ asset('/sb-admin/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('/css/pages.css') }}" rel="stylesheet">
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
                    <li><a href="{{ URL_HOME }}">Home | 最新消息</a></li>
                    <li><a href="{{ URL_PRODUCT }}">Product | 產品</a></li>
                    {{--<li><a href="#">Shop | 商店</a></li>--}}
                    <li><a href="{{ URL_ABOUT }}">About | 關於百鐵</a></li>
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
                            <div class="form-group">
                                {{--<input type="email" class="form-control" id="exampleInputEmail1" placeholder="請輸入你的e-mail">--}}
                                {{--<input type="submit" value="確認">--}}
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>

    {{--<script src="{{ asset('/sb-admin/js/jquery.js') }}"></script>--}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{ asset('/sb-admin/js/bootstrap.min.js') }}"></script>

@yield('inner-js')

</body>
</html>
