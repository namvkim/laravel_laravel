<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel </title>
    <link href='http://fonts.googleapis.com/css?family=Dosis:300,400' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/dest/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/dest/vendors/colorbox/example3/colorbox.css">
    <link rel="stylesheet" href="assets/dest/rs-plugin/css/settings.css">
    <link rel="stylesheet" href="assets/dest/rs-plugin/css/responsive.css">
    <link rel="stylesheet" title="style" href="assets/dest/css/style.css">
    <link rel="stylesheet" href="assets/dest/css/animate.css">
    <link rel="stylesheet" title="style" href="assets/dest/css/huong-style.css">
</head>

<body>

    <div id="header">
        <div class="header-top">
            <div class="container">
                <div class="pull-left auto-width-left">
                    <ul class="top-menu menu-beta l-inline">
                        <li><a href=""><i class="fa fa-home"></i> 90-92 Lê Thị Riêng, Bến Thành, Quận 1</a></li>
                        <li><a href=""><i class="fa fa-phone"></i> 0163 296 7751</a></li>
                    </ul>
                </div>
                <div class="pull-right auto-width-right">
                    <ul class="top-details menu-beta l-inline">
                        @if (isset($formData))
                            @if ($formData['acceptoken'])
                                <li><a href="#"><i class="fa fa-user"></i>Chào bạn
                                        {{ $formData['user']->full_name }}</a>
                                </li>
                                <li><a href="/login">Đăng xuất</a></li>
                            @else
                                <script>
                                    alert('ban sai tai khoan hoac mat khau');
                                </script>
                            @endif
                        @endif
                        <li><a href="/signup">Đăng kí</a></li>
                        <li><a href="/login">Đăng nhập</a></li>
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div> <!-- .container -->
        </div> <!-- .header-top -->
        <div class="header-body">
            <div class="container beta-relative">
                <div class="pull-left">
                    <a href="index.html" id="logo"><img src="assets/dest/images/logo-cake.png" width="200px" alt=""></a>
                </div>
                <div class="pull-right beta-components space-left ov">
                    <div class="space10">&nbsp;</div>
                    <div class="beta-comp">
                        <form role="search" method="get" id="searchform" action="/">
                            <input type="text" value="" name="s" id="s" placeholder="Nhập từ khóa..." />
                            <button class="fa fa-search" type="submit" id="searchsubmit"></button>
                        </form>
                    </div>

                    <div class="beta-comp">
                        <div class="beta-comp">
                            @if (Session::has('cart'))
                                <div class="cart">
                                    <div class="beta-select"><i class="fa fa-shopping-cart"></i> Giỏ hàng (@if (Session::has('cart'))
                                            {{ Session('cart')->totalQty }}
                                        @else Trống @endif) <i class="fa fa-chevron-down"></i></div>

                                    <div class="beta-dropdown cart-body">
                                        @foreach ($productCarts as $product)
                                            <div class="cart-item">
                                                <a class="cart-item-delete"
                                                    href="{{ route('banhang.xoagiohang', $product['item']['id']) }}"><i
                                                        class="fa fa-times"></i>
                                                </a>
                                                <div class="media">
                                                    <a class="pull-left" href="#"><img
                                                            src="/image/product/{{ $product['item']['image'] }}"
                                                            alt=""></a>
                                                    <div class="media-body">
                                                        <span
                                                            class="cart-item-title">{{ $product['item']['name'] }}</span>
                                                        <span class="cart-item-amount">{{ $product['qty'] }}*<span>
                                                                @if ($product['item']['promotion_price'] == 0)
                                                                    {{ number_format($product['item']['unit_price']) }}@else
                                                                    {{ number_format($product['item']['promotion_price']) }}
                                                                @endif
                                                            </span></span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        <div class="cart-caption">
                                            <div class="cart-total text-right">Tổng tiền: <span
                                                    class="cart-total-value">{{ $cart->totalPrice }}</span></div>
                                            <div class="clearfix"></div>

                                            <div class="center">
                                                <div class="space10">&nbsp;</div>
                                                <a href="{{ route('banhang.getdathang') }}"
                                                    class="beta-btn primary text-center">Đặt hàng <i
                                                        class="fa fa-chevron-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- .cart -->
                            @endif
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div> <!-- .container -->
    </div> <!-- .header-body -->
    <div class="header-bottom" style="background-color: #0277b8;">
        <div class="container">
            <a class="visible-xs beta-menu-toggle pull-right" href="#"><span class='beta-menu-toggle-text'>Menu</span>
                <i class="fa fa-bars"></i></a>
            <div class="visible-xs clearfix"></div>
            <nav class="main-menu">
                <ul class="l-inline ov">
                    <li><a href="/">Trang chủ</a></li>
                    <li><a href="#">Sản phẩm</a>
                        <ul class="sub-menu">
                            <li><a href="product_type">Sản phẩm 1</a></li>
                            <li><a href="product_type">Sản phẩm 2</a></li>
                            <li><a href="product_type">Sản phẩm 4</a></li>
                        </ul>
                    </li>
                    <li><a href="about">Giới thiệu</a></li>
                    <li><a href="contacts">Liên hệ</a></li>
                </ul>
                <div class="clearfix"></div>
            </nav>
        </div> <!-- .container -->
    </div> <!-- .header-bottom -->
    </div> <!-- #header -->
    @if (isset($slides))
        <div class="rev-slider">
            <div class="fullwidthbanner-container">
                <div class="fullwidthbanner">
                    <div class="bannercontainer">
                        <div class="banner">
                            <ul>
                                @foreach ($slides as $slide)
                                    <li data-transition="boxfade" data-slotamount="20" class="active-revslide"
                                        style="width: 100%; height: 100%; overflow: hidden; z-index: 18; visibility: hidden; opacity: 0;">
                                        <div class="slotholder" style="width:100%;height:100%;"
                                            data-duration="undefined" data-zoomstart="undefined"
                                            data-zoomend="undefined" data-rotationstart="undefined"
                                            data-rotationend="undefined" data-ease="undefined"
                                            data-bgpositionend="undefined" data-bgposition="undefined"
                                            data-kenburns="undefined" data-easeme="undefined" data-bgfit="undefined"
                                            data-bgfitend="undefined" data-owidth="undefined" data-oheight="undefined">
                                            <div class="tp-bgimg defaultimg" data-lazyload="undefined"
                                                data-bgfit="cover" data-bgposition="center center"
                                                data-bgrepeat="no-repeat" data-lazydone="undefined"
                                                src="image/slide/{{ $slide->image }}"
                                                data-src="image/slide/{{ $slide->image }}"
                                                style="background-color: rgba(0, 0, 0, 0); background-repeat: no-repeat; background-image: url('image/slide/{{ $slide->image }}'); background-size: cover; background-position: center center; width: 100%; height: 100%; opacity: 1; visibility: inherit;">
                                            </div>
                                        </div>

                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="tp-bannertimer"></div>
                </div>
            </div>
            <!--slider-->
        </div>
    @endif


    @yield('content')

    <div id="footer" class="color-div">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="widget">
                        <h4 class="widget-title">Instagram Feed</h4>
                        <div id="beta-instagram-feed">
                            <div></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="widget">
                        <h4 class="widget-title">Information</h4>
                        <div>
                            <ul>
                                <li><a href="blog_fullwidth_2col.html"><i class="fa fa-chevron-right"></i> Web
                                        Design</a></li>
                                <li><a href="blog_fullwidth_2col.html"><i class="fa fa-chevron-right"></i> Web
                                        development</a></li>
                                <li><a href="blog_fullwidth_2col.html"><i class="fa fa-chevron-right"></i> Marketing</a>
                                </li>
                                <li><a href="blog_fullwidth_2col.html"><i class="fa fa-chevron-right"></i> Tips</a></li>
                                <li><a href="blog_fullwidth_2col.html"><i class="fa fa-chevron-right"></i> Resources</a>
                                </li>
                                <li><a href="blog_fullwidth_2col.html"><i class="fa fa-chevron-right"></i>
                                        Illustrations</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="col-sm-10">
                        <div class="widget">
                            <h4 class="widget-title">Contact Us</h4>
                            <div>
                                <div class="contact-info">
                                    <i class="fa fa-map-marker"></i>
                                    <p>30 South Park Avenue San Francisco, CA 94108 Phone: +78 123 456 78</p>
                                    <p>Nemo enim ipsam voluptatem quia voluptas sit asnatur aut odit aut fugit, sed quia
                                        consequuntur magni dolores eos qui ratione.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="widget">
                        <h4 class="widget-title">Newsletter Subscribe</h4>
                        <form action="#" method="post">
                            <input type="email" name="your_email">
                            <button class="pull-right" type="submit">Subscribe <i
                                    class="fa fa-chevron-right"></i></button>
                        </form>
                    </div>
                </div>
            </div> <!-- .row -->
        </div> <!-- .container -->
    </div> <!-- #footer -->
    <div class="copyright">
        <div class="container">
            <p class="pull-left">Privacy policy. (&copy;) 2014</p>
            <p class="pull-right pay-options">
                <a href="#"><img src="assets/dest/images/pay/master.jpg" alt="" /></a>
                <a href="#"><img src="assets/dest/images/pay/pay.jpg" alt="" /></a>
                <a href="#"><img src="assets/dest/images/pay/visa.jpg" alt="" /></a>
                <a href="#"><img src="assets/dest/images/pay/paypal.jpg" alt="" /></a>
            </p>
            <div class="clearfix"></div>
        </div> <!-- .container -->
    </div> <!-- .copyright -->


    <!-- include js files -->
    <script src="assets/dest/js/jquery.js"></script>
    <script src="assets/dest/vendors/jqueryui/jquery-ui-1.10.4.custom.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="assets/dest/vendors/bxslider/jquery.bxslider.min.js"></script>
    <script src="assets/dest/vendors/colorbox/jquery.colorbox-min.js"></script>
    <script src="assets/dest/vendors/animo/Animo.js"></script>
    <script src="assets/dest/vendors/dug/dug.js"></script>
    <script src="assets/dest/js/scripts.min.js"></script>
    <script src="assets/dest/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
    <script src="assets/dest/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
    <script src="assets/dest/js/waypoints.min.js"></script>
    <script src="assets/dest/js/wow.min.js"></script>
    <!--customjs-->
    <script src="assets/dest/js/custom2.js"></script>
    <script>
        $(document).ready(function($) {
            $(window).scroll(function() {
                if ($(this).scrollTop() > 150) {
                    $(".header-bottom").addClass('fixNav')
                } else {
                    $(".header-bottom").removeClass('fixNav')
                }
            })
        })
    </script>
</body>

</html>
