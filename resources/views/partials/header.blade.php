@if (app()->getLocale() === 'ar' || app()->getLocale() === 'ur')
<header class="ltn__header-area ltn__header-4 ltn__header-transparent gradient-color-2" dir="rtl">
    @else 
    <header class="ltn__header-area ltn__header-4 ltn__header-transparent gradient-color-2">
@endif
    <div class="ltn__header-top-area" style="background-color: #FFFFFF !important;">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="ltn__top-bar-menu">
                        <ul>
                            <li><a href="mailto:horizoninfotech.ae"><i class="icon-mail"></i> info@horizoninfotech.ae</a></li>
                            <li><a href=""><i class="icon-placeholder"></i> Abu Dhabi</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="top-bar-right text-right">
                        <div class="ltn__top-bar-menu">
                            <ul>
                                <li>
                                    <!-- ltn__language-menu -->
                                    <div class="ltn__drop-menu ltn__currency-menu ltn__language-menu">
                                        <ul>
                                            <!-- GTranslate: https://gtranslate.io/ -->
                                            <style type="text/css">
                                                .switcher {
                                                    font-family: Arial;
                                                    font-size: 10pt;
                                                    text-align: left;
                                                    cursor: pointer;
                                                    overflow: hidden;
                                                    width: 163px;
                                                    line-height: 17px;
                                                }

                                                .switcher a {
                                                    text-decoration: none;
                                                    display: block;
                                                    font-size: 10pt;
                                                    -webkit-box-sizing: content-box;
                                                    -moz-box-sizing: content-box;
                                                    box-sizing: content-box;
                                                }

                                                .switcher a img {
                                                    vertical-align: middle;
                                                    display: inline;
                                                    border: 0;
                                                    padding: 0;
                                                    margin: 0;
                                                    opacity: 0.8;
                                                }

                                                .switcher a:hover img {
                                                    opacity: 1;
                                                }

                                                .switcher .selected {
                                                    background: #FFFFFF url(//gtranslate.io/shopify/assets/switcher.png) repeat-x;
                                                    position: relative;
                                                    z-index: 9999;
                                                }

                                                .switcher .selected a {
                                                    border: 1px solid #CCCCCC;
                                                    background: url(//gtranslate.io/shopify/assets/arrow_down.png) 146px center no-repeat;
                                                    color: #666666;
                                                    padding: 3px 5px;
                                                    width: 151px;
                                                }

                                                .switcher .selected a.open {
                                                    background-image: url(//gtranslate.io/shopify/assets/arrow_up.png)
                                                }

                                                .switcher .selected a:hover {
                                                    background: #F0F0F0 url(//gtranslate.io/shopify/assets/arrow_down.png) 146px center no-repeat;
                                                }

                                                .switcher .option {
                                                    position: relative;
                                                    z-index: 9998;
                                                    border-left: 1px solid #CCCCCC;
                                                    border-right: 1px solid #CCCCCC;
                                                    border-bottom: 1px solid #CCCCCC;
                                                    background-color: #EEEEEE;
                                                    display: none;
                                                    width: 161px;
                                                    max-height: 198px;
                                                    -webkit-box-sizing: content-box;
                                                    -moz-box-sizing: content-box;
                                                    box-sizing: content-box;
                                                    overflow-y: auto;
                                                    overflow-x: hidden;
                                                }

                                                .switcher .option a {
                                                    color: #000;
                                                    padding: 3px 5px;
                                                }

                                                .switcher .option a:hover {
                                                    background: #FFC;
                                                }

                                                .switcher .option a.selected {
                                                    background: #FFC;
                                                }

                                                #selected_lang_name {
                                                    float: none;
                                                }

                                                .l_name {
                                                    float: none !important;
                                                    margin: 0;
                                                }

                                                .switcher .option::-webkit-scrollbar-track {
                                                    -webkit-box-shadow: inset 0 0 3px rgba(0, 0, 0, 0.3);
                                                    border-radius: 5px;
                                                    background-color: #F5F5F5;
                                                }

                                                .switcher .option::-webkit-scrollbar {
                                                    width: 5px;
                                                }

                                                .switcher .option::-webkit-scrollbar-thumb {
                                                    border-radius: 5px;
                                                    -webkit-box-shadow: inset 0 0 3px rgba(0, 0, 0, .3);
                                                    background-color: #888;
                                                }
                                            </style>

                                            <li><a class="dropdown-toggle"><span
                                                        class="active-currency">English</span></a>
                                                <ul>
                                                    <li><a href="?lang=en"
                                                            title="English" class="nturl selected">English</a></li>
                                                    <li><a href="?lang=ar"
                                                            title="عربي" class="nturl">عربي</a></li>
                                                    <li><a href="?lang=ur"
                                                            title="اردو" class="nturl">اردو</a></li>
                                                            
                                                </ul>
                                            </li> 
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <!-- ltn__social-media -->
                                    <div class="ltn__social-media">
                                        <ul>
                                            <li><a target="_blank" title="Facebook-f" href="#"><i
                                                        class="fab fa-facebook-f"></i></a></li>


                                            <li><a target="_blank" title="Twitter" href="#"><i
                                                        class="fab fa-twitter"></i></a></li>



                                            <li><a target="_blank" title="Youtube" href="#"><i
                                                        class="fab fa-youtube"></i></a></li>


                                            <li><a target="_blank" title="Vimeo" href="#"><i
                                                        class="fab fa-vimeo"></i></a></li>


                                            <li><a target="_blank" title="Tiktok" href=""><i
                                                        class="fab fa-tiktok"></i></a></li>


                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ltn__header-middle-area start -->
    <div class="ltn__header-middle-area ltn__header-sticky ltn__sticky-bg-black ltn__logo-right-menu-option">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="site-logo-wrap">
                        <div class="site-logo">
                            <a href="index.html"><img src="img/logo-2.png" alt="Logo"></a>
                        </div>
                        <div class="get-support clearfix get-support-color-white">
                            <div class="get-support-icon">
                                <i class="icon-call"></i>
                            </div>
                            <div class="get-support-info">
                                <h6>{{ __('header.get_support') }}</h6>
                                <h4><a href="tel:+123456789">+971-50-161-8404</a></h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col header-menu-column menu-color-white">
                    <div class="header-menu d-none d-xl-block">
                        <nav>
                            <div class="ltn__main-menu">
                                <ul>
                                    <li><a href="/">{{ __('header.home') }}</a></li>
                                    <li><a href="/services">{{ __('header.services') }}</a></li>
                                    <li><a href="/packages">{{ __('header.packages') }}</a></li>
                                    <li><a href="/about-us">{{ __('header.about_us') }}</a></li>
                                    <li><a href="/contact-us">{{ __('header.contact_us') }}</a></li>
                                    <li class="special-link"><a href="/register">{{ __('header.login_register') }}</a>
                                    </li>
                                    
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
                <!-- Mobile Menu Button -->
                <div class="mobile-menu-toggle menu-btn-white menu-btn-border--- d-xl-none">
                    <a href="#ltn__utilize-mobile-menu" class="ltn__utilize-toggle">
                        <svg viewBox="0 0 800 600">
                            <path
                                d="M300,220 C300,220 520,220 540,220 C740,220 640,540 520,420 C440,340 300,200 300,200"
                                id="top"></path>
                            <path d="M300,320 L540,320" id="middle"></path>
                            <path
                                d="M300,210 C300,210 520,210 540,210 C740,210 640,530 520,410 C440,330 300,190 300,190"
                                id="bottom" transform="translate(480, 320) scale(1, -1) translate(-480, -318) "></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- ltn__header-middle-area end -->
</header>

 

<!-- Utilize Mobile Menu Start -->
<div id="ltn__utilize-mobile-menu" class="ltn__utilize ltn__utilize-mobile-menu">
    <div class="ltn__utilize-menu-inner ltn__scrollbar">
        <div class="ltn__utilize-menu-head">
            <div class="site-logo">
                <a href="index.html"><img src="img/logo.png" alt="Logo"></a>
            </div>
            <button class="ltn__utilize-close">×</button>
        </div>
        <div class="ltn__utilize-menu-search-form">
            <form action="#">
                <input type="text" placeholder="Search...">
                <button><i class="fas fa-search"></i></button>
            </form>
        </div>
        <div class="ltn__utilize-menu">
            <ul>
                <li><a href="/">{{ __('header.home') }}</a></li>
                <li><a href="/services">{{ __('header.services') }}</a></li>
                <li><a href="/packages">{{ __('header.packages') }}</a></li>
                <li><a href="/about-us">{{ __('header.about_us') }}</a></li>
                <li><a href="/contact-us">{{ __('header.contact_us') }}</a></li>
                <li class="special-link"><a href="/register">{{ __('header.login_register') }}</a></li>
            </ul>
        </div>
        <div class="ltn__utilize-buttons ltn__utilize-buttons-2">
            <ul>
                <li>
                    <a href="account.html" title="My Account">
                        <span class="utilize-btn-icon">
                            <i class="far fa-user"></i>
                        </span>
                        {{ __('header.my_acount') }}
                    </a>
                </li>
                <li>
                    <a href="wishlist.html" title="Wishlist">
                        <span class="utilize-btn-icon">
                            <i class="far fa-heart"></i>
                            <sup>3</sup>
                        </span>
                        {{ __('header.wishlist') }}
                    </a>
                </li>
                <li>
                    <a href="cart.html" title="Shoping Cart">
                        <span class="utilize-btn-icon">
                            <i class="fas fa-shopping-cart"></i>
                            <sup>5</sup>
                        </span>
                        {{ __('header.shopping_cart') }}
                    </a>
                </li>
            </ul>
        </div>
        <div class="ltn__social-media-2">
            <ul>
                <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                <li><a href="#" title="Linkedin"><i class="fab fa-linkedin"></i></a></li>
                <li><a href="#" title="Instagram"><i class="fab fa-instagram"></i></a></li>
            </ul>
        </div>
    </div>
</div>
<!-- Utilize Mobile Menu End -->

<div class="ltn__utilize-overlay"></div>